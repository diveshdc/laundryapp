<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Exception;
use App\PostCode;
use App\User;
use App\Mail\SuscribeNewsLetter;
use App\Mail\AdminAlert;
use Mail;

class PostCodeController extends Controller
{
   // public function checkPostCode(Request $request)
   // {
   // 	try{		 
   //     // $key = env('GOOGLE_API_KEY');
		 //   $validator = Validator::make($request->all(), [
   //              'post_code' => 'required',
   //          ]);
   //         if ($validator->fails()) {  
   //          return response()->json(['error' => $validator->errors()], 401);            
   //      } 
   //  $postCode = PostCode::where('publish_unpublish',1)
   //                      ->where(function ($query) use ($request) {
   //                      $query->orWhere('post_code','like', '%' .$request->post_code. '%');
   //                      })->select('post_code')->first();
   //                      dd($postCode);
   //  //call google api for getting lat lng and address by postcode
   //  // && strlen($request->post_code) > 3
   //  if(!empty($postCode)) {
   //      $post_code =urlencode($request->post_code);
   //      $url ='https://maps.googleapis.com/maps/api/geocode/json?address='.$post_code.'&key=AIzaSyAKgOi2zKNGl5XacmeTTjEL1wthOdF7DXU';
   //          $result = file_get_contents($url);
   //          $data = json_decode($result);
   //          usleep(200000);
   //      if ($data->status=="OK") {
   //          $arrComponents = $data->results[0]->address_components;
   //          $city = "";
   //          $state = "";
   //          $country = "";
   //          $postal_town ="";
   //          $route = "";
   //  foreach($arrComponents as $index=>$component) {
   //          $type = $component->types[0];
   //          if ($city == "" && ($type == "sublocality_level_1" || $type == "locality") ) {
   //              $city = trim($component->short_name);
   //          }
   //          if ($state == "" && $type=="administrative_area_level_1") {
   //              $state = trim($component->short_name);
   //          }
   //          if ($country == "" && $type=="country") {
   //              $country = trim($component->short_name);
                
   //              // if ($blnUSA && $country!="US") {
   //              //     $city = "";
   //              //     $state = "";
   //              //     break;
   //              // }
   //          }
   //          if ($postal_town == "" && $type=="postal_town") {
   //              $postal_town = trim($component->short_name);
   //          }
   //          if ($route == "" && $type=="route") {
   //              $route = trim($component->short_name);
   //          }
   //          if ($city != "" && $state != "" && $country != "") {
   //              //we're done
   //              break;
   //          }
   //      }
   //          $lat = $data->results[0]->geometry->location->lat;
   //          $lng = $data->results[0]->geometry->location->lng;
   //          $address = $data->results[0]->formatted_address;
   //          $arrComponents = $data->results[0]->address_components;

   //          $arrReturn = array("city"=>$city, 
   //              "state"=>$state, 
   //              "country"=>$country,
   //              "postal_town"=>$postal_town,
   //              'route'=>$route,
   //              'lat'=>$lat,
   //              'lng'=>$lng,
   //              'full_address' => $address,
   //              'google_place_id' => $data->results[0]->place_id
   //          );
   //          return response()->json([
   //              'status'=>true,
   //              'message'=>'post code is valid!',
   //              'data' =>$arrReturn
   //          ]);
   //      }
   //      else if($data->status =='ZERO_RESULTS'){
   //               return response()->json([
   //                  'status' => true,
   //                  'message'=> 'Valid post code but address not found !'
   //              ]);
   //      }
   //      else{
   //          return response()->json([
   //                  'status' => false,
   //                  'message'=> 'Invalid postcode!'
   //              ]);
   //      }
   //      if($data->status == 'OVER_QUERY_LIMIT') {
   //          return response()->json([
   //              'status' => false, 
   //              'message' => 'Google Amp API OVER_QUERY_LIMIT, Please update your google map api key or try tomorrow'
   //          ]);
   //      }
   //      }else{
   //           return response()->json([
   //                  'status' => false,
   //                  'message' => 'We don’t cover your area yet!', 
   //              ]);
   //      }
   //          // if(!empty($postCode)
   //                  // else{
   //                  //    return response()->json([
   //                  //         'status' => false,
   //                  //          'message' => 'We don’t cover your area yet!', 
   //                  //     ]);
   //                  // }
   //  }
   //  catch (\Exception $ex){
   //              return response()->json([
   //                  'status' => 'error',
   //                  'message' => 'Error : '.$ex->getMessage(),
   //                  'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
   //              ], 200);
   //          }
   // }

public function checkPostCode(Request $request)
   {
    try{         
       // $key = env('GOOGLE_API_KEY');
           $validator = Validator::make($request->all(), [
                'post_code' => 'required',
            ]);
           if ($validator->fails()) {  
            return response()->json(['error' => $validator->errors()], 401);            
        } 
    $postCode = PostCode::where('post_code','=', $request->post_code)->where('request','=', 0)->where('publish_unpublish','=', 0)->first();
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
public function postcodeRequest(Request $request){
    try{  
      $validator = Validator::make($request->all(), [
                'post_code' => 'bail|required',
                'email' =>'bail|required',
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
        $check = PostCode::where('post_code',$input['post_code'])->where('email',$input['email'])->get();
        if(count($check)>0){
                 return response()->json([
                'status' => false,
                'message' => 'Your request already submitted for this postcode',
            ], 200);
        }else{
        $postCode = new PostCode;
        $postCode['request'] = true; 
        $postCode->post_code = $input['post_code']; 
        $postCode->email = $input['email'];  
        $postCode->publish_unpublish = 1;  
        $postCode->save();
        $adminData =User::whereHas('roles',function($q){
                $q->where('title', 'Admin');
            })->select('email')->get();
         Mail::to($input['email'])->send(new SuscribeNewsLetter($postCode));
         Mail::to($adminData[0]['email'])->send(new AdminAlert($input['email']));
        if($postCode){
           return response()->json([
                'status' => true,
                'message' => 'Your request has been submitted successfully!',
            ], 200);
        }
    }

    }catch (\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => 'Error : '.$ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
}

}
