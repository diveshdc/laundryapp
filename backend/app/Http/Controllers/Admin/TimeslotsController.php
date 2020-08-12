<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTimeSlotRequest;
use Illuminate\Http\Request;
use App\TimeSlot;
use App\AdminTimeSlot;

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
 			$cTime = $timeSlot['collection_time_slot'];
			$collectionTimeSlot = explode("-",$cTime);
			$collectionTimeSlotArray = array(
				'collection_time_start'=> $collectionTimeSlot[0],
			    'collection_time_end'=> $collectionTimeSlot[1],
			    'is_free'		     => $timeSlot['is_free_collection'],
			    'collection_date'    => $timeSlot['collection_date'],
			);
 			$dTime = $timeSlot['delivery_time_slot'];
			$deliveryTimeSlot = explode("-",$dTime);
			$deliveryTimeSlotArray = array(
				'delivery_time_start'=> $deliveryTimeSlot[0],
			    'delivery_time_end'=> $deliveryTimeSlot[1],
			    'is_free'    	   => $timeSlot['is_free_delivery'],
			    'delivery_date'    => $timeSlot['delivery_date'],
			);
            // dd($deliveryTimeSlotArray);
 			return view('admin.timeslots.edit',compact('collectionTimeSlotArray','deliveryTimeSlotArray','timeSlotId'));
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
 
}
