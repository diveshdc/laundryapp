<?php
namespace App\Http\Traits;
use Exception;
use App\User;
use App\Order;
use App\PushNotification;
trait PushNotificationTraits {

    public function sendPush($data) {
    try{
        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $data['device_token'];
        $serverKey = 'AAAAmqpr_uA:APA91bESaFDL2R6h3T5nz5CZ6-1m4Ald6V63lFv0nxTsgjCbiIS7y17aVTrEFn23jk45cZLhtEStEP34nSXkVDoE_JCZUCcm4zJw_6T932210rrbhDVYxypRm2xnXOw75Shz8vDQVm-R';
        $title = $data['title'];
        $body = $data['message'];
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1','click_action' =>"NotificationsActivity");
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers   = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        }catch (\Exception $ex){
             // return $this->exceptionResponse($ex);
        }
 }

         protected function createOnMyWayMessage($request) {
                 $deviceToken = User::where('id',$request->driver_id)->select('device_token','first_name','last_name')->first();
                 $userName = User::where('id',$request->user_id)->select('device_token','first_name','last_name')->first();
                 $oderId = Order::where('assign_to',$request->driver_id)->where('id', $request->order_id)->select('id','delivery_type')->first();
               
                 $data = array(
                'device_token'=>$deviceToken['device_token'],
                'title' =>'On my way',
                'message'=>"Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You've started".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name']);
                     $notification = PushNotification::create([
                        'notification' => "Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You've started".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name'],
                        'user_id' => $request->driver_id,
                        'job_type'=>$oderId['delivery_type']
                    ]);
                    $notification->save();
                 return $data;
        }

        protected function createNewJobMessage($request) {
                 $deviceToken = User::where('id',$request->driver_id)->select('device_token','first_name','last_name')->first();
                 $userName = User::where('id',$request->user_id)->select('device_token','first_name','last_name')->first();
                 $oderId = Order::where('assign_to',$request->driver_id)->where('id', $request->order_id)->select('id')->first();
               
                $data = array(
                'device_token'=>$deviceToken['device_token'],
                'title' =>'New Job Assigned',
                'message'=>"Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You've started".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name']);
                 $notification = PushNotification::create([
                       'notification' => "Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You've started".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name'],
                       'user_id' => $request->driver_id,
                       'job_type'=>$oderId['delivery_type']
                    ]);
                    $notification->save();
                 return $data;

        }

        protected function createCancelMessage($request) {
                 $deviceToken = User::where('id',$request->driver_id)->select('device_token','first_name','last_name')->first();
                 $oderId = Order::where('assign_to',$request->driver_id)->where('id', $request->order_id)->select('id','user_id','reason')->first();
                 $userName = User::where('id',$oderId['user_id'])->first();
                 $data = array(
                'device_token'=>$deviceToken['device_token'],
                'title' =>'Cancel Job',
                'message'=>"Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You’ve cancelled".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name'].' '.'with'.' '.$oderId['reason']);
                 $notification = PushNotification::create([
                      'notification' => "Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You’ve cancelled".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name'].' '.'with'.' '.$oderId['reason'],
                      'user_id' => $request->driver_id,
                      'job_type'=>$oderId['delivery_type']
                    ]);
                    $notification->save();
                 return $data;
        }

        protected function createRejectJobMessage($request) {
                 $deviceToken = User::where('id',$request->driver_id)->select('device_token','first_name','last_name')->first();
                 $oderId = Order::where('assign_to',$request->driver_id)->where('id', $request->order_id)->select('id','user_id','reason','delivery_type')->first();
                 $userName = User::where('id',$oderId['user_id'])->first();
               
                $data = array(
                'device_token'=>$deviceToken['device_token'],
                'title' =>'Reject Job',
                'message'=>"Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You’ve rejected".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name']);
                 $notification = PushNotification::create([
                      'notification' => "Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You’ve rejected".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name'],
                      'user_id' => $request->driver_id,
                      'job_type'=>$oderId['delivery_type']
                    ]);
                    $notification->save();
                 return $data;
        } 
        protected function createOnArrivedMessage($request) {
                 $deviceToken = User::where('id',$request->driver_id)->select('device_token','first_name','last_name')->first();
                 $userName = User::where('id',$request->user_id)->select('device_token','first_name','last_name')->first();
                 $oderId = Order::where('assign_to',$request->driver_id)->where('id', $request->order_id)->select('id','delivery_type')->first();
               
                $data = array(
                'device_token'=>$deviceToken['device_token'],
                'title' =>'Arrived',
                'message'=>"Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You've started".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name']);
                    $notification = PushNotification::create([
                      'notification' => "Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You've started".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name'],
                      'user_id' => $request->driver_id,
                      'job_type'=>$oderId['delivery_type']
                    ]);
                    $notification->save();
                 return $data;
        }

        protected function createAcceptJobMessage($request) {
                 $deviceToken = User::where('id',$request->driver_id)->select('device_token','first_name','last_name')->first();
                 $userName = User::where('id',$request->user_id)->select('device_token','first_name','last_name')->first();
                 $oderId = Order::where('assign_to',$request->driver_id)->where('id', $request->order_id)->select('id','delivery_type')->first();
               
                $data = array(
                'device_token'=>$deviceToken['device_token'],
                'title' =>'Accept Job',
                'message'=>"Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You've Accepted".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name']);
                $inputs = ['notification' => $data,'user_id' => $request->driver_id,'job_type'=>$oderId['delivery_type']];

                  $notification = PushNotification::create([
                     'notification' => "Dear".' '.$deviceToken['first_name'].' '.$deviceToken['last_name'].','. ' '. "You've Accepted".' '.'job'.' '.'#'.$oderId['id'].' '."from".' '. $userName['first_name'].' '.$userName['last_name'],
                     'user_id' => $request->driver_id,
                     'job_type'=>$oderId['delivery_type']
                    ]);
                    $notification->save();
                 return $data;
        }
}