<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PushNotification;
use Auth;
class NotificationController extends Controller
{
	public function  getNotifications(){
		$notifications = PushNotification::orderBy('id','Desc')->where('user_id',Auth::user()->id)->get();
		return response()->json([
			'statuscode'=> 200,
            'status'  =>true,
            'data'  => $notifications,
            'message' => 'notifications found'
		]);
	 }
}
