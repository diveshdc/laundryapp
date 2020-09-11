<?php
namespace App\Http\Traits;
use Exception;
use DateTime;
use DatePeriod;
use DateInterval;
use App\TimeSlot;
use Carbon\Carbon;


trait TimeSLotTrait {

// Function to get all the dates in given range 
private function getDatesFromRange($delivery_date, $end, $time, $format = 'd/m/Y') { 
    // Declare an empty array 
      
    // Variable that store the date interval 
    // of period 1 day 
    $interval = new DateInterval('P1D'); 
  
    $realEnd = new DateTime($end); 
    $realEnd->add($interval); 

    $period = new DatePeriod(new DateTime($delivery_date), $interval, $realEnd); 
  
    // Use loop to store date into array 
    foreach($period as $date) {
    	$savedData = TimeSlot::Insert([
    		'collection_date'=>$date->format($format),
    		'delivery_date'=>$date->format($format),
    		'is_free_collection_limit'=>4,
    		'is_free_delivery_limit'=>4
    	]);                  
    } 
  
    // Return the array elements 
    return $savedData; 
}

// getTimeSlot(IntervalInMinutes, $startTime, $endTime)
function collectionTime($sometimeOut, $start, $end)
{
	    $date =date('m/d/Y');
	    $delivery_date = date("m/d/Y", strtotime('+48 hours'));
	    for ($x = 1; $x <= 20; $x++) {
	    $start = new DateTime($start);
	    $end = new DateTime($end);
  			// echo "The number is: $x <br>";
	    	$BeginTimeStemp = $start->format('H:i:s'); // Get time Format in Hour and minutes
	    	$lastTimeStemp = $end->format('H:i:s');
	    	$hours = 24*$x;
	    	$delivery_hours = (24*$x)+48;
			$date =date('m/d/Y',strtotime('+'.$hours.' hours'));
			$delivery_date = date("m/d/Y", strtotime('+'.$delivery_hours.' hours'));
	    $j=0;
	    while(strtotime($BeginTimeStemp) <= strtotime($lastTimeStemp)){
	        $start = $BeginTimeStemp;
	        $end = date('H:i:s',strtotime('+'.$sometimeOut.' minutes',strtotime($BeginTimeStemp)));
	        $BeginTimeStemp = date('H:i:s',strtotime('+'.$sometimeOut.' minutes',strtotime($BeginTimeStemp)));
	        $j++;
	        if(strtotime($BeginTimeStemp) <= strtotime($lastTimeStemp)){
	            $savedData = TimeSlot::Insert([
		    		'collection_date'=>$date,
		    		'delivery_date'=> $delivery_date,
		    		'collection_time_start'=>$start,
		    		'collection_time_end'=>$end,
		    		'delivery_time_start'=>$start,
		    		'delivery_time_end'=>$end,
		    		'is_free_collection_limit'=>4,
		    		'is_free_delivery_limit'=>4,
		    		'is_free_collection'=>true,
		    		'is_free_delivery'=>true
	    	]);
        }
    }
}
    return $savedData;
}


}