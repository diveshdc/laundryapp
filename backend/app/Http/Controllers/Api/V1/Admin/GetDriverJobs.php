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
use Illuminate\Support\Arr;

class GetDriverJobs extends Controller
{
   public function getAssignedJobList() {
try{

// ->select('id','user_id','collection_date','collection_time',
//                             'delivery_date','delivery_time','status','lat','is_accepted','delivery_type',
//                             'lng','building_name_no','street_name','post_code',
//                             'is_collection','is_delivery')

    $jobList = Order::where('assign_to',Auth::user()->id)->whereIn('status',array('Placed','Onmyway'))->WhereIn('accept_reject',array('Assigned','Accept'))->with(array('userInfo'=>function($query){
    $query->select('id','first_name','last_name','phone_number','building_name_no','street_name','town');}))->get();
            return response()->json([
                'statuscode' =>200,
                'status' => true,
                'jobList'=> $jobList,
                'message'=> count($jobList)>0?'Assigned job found!':'No job Assigned'
            ],200);
    }catch (\Exception $ex){
                return response()->json([
                    'statuscode' =>200,
                    'status' => false,
                    'message' => $ex->getMessage(),
                    'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
                ], 200);
            }    
}

public function getAcceptedJobList() {
try{

// ->select('id','user_id','collection_date','collection_time',
//'delivery_date','delivery_time','status','lat','is_accepted','delivery_type',
//'lng','building_name_no','street_name','post_code')
     $jobList = Order::where('accept_reject','Accept')->orwhereIn('status',array('Arrived','Onmyway'))->Where('assign_to',Auth::user()->id)->with(array('userInfo'=>function($query){
                $query->select('id','first_name','last_name','phone_number','building_name_no','street_name','town');
            }))->get();
        return response()->json([
            'statuscode' =>200,
            'status' => true,
            'jobList'=> $jobList,
            'message'=> count($jobList)>0?'Accepted job found!':'No accepted job!'
        ],200);
    }catch (\Exception $ex){
                return response()->json([
                    'status' => false,
                    'message' => $ex->getMessage(),
                    'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
                ],200);
            }    
}

public function getJobHistory() {
try{

// ->select('id','user_id','collection_date','collection_time',
//                             'delivery_date','delivery_time','status','lat','is_accepted','delivery_type',
//                             'lng','building_name_no','street_name','post_code')
    // where('assign_to',Auth::user()->id)
    $jobList = Order::orderBy('updated_at','Desc')->where('status','Delivered')->orWhere('status','Cancelled')->orWhere('status','Rejected')
                 ->orWhere('status','Failed')
                 ->orWhere('status','Successful')->with(array('userInfo'=>function($query){
                $query->select('id','first_name','last_name','phone_number','building_name_no','street_name','town');
                    }))->get();
                return response()->json([
                    'statuscode' =>200,
                    'status' => true,
                    'jobList'=> $jobList,
                    'message'=> count($jobList)>0?'job history found!':'No job history found!'
                ],200);
            }catch (\Exception $ex){
                    return response()->json([
                        'status' => false,
                        'message' => $ex->getMessage(),
                        'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
                    ],200);
                }    
        }
}
