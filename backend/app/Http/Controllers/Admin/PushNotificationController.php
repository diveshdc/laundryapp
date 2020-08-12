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

         $pushNotification = PushNotification::all();
          $users =User::whereHas('roles', function($q){
                 $q->where('title', 'User');
             })->pluck('first_name','device_token');

          $drivers =User::whereHas('roles', function($q){
                 $q->where('title', 'Driver');
             })->pluck('first_name','device_token');
        return view('admin.push_notification.index', compact(['pushNotification','users','drivers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->users){
        $pushData = array(
            'device_token'=>$request->users,
            'title' =>'',
            'message'=>$request->message,
        );  
            $this->sendPush($pushData);
        }else if($request->drivers){
        $pushData = array(
            'device_token'=>$request->drivers,
            'title' =>'',
            'message'=>$request->message,
        );  
            $this->sendPush($pushData);
        }
        // if($request->check_drivers || $request->check_users){

        // }
       // abort_unless(\Gate::allows('push_create'), 403);

        // $roles = Role::all()->pluck('title', 'id');

        // return view('admin.push_notification.create', compact(''));
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
