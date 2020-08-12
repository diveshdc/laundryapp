<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckPostCodeRequest;
use App\http\Requests\UpdateUsersDataRequest;
use App\Http\Requests\SaveUsersDataRequest;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Notifications\SignupActivate;
use Redirect;
use App\User;
use Hash;
use Auth;
use Validator;
use Session;
use App\Category;
use App\PostCode;
use App\PasswordReset;
use Illuminate\Support\Str;
use Carbon\Carbon;

// use App\Url;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('userinterface.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUsersDataRequest $userDAta)
    {
      try{
        $referrerCode = 3;
        $input = $userDAta->all();
        $role['roles']            =  2;
        $user = new User;
        $user->first_name         = $input['first_name'];
        $user->last_name          = $input['last_name'];
        $user->email              = $input['email'];
        $user->phone_number       = $input['phone_number']; 
        $user->street_name        = $input['street'];
        $user->building_name_no   = $input['building_name_no'];
        $user->town               = $input['town'];
        $user->post_code          = $input['post_code'];
        $user->reference_from     = $input['reference_from'];
        // $user->referral_code      = $input['referral_code'];
        $user->referrer_code      = $input['first_name'].strtoupper(substr(md5(time()), 0, $referrerCode));
        $user->receive_offer      = $input['receive_offer'] ? 1 : 0;
        // $user->image_upload       = $input['image_upload'];
        // $user->lat                = $input['lat'];
        // $user->lng                = $input['lng'];
        $user->password           = bcrypt($input['password']);
        $user['activation_token'] = str::random(60); 
        $user->save();
        $user->roles()->sync($role, []);
        $user->notify(new SignupActivate($user)); 
        return redirect()->route('products/list');
    }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersDataRequest $userData)
    {
        dd($userData);
    }

    public function login(){
        // $loginSlug = request()->segment(count(request()->segments()));
        // if(Auth::user()){
            // return redirect('/user');
        // }else{
            return view('userinterface.login');
        // }
    }

    public function userLogin(Request $request)
     {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/user');
        }
        return Redirect::to("/user/login")->withSuccess('Oppes! You have entered invalid credentials');
    }

   // public function create(array $data)
   //  {
   //    return User::create([
   //      'name' => $data['name'],
   //      'email' => $data['email'],
   //      'password' => Hash::make($data['password'])
   //    ]);
   //  }


public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/user');
    }

    public function commercialServices(){
        return view('userinterface.commercial-services');
    }

    public function referToFriend(){
        return view('userinterface.refer-a-friend');
    }

     public function noPostCode(){
        return view('userinterface.no-postcard');
    }

    public function signUp(){
     return view('userinterface.signup');
    }

     public function dashboard(){
     return view('userinterface.user-dashboard');
    }



/**
     * Send Reset password link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkPostCode(Request $request){
        try{
        $validator = Validator::make($request->all(), [
            'post_code' => 'required',
        ],[
            'post_code.required' => 'Please enter a post code'
        ]);
    if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
    }    
      $postCode = PostCode::where('post_code','=', $request['post_code'])->where('request','=', 0)->first();
        if(!empty($postCode)){
                return response()->json([
                    'status' => 'notFullCode',
                     'message' => 'Please Enter your Full Postcode!', 
                ]);
        }
        else if(empty($postCode) && strlen($request['post_code'])<= 3){
                return response()->json([
                     'status' => false,
                     'message' => "We don’t cover your area yet!", 
                ]);
        }
else if(empty($postCode) && strlen($request['post_code'])>= 3){
        $encodePostCode =urlencode($request['post_code']);
        $url ='https://maps.googleapis.com/maps/api/geocode/json?address='.$encodePostCode.'&key=AIzaSyAKgOi2zKNGl5XacmeTTjEL1wthOdF7DXU';
            $result = file_get_contents($url);
            $data = json_decode($result);
            // sleep(200000);
        if ($data->status=="OK") {
            $arrComponents = $data->results[0]->address_components;
            $city = "";
            $state = "";
            $country = "";
            $postal_town ="";
            $route = "";
    foreach($arrComponents as $index=>$component) {
            $type = $component->types[0];

            if ($city == "" && ($type == "sublocality_level_1" || $type == "locality") ) {
                $city = trim($component->short_name);
            }
            if ($state == "" && $type=="administrative_area_level_1") {
                $state = trim($component->short_name);
            }
            if ($country == "" && $type=="country") {
                $country = trim($component->short_name);
                
                // if ($blnUSA && $country!="US") {
                //     $city = "";
                //     $state = "";
                //     break;
                // }
            }
            if ($postal_town == "" && $type=="postal_town") {
                $postal_town = trim($component->short_name);
            }
            if ($route == "" && $type=="route") {
                $route = trim($component->short_name);
            }
            if ($city != "" && $state != "" && $country != "") {
                //we're done
                break;
            }
        }
            $lat = $data->results[0]->geometry->location->lat;
            $lng = $data->results[0]->geometry->location->lng;
            $address = $data->results[0]->formatted_address;
            $arrComponents = $data->results[0]->address_components;
    
        $arrReturn = array("city"=>$city, 
                "state"=>$state, 
                "country"=>$country,
                "postal_town"=>$postal_town,
                'route'=>$route,
                'lat'=>$lat,
                'lng'=>$lng,
                'full_address' => $address,
                'google_place_id' => $data->results[0]->place_id
            );
            return response()->json([
                'status'=>true,
                'message'=>'post code is valid!',
                'data' =>$arrReturn
            ]);
        }else{
            return response()->json([
                    'status' => false,
                    'message'=> 'Invalid postcode!'
                ]);
        }
        if($data->status == 'OVER_QUERY_LIMIT') {
            return response()->json([
                'status' => false, 
                'message' => 'Google Amp API OVER_QUERY_LIMIT, Please update your google map api key or try tomorrow'
            ]);
        }
    }

 }catch (\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }   
}

public function sendResetLink(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ],['email.required' => 'Please enter a email!']);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        } 
        $user = User::where('email', $request->email)->first();
        if ($user == null){
               return response()->json([
                'status'=>false,
                'array' =>'no',
                'message'=>'We cant find a user with that e-mail address'
            ]);
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
             ]
        );
        if ($user && $passwordReset){
            $user->notify(
                new PasswordResetRequest($passwordReset->token));
            return response()->json([ 
                'status' => true,
                'message'    => 'We have e-mailed your password reset link. please check your inbox!'
            ],200);
    }
}catch (\Exception $ex){
            return response()->json([
                'status' => 'exception',
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        } 
    }
}
