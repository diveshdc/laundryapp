<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth; 
use App\Notifications\SignupActivate;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;
use App\PushNotification;
use Validator;
use Exception;
// use Edujugon\PushNotification\PushNotification;
use Illuminate\Support\Arr;
use App\Mail\AccountConfirmation;
use Mail;
class UsersApiController extends Controller
{
    
    public $successStatus = 200;


    public function index()
    {
        $users = User::all();

        return $users;
    }

    public function UpdateUserData(Request $request)
    {
        try{
            $user = Auth::user();
        if(empty($user)){
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated user',
            ],401);
        }
        $validator = Validator::make($request->all(), [ 
            'building_name_no'   => 'required',
            'street_name'        => 'required',
            'town'               => 'required',
            'first_name'         => 'required', 
            'last_name'          => 'required',
            'post_code'          => 'required',
            'phone_number'       => ['required', 'digits:11'],
        ]);
         if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                 return response()->json([
                    'status'  => false,
                    'message' => implode('<br />', $messages)
                ], 401); 
            }
            }
            $input = $request->all();
            $user->fill($input)->save();
            if($user){
                return response()->json([
                    'status' => true,
                    'message'=> 'Profile updated successfully!',
                    'data'  => $user
                ]);
            }
        }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
        
    }

    // /** 
    //  * login api 
    //  * 
    //  * @return \Illuminate\Http\Response 
    //  */ 
    public function login(Request $request)
    {   
        try{
        $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' =>'required'
            ]);
         if($validator->fails()) {
                foreach ($validator->messages()->getMessages() as $field_name => $messages){

                     return response()->json([
                        'status'  => false,
                        'message' => implode('<br />', $messages)
                    ], 200); 
                }
            }
        $checkLogindetails = Auth::attempt([
                                'email' => request('email'), 
                                'password' => request('password')
                            ]);
            if($checkLogindetails == false){
                     return response()->json([
                        'status'  => false,
                        'message' => 'Email or password not match!'
                    ], 200); 
            }else{
                    $user = Auth::user(); 
                    $userIsActive = User::where('active',1)->find($user->id); 
                 if($userIsActive == null){
                        return response()->json([
                        'status' => false,
                        'message' =>'Before login you need to activate account!',
                        ], $this->successStatus);
                 }else{
                    User::where('id',$user->id)->update([
                        'device_type'=>$request->device_type,
                        'device_token'=>$request->device_token,
                    ]);
                      $user = Auth::user();
                $token= $user->createToken(env('Token'))->accessToken; 
                        return response()->json([
                            'status' => true,
                            'data'    => $user,
                            'token'   => $token,
                            'message' =>'Login successfully',
                            ], $this->successStatus); 
                    }
         } 
        }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        try{
        $validator = Validator::make($request->all(), [ 
            'building_name_no'   => 'required',
            'street_name'        => 'required',
            'town'               => 'required',
            'first_name'         => 'required', 
            'last_name'          => 'required', 
            'post_code'          => 'required', 
            'device_token'       => 'required',
            'device_type'        => 'required',
            'reference_from'     => 'required',
            'email'              => 'required|unique:users,email', 
            'password'           => 'required|min:6|confirmed',
            'phone_number'       => ['required', 'digits:11'],
        ]);
         if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                 return response()->json([
                    'status'  => false,
                    'message' => implode('<br />', $messages)
                ], 401); 
            }
            }
        $referrerCode = 3;
        $input = $request->all();
        $role['roles']            =  2;
        $user = new User;
        $user->first_name         = $input['first_name'];
        $user->last_name          = $input['last_name'];
        $user->email              = $input['email'];
        $user->phone_number       = $input['phone_number']; 
        $user->street_name        = $input['street_name'];
        $user->building_name_no   = $input['building_name_no'];
        $user->town               = $input['town'];
        $user->post_code          = $input['post_code'];
        $user->reference_from     = $input['reference_from'];
        $user->device_token       = $input['device_token'];
        $user->device_type        = $input['device_type'];
        $user->referral_code      = $input['referral_code'];
        $user->referrer_code      = $input['first_name'].strtoupper(substr(md5(time()), 0, $referrerCode));
        $user->receive_offer      = $input['receive_offer'];
        $user->image_upload       = $input['image_upload'];
        $user->lat                = $input['lat'];
        $user->lng                = $input['lng'];
        $user->password           = bcrypt($input['password']);
        $user['activation_token'] = str::random(60); 
        $user->save();
        $user->roles()->sync($role, []);
        // $user->notify(new SignupActivate($user));

         $sent = Mail::to($input['email'])->send(new AccountConfirmation($user));

        $token =  $user->createToken(env('Token'))->accessToken; 
        return response()->json([
            'status'  =>true,
            'data'    => $user,
            'token'   => $token,
            'message' =>'You are registered successfully, we have sent you an email to verify your account!'
        ],200); 
    }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
}


public function signupActivate($token)
{
    try{
    $user = User::where('activation_token', $token)->first();
    if (!$user) {
        // return response()->json([
        //     'message' => 'This activation token is invalid.'
        // ], 404);
         echo '<h3 style="text-align:center;">This activation token is invalid.</h3>';
         die();
    }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        $token =  $user->createToken(env('Token'))->accessToken; 
    // return response()->json([
            // 'status'  => true,   
            echo '<h3 style="text-align:center;">Account activated successfully!. you can login now</h3>';
            die();
            // 'message' => 'Account activated successfully!.',
            // 'token'   => $token,
            // 'data'    => $user
        // ], 200);
    }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
}

/**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        if(auth()->user()){
         $notificationsCount = PushNotification::select('pending_count')->where('user_id',Auth::user()->id)->get();
         $count = [];
         if(count($notificationsCount)>0){
            $count = $notificationsCount[0]['pending_count'];
         }
        return response()->json([
            'status' => true,
            'message'=> 'Data found',
            'data'   => auth()->user(),
            'notification_count'=>$count
        ], 200);
    }else{
         return response()->json([
            'status' => false,
            'message'=> 'data not found',
            'data'   => null,
        ], 200);
    }
    }

    /**
    *
    *
    *@return \Illuminate\Http\Response
    */
    public function imageupload(Request $request)
    {
        try{
       $validator = Validator::make($request->all(), [ 
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails()) {
                foreach ($validator->messages()->getMessages() as $field_name => $messages)
                {
                     return response()->json([
                        'status'  => false,
                        'message' => implode('<br />', $messages)
                    ], 401); 
                }
            }     
       if ($request->has('profile_image') && empty($request['user_id'])) {
            // Get image file
                $image=$request->file('profile_image');
                $parts = pathinfo($image->getClientOriginalName());
                $extension = strtolower($parts['extension']);
                $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
                $imagePath = '/images/profile_picture/';
                if($image->move(public_path() .$imagePath , $imageName)){
                    $returnImagePath =  url('/').$imagePath.$imageName;
                    return response()->json([
                        'status'     =>true,
                        'message'    =>'Profile uploaded successfully!',
                        'image_path' => $returnImagePath
                    ],200);
                }else{
                    return response()->json([
                        'status'     => false,
                        'message'    =>'Something went wrong please try again!',
                    ],500);
                }
        }else if ($request['user_id'] && $request->has('profile_image')) {
            // Get image file
                $image=$request->file('profile_image');
                $parts = pathinfo($image->getClientOriginalName());
                $extension = strtolower($parts['extension']);
                $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
                $imagePath = '/images/profile_picture/';
                if($image->move(public_path() .$imagePath , $imageName)){
            $saveImagePath =  url('/').$imagePath.$imageName;
           $returnImagePath = User::updateOrCreate(['id'=>$request['user_id']
          ],['image_upload'=>$saveImagePath,]);
                    return response()->json([
                        'status'     =>true,
                        'message'    =>'Profile uploaded successfully!',
                        'image_path' => $returnImagePath['image_upload']
                    ],200);
                }else{
                    return response()->json([
                        'status'     => false,
                        'message'    =>'Something went wrong please try again!',
                    ],500);
                }
        }
    }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        } 
    }
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        try{
            User::where('id',Auth::user()->id)->update(['device_token' => '']);
            $request->user()->token()->revoke();
            return response()->json([
                'status'  => true,
                'message' => 'Successfully logged out'
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        } 
    }


      public function updateAddress(Request $request)
        {
        try{
        // return $request->all();
            $user = Auth::user();
        if(empty($user)){
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated user',
            ],200);
        }

        $validator = Validator::make($request->all(), [
            'building_name_no'   => 'required',
            'street_name'        => 'required',
            'town'               => 'required',
            'first_name'         => 'required', 
            'last_name'          => 'required',
            'postcode'          => 'required',
            'phone_number'       => ['required', 'digits:11'],
            'new_password' => ['nullable', 'string'],
            'password_confirmation' => ['nullable', 'required_with:new_password', 'same:new_password'],
            'password' => ['required', function ($attribute, $value, $fail) {
            if (!\Hash::check($value, Auth::user()->password)) {
                return $fail(__('The current password is incorrect.'));
            }
            }]
            ]);
         if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                 return response()->json([
                    'status'  => false,
                    'message' => implode('<br />', $messages)
                ], 200); 
            }
            }
            $input = $request->all();
            $input['password'] = bcrypt($input['new_password']);
            $user->fill($input)->save();
            if($user){
                return response()->json([
                    'status' => true,
                    'message'=> 'Profile updated successfully!',
                    'data'  => $user
                ]);
            }
        }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
        
    }




// public function send_method_in_apn_service(){
// $push = new PushNotification('apn');
// $deviceToken = 'ec0fa09d62721a6da13a047cf417c570ad646626a76f95ac2d371949c08053db';
// $push->setMessage([
//                 'apn' => [
//                     'alert' => [
//                         'title' => 'This is the title',
//                         'body'=> 'This is the body'
//                     ], 
//                         'sound' => 'default',
//                         'badge' => 1
//                     ],
// 'extraPayLoad' => [
//         'custom' => 'My custom data',
//     ]
    
// ])->setDevicesToken($deviceToken)->send()->getFeedback();

// dd($push->send());

// }



// public function send_method_in_apn_service($deviceToken,$title,$body ){
// $push = new PushNotification('apn');
// $deviceToken = 'ec0fa09d62721a6da13a047cf417c570ad646626a76f95ac2d371949c08053db';

// $push->setMessage(['apn' => ['alert' => ['title' => $title,'body'=> $body
// ], 
//     'sound' => 'default',
//     'badge' => 1

// ],
// 'extraPayLoad' => [
// 'custom' => 'My custom data',
// ]
// ])->setDevicesToken($deviceToken)->send()->getFeedback();

// $push->send();

// }



}

