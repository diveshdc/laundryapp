<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTimeSlotRequest;
use Illuminate\Http\Request;
use App\TimeSlot;
use App\AdminTimeSlot;
use DateTime;
use DatePeriod;
use DateInterval;

class TimeslotsController extends Controller
{
  public function index(){
 		// abort_unless(\Gate::allows('timeslot_access'), 403);
  		$timeslots = TimeSlot::all();
 		return view('admin.timeslots.index',compact('timeslots'));
 }  

 public function create(){
        $adminTimeslots = AdminTimeSlot::all();
 	 	// abort_unless(\Gate::allows('timeslot_create'), 403);
 			return view('admin.timeslots.create',compact('adminTimeslots'));
 }

 // public function store(Request $request) {
 // 	  // abort_unless(\Gate::allows('timeslot_create'), 403);
 // 	$timeSlot = TimeSlot::create([
 //            'collection_date'       =>$request['collection_date'],
 //            'collection_time_slot'  =>$request['collection_time_start'].'-'.$request['collection_time_end'],
 //            'delivery_date'      =>$request['delivery_date'],
 //            'delivery_time_slot' =>$request['delivery_time_start'].'-'.$request['delivery_time_end'],
 //        ]);
 //        $timeSlot->save();
	// 		// $timeSlot = TimeSlot::create($request->all());
 // 			return redirect()->route('admin.timeslot.index');
 // } 


 public function createTimeSlot(Request $request) {
    if($request->type =='collection'){
    foreach ($request->slot_data as $slotValue) {
        $slotData = json_decode($slotValue);
        $timeSlot = TimeSlot::insert([
            'collection_date'         =>  $request->date,
            'collection_time_start'   =>  $slotData->start_time,
            'collection_time_end'     =>  $slotData->end_time,
            'is_free_collection_limit'=>  $slotData->maximum_order,
            'is_free_delivery_limit'=>  0,

        ]);
    }   
    }
    if($request->type =='delivery') {
         foreach ($request->slot_data as $slotValue) {
             $slotData = json_decode($slotValue);
            $timeSlot = TimeSlot::insert([
                'delivery_date'         => $request->date,
                'delivery_time_start'   => $slotData->start_time,
                'delivery_time_end'     => $slotData->end_time,
                'is_free_delivery_limit'=> $slotData->maximum_order,
                'is_free_collection_limit'=> 0,
            ]);
        } 
    }
        return response()->json(['success' => true]);
 }

 public function edit($id) {
 	  // abort_unless(\Gate::allows('timeslot_create'), 403);
 			$timeSlot= TimeSlot::find($id);
 			// dd($timeSlot);
 			$timeSlotId = $timeSlot['id'];
 		// 	$cTime = $timeSlot['collection_time_slot'];
			// $collectionTimeSlot = explode("-",$cTime);
			// $collectionTimeSlotArray = array(
			// 	'collection_time_start'=> $collectionTimeSlot[0],
			//     'collection_time_end'=> $collectionTimeSlot[1],
			//     'is_free'		     => $timeSlot['is_free_collection'],
			//     'collection_date'    => $timeSlot['collection_date'],
			// );
 		// 	$dTime = $timeSlot['delivery_time_slot'];
			// $deliveryTimeSlot = explode("-",$dTime);
			// $deliveryTimeSlotArray = array(
			// 	'delivery_time_start'=> $deliveryTimeSlot[0],
			//     'delivery_time_end'=> $deliveryTimeSlot[1],
			//     'is_free'    	   => $timeSlot['is_free_delivery'],
			//     'delivery_date'    => $timeSlot['delivery_date'],
			// );
            // dd($deliveryTimeSlotArray);
 			return view('admin.timeslots.edit',compact('timeSlot','timeSlotId'));
 }

 public function getSlotInfo(Request $request) {
            $newDate = date("m/d/Y", strtotime($request->date));
            if($request->type =='collection'){
                 $collectionTime = TimeSlot::where('collection_date','=',$newDate)->select('id','collection_date','collection_time_start','collection_time_end','blocked_collection_slot','delivery_time_period','is_free_collection','is_free_collection_limit','block_collection_date')->get(); 
                  $timePeriod = null;
                  $blockenDate =null;
                  if(count($collectionTime)>0){
                    $timePeriod = $collectionTime[0]->delivery_time_period;
                    $blockenDate = $collectionTime[0]->block_collection_date;
                  }
                    return response()->json([
                      'status'  =>true,
                      'message' =>'timeslot found!',
                      'timeslot'    => $collectionTime,
                      'type'=>'collection',
                      'timePeriod'=>  $timePeriod,
                      'blockedDate'=>$blockenDate
                    ],200);
                }
                 if($request->type =='delivery'){
                 $deliveryTime = TimeSlot::where('delivery_date','=',$newDate)->select('id','blocked_delivery_slot','delivery_date','delivery_time_start','delivery_time_end','delivery_time_period','is_free_delivery','block_delivery_date','is_free_delivery_limit')->get(); 
                  $timePeriod = null;
                   $blockenDate =null;
                  if(count($deliveryTime)>0){
                    $timePeriod = $deliveryTime[0]->delivery_time_period;
                      $blockenDate = $deliveryTime[0]->block_delivery_date;
                  }
                    return response()->json([
                      'status'  =>true,
                      'message' =>'timeslot found!',
                      'timeslot'    => $deliveryTime,
                      'type'=>'delivery',
                      'timePeriod'=>  $timePeriod,
                      'blockedDate'=> $blockenDate
                    ],200);
                }
            }  



 public function update(Request $request, $id) {
 	  // abort_unless(\Gate::allows('timeslot_create'), 403);
 	$timeSlot=TimeSlot::where('id', '=',$id)->update([
 		'collection_date'       => $request['collection_date'],
 		'collection_time_slot'  => $request['collection_time_start'].'-'.$request['collection_time_end'],
 		'delivery_date'         => $request['delivery_date'],
 		'delivery_time_slot'    => $request['delivery_time_start'].'-'.$request['delivery_time_end']
 	]);
 			return redirect()->route('admin.timeslot.index');
 }

 public function SaveSlotsData(Request $request) {
      // abort_unless(\Gate::allows('timeslot_create'), 403);
    if($request->type=='period_update'){
         $newDate = date("m/d/Y", strtotime($request->date));
            Timeslot::where('collection_date','=',$newDate)->update([
            'delivery_time_period'=>$request->value
    ]);
    return response()->json([
      'status'  =>true,
      'message' =>'delivery time period updated successfully'
    ],200);
    }
    if($request->type=='block_timeslot'){
            $coloumn = $request->coll_del =='collection'?'blocked_collection_slot':'blocked_delivery_slot';
            Timeslot::where('id',$request->id)->update([
            $coloumn=>$request->value
    ]);
    return response()->json([
      'status'  =>true,
      'message' =>'this collection slot blocked successfully'
    ],200);
    }
    if($request->type=='block_dateslot'){
          $newDate = date("m/d/Y", strtotime($request->date));
            $coloumn = $request->coll_del =='collection'?'block_collection_date':'block_delivery_date';
            $whereColoumn = $request->coll_del =='collection'?'collection_date':'delivery_date';
            Timeslot::where($whereColoumn,'=',$newDate)->update([
                $coloumn=>$request->value
            ]);
            Timeslot::where('collection_date','=',$newDate)->update([
                $coloumn=>$request->value
            ]);
    return response()->json([
      'status'  =>true,
      'message' =>'this '.$request->coll_del.' date slot blocked successfully'
    ],200);
    }

    else{
    Timeslot::where('id',$request->slot_id)->update([
        'is_free_collection_limit'=>$request->value
    ]); 
     return response()->json([
              'status'  =>true,
              'message' =>'data updated successfully'
            ],200);
    }
 }

 //  public function show($id) {
	
	// $timeSlot = Timeslot::where('id',$id)->get();
 // 	return view('admin.timeslots.show',compact('timeSlot'));
 // }

   public function destroy($id)
    {
        // abort_unless(\Gate::allows('timeslot_delete'), 403);
        $timeSlot = TimeSlot::find($id)->delete();
        return back();
    }

    public function massDestroy(MassDestroyTimeSlotRequest $request)
    {
        // abort_unless(\Gate::allows('timeslot_delete'), 403);
        TimeSlot::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }


    function collectionTime()
    {
        $date_arr = [];
        for($i=1; $i<=20; $i++){
            $date_arr[] = date('m/d/Y', strtotime("+".$i."days"));
        }
        foreach ($date_arr as $key => $value) {
            $starttime = '00:00';  // your start time
            $endtime = '23:00';  // End time
            $duration = '60';  // split by 60 mins
            $array_of_time = array ();
            $start_time    = strtotime ($starttime); //change to strtotime
            $end_time      = strtotime ($endtime); //change to strtotime
            $add_mins  = $duration * 60;
            while ($start_time <= $end_time) // loop between time
            {
                $endTime = $start_time+$add_mins; //Endtime check1

                $delivery_date = date('m/d/Y', strtotime($value. '+ 2 days'));
                $savedData = TimeSlot::Insert([
                     'collection_date'=>$value,
                     'delivery_date'=> $delivery_date,
                     'collection_time_start'=> date ("h:i A",$start_time),
                     'collection_time_end'=>date ("h:i A", $endTime),
                     'delivery_time_start'=>date ("h:i A",$start_time),
                     'delivery_time_end'=>date ("h:i A", $endTime),
                     'is_free_collection_limit'=>4,
                     'is_free_delivery_limit'=>4,
                     'is_free_collection'=>true,
                     'is_free_delivery'=>true
                ]);
                $start_time += $add_mins; //Endtime check1
            }
        }
        return 'success!';
    }


}
