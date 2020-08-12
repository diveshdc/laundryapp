<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Notifications\SignupActivate;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;
use App\Order;
use Validator;
use Exception;
use Edujugon\PushNotification\PushNotification;
use App\Http\Traits\PushNotificationTraits;
use App\Http\Traits\TwilioTraits;
use Illuminate\Support\Arr;
use Twilio\Rest\Client;
class DriversApiController extends Controller
{
    use PushNotificationTraits;
    use TwilioTraits;
    public $successStatus = 200;
    /** 
     * Driver login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
   /* public function register(Request $request) 
    */
    public function driverLogin(Request $request)
    {   
        try{
        $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' =>'required',
                'device_token'=>'required',
                'device_type'=>'required',
            ]);
         if($validator->fails()) {
            return validatorMessage($validator);
            }
        $checkLogindetails = Auth::attempt([
                                'email' => request('email'), 
                                'password' => request('password')
                            ]);
            if($checkLogindetails == false){
                     return response()->json([
                        'statuscode'=> 401,
                        'status'  => false,
                        'message' => 'Email or password not match!'
                    ], 200); 
            }
            else{
                $user = Auth::user(); 
                if($user->active == '1'){
                    return response()->json([
                            'status' => false,
                            'message' =>'You have blocked by admin.',
                            ],401); 
                }
                User::where('id',Auth::user()->id)->update([
                    'device_token'=>$request->device_token,
                    'device_type'=>$request->device_type
                ]);
                $token= $user->createToken(env('Token'))->accessToken; 
                        return response()->json([
                            'status' => true,
                            'data'    => $user,
                            'token'   => $token,
                            'message' =>'Login successfully',
                            ], $this->successStatus); 
                    }
        }catch (\Exception $ex){
             return $this->exceptionResponse($ex);
        }
    }

    public function onlineOffline(Request $request) {
        try{
         $status = $request['is_status'] ==1 ? 'Online': 'Offline';
         $changeStatus = User::where('id',Auth::user()->id)->update(['is_status' => $request['is_status']]);
         $data= User::select('is_status')->where('id',Auth::user()->id)->first();
         return response()->json([
            'statuscode'=> 200,
            'status'  =>true,
            'data'  => $data,
            'message' => 'you are'.' '.$status,
         ],200);
        }catch (\Exception $ex){
             return $this->exceptionResponse($ex);
        }
}

    public function acceptOrReject(Request $request) {
        try{
            $jobs = Order::where('assign_to', $request->driver_id)
                            ->where('id', $request->order_id)
                            ->first();
                if(!empty($jobs)){
                if($request->accept_reject == 'Accept'){
                    Order::where('assign_to', $request->driver_id)->where('id', $request->order_id)->update([
                        'accept_reject'=> $request->accept_reject, 
                        'is_accepted' => 1, 
                    ]);
                    $data = $this->createAcceptJobMessage($request);
                    $this->sendPush($data);
                return response()->json([
                        'status'=>true,
                        'statuscode'=>200,
                        'message'=>'Job has been accepted successfully!'
                        ]);
            }else if($request->accept_reject == 'Reject'){
                    Order::where('assign_to', $request->driver_id)->where('id', $request->order_id)->update(['accept_reject'=> $request->accept_reject, 
                        'status'=> 'Rejected',
                        'accept_reject'=>'Reject',
                        'is_accepted' => 0,
                        ]);
                    $data = $this->createRejectJobMessage($request);
                    $this->sendPush($data);
                    return response()->json([
                        'status'=>true,
                        'statuscode'=>200,
                        'message'=>'Job has been rejected successfully!'
                        ]);
            }else if($request->accept_reject == 'Cancel'){
                    Order::where('assign_to', $request->driver_id)->where('id', $request->order_id)->update(['accept_reject'=> $request->accept_reject,
                        // 'assign_to'=> 0,
                        'status'=>'Cancelled',
                        'is_accepted' => 0,
                        'reason'=>$request->reason
                        ]);
                     $data = $this->createCancelMessage($request);
                     $this->sendPush($data);
                    return response()->json([
                        'status'=>true,
                        'statuscode'=>200,
                        'message'=>'Job has been cancelled successfully!'
                        ]);
                }
                else if($request->accept_reject == 'Failed'){
                    Order::where('assign_to', $request->driver_id)->where('id', $request->order_id)->update([
                        'accept_reject'=> $request->accept_reject,
                        // 'assign_to'=> 0,
                        'status'=>'Failed',
                        'is_accepted' => 0,
                        'reason'=> $request->reason
                        ]);
                     // $data = $this->createCancelMessage($request);
                     // $this->sendPush($data);

                    return response()->json([
                        'status'=>true,
                        'statuscode'=>200,
                        'message'=>'Job has been failed!'
                        ]);
                }
            }else{
                return response()->json([
                    'status'=>true,
                    'statuscode'=>200,
                    'message'=>'you dont have job.'
                ]);
            }   
                
        }catch (\Exception $ex){
            return $this->exceptionResponse($ex);
        }
    }

    public function signatureAndImageUpload(Request $request) {
          try{     
            // Get image file
         if ($request->has('receiver_signature')){
                $image=$request->file('receiver_signature');
                $parts = pathinfo($image->getClientOriginalName());
                $extension = strtolower($parts['extension']);
                $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
                $imagePath = '/images/signature/';
                Order::where('id',$request['job_id'])->update([
                    'receiver_signature'=>url('/').$imagePath.$imageName
                ]);
                $message = 'successful!';
               }
                if($request->note){
                    Order::where('id',$request['job_id'])->update([
                    'notes'=>$request->note,
                    'status'=>'Successful'
                ]);
                    $message = 'successful!';
                }
                if($request->has('receiver_image')) {
                $image=$request->file('receiver_image');
                $parts = pathinfo($image->getClientOriginalName());
                $extension = strtolower($parts['extension']);
                $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
                $imagePath = '/images/image_after_delivery/';
                   Order::where('id',$request['job_id'])->update([
                    'receiver_image'=>url('/').$imagePath.$imageName
                ]);
                   $message = 'successful!';
                   $imagePath = url('/').$imagePath.$imageName;
                }

                Order::where('id',$request['job_id'])->update([
                    'status'=>'Successful',
                    'accept_reject'=>'Complete'
                ]);

                    return response()->json([
                         'statuscode'     =>200,
                         'status'     =>true,
                         'message'    =>$message,
                         'image_path' => $imagePath?$imagePath:''
                    ],200);
                }catch (\Exception $ex){
                         return $this->exceptionResponse($ex);
                    }
            }

protected function exceptionResponse($ex) {
    return response()->json([
                'statuscode' =>200,
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ],200);
}

protected function validatorMessage($ex) {
   foreach ($validator->messages()->getMessages() as $field_name => $messages){
                     return response()->json([
                        'statuscode'=> 401,
                        'status'  => false,
                        'message' => implode('<br />', $messages)
                    ], 200); 
                }
}


public function onMyWay(Request $request) {
    try{
       Order::where('assign_to', $request->driver_id)->where('id', $request->order_id)->update([
            'status'=> $request->status, //status is onmyway
        ]);
        $client->messages->create(
                   $number,
                   [
                       'from' => env( 'TWILIO_FROM' ),
                       'body' => $message,
                   ]
               );
         $this->send_nexmo_message($to="+917248727854",$text="hefdhfgidghkdsgfsdighsdoligds");
        $data = $this->createOnMyWayMessage($request);
        $this->sendPush($data);
        return response()->json([
            'status'=>true,
            'statuscode'=>200,
            'type'=>$request->status,
            'message'   =>'success!'
        ]);  
     }catch (\Exception $ex){
             return $this->exceptionResponse($ex);
        }
}

}
