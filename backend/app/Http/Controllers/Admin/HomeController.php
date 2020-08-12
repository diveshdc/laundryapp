<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
class HomeController
{
    public function index()
    {
    	$drivers=count(User::whereHas('roles', function($q){
    			$q->where('title', 'Driver')->where('is_request','0');
    		})->get());

    	$clients=count(User::whereHas('roles', function($q){
    			$q->where('title', 'Client');
    		})->get());

    	 $users=count(User::whereHas('roles', function($q){
    			$q->where('title', 'User');
    			})->get());

         $driver_request=count(User::whereHas('roles', function($q){
                $q->where('title', 'Driver')->where('is_request','1');})->get());

    	 return view('home', compact(['clients','drivers','users','driver_request']));


        // return view('home',compact('clients'));
    }
}