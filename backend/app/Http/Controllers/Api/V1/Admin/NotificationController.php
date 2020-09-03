<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PushNotification;
use Auth;
class NotificationController extends Controller
{
	public function  getNotifications(){
		PushNotification::where('user_id',Auth::user()->id)->update([
			'pending_count'=>0
		]);
		$notifications = PushNotification::orderBy('id','Desc')->where('user_id',Auth::user()->id)->get();
		 $notificationsCount = PushNotification::select('pending_count')->where('user_id',Auth::user()->id)->get();
         $count = [];
         if(count($notificationsCount)>0){
            $count = $notificationsCount[0]['pending_count'];
         }
		if(count($notifications)>0){
		return response()->json([
			'statuscode'=> 200,
            'status'  =>true,
            'data'  => $notifications,
            'notification_count'=> $count,
            'message' => 'notifications found'
		]);	
		}
	 }
}
