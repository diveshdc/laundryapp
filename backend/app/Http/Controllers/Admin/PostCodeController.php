<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCodeRequest;
use App\Http\Requests\MassDestroyPostcodeRequest;
use Illuminate\Http\Request;
use App\PostCode;
use Exception;
use DB;
class PostCodeController extends Controller
{
    public function index()
    {
    abort_unless(\Gate::allows('postcode_access'), 403);
	$postcodes = PostCode::where('request','=', 0)->get();
    return view('admin.postcode.index',compact('postcodes'));
    }


    public function postcodeRequest()
    {
    abort_unless(\Gate::allows('postcode_access'), 403);
    $postcodes = PostCode::where('request','=', 1)->where('publish_unpublish',0)->get();
    // $maxValue = DB::table('post_codes')->max('post_code');
    // dd($maxValue);
    return view('admin.postcode.post_code_request',compact('postcodes'));
    }

    public function create()
    {
    	abort_unless(\Gate::allows('postcode_create'), 403);
    	return view('admin.postcode.create');	
    }

    public function store(StorePostCodeRequest $request)
    {
    	abort_unless(\Gate::allows('postcode_create'), 403);
    	try{
    		$postcode = PostCode::create([
            'post_code'       =>$request->post_code,
        ]);
        $postcode->save();
    		if($postcode->id){
        	return redirect()->route('admin.postcode.index');
    		}else{
    			return Redirect::back()->withErrors(['msg', 'somthing went Wrong please try again.']);
    		}
    	}catch (\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => 'Error : '.$ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
    }

    public function edit($id)
    {
    	abort_unless(\Gate::allows('postcode_edit'), 403);
        $postCode =PostCode::find($id);
    	return view('admin.postcode.edit',compact('postCode'));

    }

    public function update(Request $request, $id){
        try{
            abort_unless(\Gate::allows('postcode_edit'), 403);
             $postcode = PostCode::find($id);
             $postcode->update($request->all());
            return redirect()->route('admin.postcode.index');
        }catch (\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => 'Error : '.$ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
    }

    public function destroy($id)
    {
        abort_unless(\Gate::allows('postcode_delete'), 403);
        $postCode = PostCode::find($id)->delete();
        return back();
    }

    public function massDestroy(MassDestroyPostcodeRequest $request)
    {
        PostCode::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

    public function checkPostCode(Request $request, $postCode=null)
   {
    try{         
        return 'api chal gai bawa'; 
       // $key = env('GOOGLE_API_KEY');
           $validator = Validator::make($request->all(), [
                'post_code' => 'required',
            ],['post_code.required' => 'Please enter a postcode!']);
           if ($validator->fails()) {  
            return response()->json(['error' => $validator->errors()], 401);            
        } 
    $postCode = PostCode::where('post_code',$request->post_code)->where('request','=', 0)->first();
        if(!empty($postCode)){
                return response()->json([
                    'status' => true,
                     'message' => 'yes', 
                ]);
        }else if(empty($postCode) && strlen($request->post_code)<= 3){
                return response()->json([
                    'status' => false,
                     'message' => 'We don’t cover your area yet!', 
                ]);
        }
        else if(empty($postCode)){
        $post_code =urlencode($request->post_code);
        $url ='https://maps.googleapis.com/maps/api/geocode/json?address='.$post_code.'&key=AIzaSyAKgOi2zKNGl5XacmeTTjEL1wthOdF7DXU';
            $result = file_get_contents($url);
            $data = json_decode($result);
            usleep(200000);
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
                'full address' => $address,
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
}
catch (\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => 'Error : '.$ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
   }

   public function publishUnpublish(Request $request) {
        PostCode::where('id',$request->postcode_id)->update([
            'publish_unpublish'=>$request->status
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'successfull!',
        ],200);
    }
}
