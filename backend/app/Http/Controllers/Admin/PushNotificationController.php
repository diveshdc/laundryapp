<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\cr;
use App\PushNotification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Traits\PushNotificationTraits;

class PushNotificationController extends Controller
{
    use PushNotificationTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // abort_unless(\Gate::allows('push_access'), 403);

         $pushNotification = PushNotification::OrderBy('id','Desc')->where('sent_by','Admin')->get();
          $users =User::whereHas('roles', function($q){
                 $q->where('title', 'User')->select('id','first_name','last_name');
             })->get();


          $drivers =User::whereHas('roles', function($q){
                 $q->where('title', 'Driver');
             })->select('id','first_name','last_name')->get();
        return view('admin.push_notification.index', compact(['pushNotification','users','drivers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendPushNotification(Request $request)
    {
        if($request->users){
        $userId = User::select('id','device_token','device_type')->where('id',$request->users)->first();
        $pushData = array(
            'device_token'=>$userId['device_token'],
            'title' =>"Admin's message",
            'message'=>$request->message,
            'user_id' =>$request->users
        );  
            $this->saveNotification($pushData);
            if(!empty($userId['device_token']) && $userId['device_type'] =='iOS' ){
                $this->sendPushIos($pushData);
            }
             if(!empty( $userId['device_token']) && $userId['device_type'] =='Android' ){
                    $this->sendPush($pushData);
                }
        }
        if($request->drivers){
        $driverId = User::where('id',$request->drivers)->select('id','device_token','device_type')->first();
        $pushData = array(
            'device_token'=>$driverId['device_token'],
            'title' =>"Admin's message",
            'message'=>$request->message,
            'user_id' =>$request->drivers
        ); 
            $this->saveNotification($pushData); 
                if(!empty($driverId['device_token']) && $driverId['device_type'] =='iOS' ){
                $this->sendPushIos($pushData);
            }
            // dd($driverId);
             if(!empty($driverId['device_token']) && $driverId['device_type'] =='Android' ){
                    $this->sendPush($pushData);
                }
        }
        if($request->check_drivers){
          $drivers =User::whereHas('roles', function($q){
                 $q->where('title', 'Driver');
             })->select('id','device_token','device_type')->get();
            $this->sendAndSave($drivers, $request);
        }
        if ($request->check_users) {
        $users =User::whereHas('roles', function($q){
                 $q->where('title', 'User');
             })->select('id','device_token','device_type')->get();
         $this->sendAndSave($users, $request);
        }

        return redirect()->back()->with('success', 'Push notification sent successfully!');   

       // abort_unless(\Gate::allows('push_create'), 403);

        // $roles = Role::all()->pluck('title', 'id');

        // return view('admin.push_notification.create', compact(''));
    }

    protected function saveNotification($data) {
          $notificationCount = PushNotification::where('user_id',$data['user_id'])->select('pending_count')->first();
        PushNotification::insert([
            'user_id'=>$data['user_id'],
            'sent_by' =>'Admin',
            'notification'=>$data['message'],
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
        PushNotification::where('user_id',$data['user_id'])->update([
            'pending_count'=>$notificationCount['pending_count']+1,
        ]);

        return;
    }

    protected function sendAndSave($data, $request) {
        foreach ($data as $value) {
                    $pushData = array(
                            'device_token'=> $value['device_token'],
                            'title' =>"Admin's message",
                            'message'=>$request->message,
                            'user_id' =>$value['id']
                        );
               $notificationCount = PushNotification::where('user_id',$value['id'])->select('pending_count')->first();
               PushNotification::where('user_id',$value['id'])->insert([
                        // 'pending_count'=>$notificationCount['pending_count']+1,
                        'notification'=>$request->message,
                        'user_id' =>$value['id'],
                        'sent_by' =>'Admin',
                        'created_at'=>date('Y-m-d'),
                        'updated_at'=>date('Y-m-d')

               ]); 
               PushNotification::where('user_id',$value['id'])->update([
                'pending_count'=>$notificationCount['pending_count']+1,
                ]);
               if(!empty( $value['device_token']) && $value['device_type'] =='Android' ){
                    $this->sendPush($pushData);
                }
                 if(!empty($value['device_token']) && $value['device_type'] =='ios' ){
                    // dd($value);   
                     $this->sendPushIos($pushData);
                }
             }
        return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
