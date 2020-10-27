<?php
namespace App\Http\Traits;
use Exception;
use App\User;
use App\CartItem;
use App\Order;
use App\OrderHistory;
use App\TimeSlot;

trait OrderTraits {

public function createOrder($input, $userInfo) {
		  		  $order                       = new Order;
	              $order->user_id             = $input['user_id'];
	              $order->collection_date     = date("y-m-d", strtotime($input['collection_date']));
	              $order->collection_time     = $input['collection_time'];
	              $order->delivery_date       = date("y-m-d", strtotime($input['delivery_date']));
	              $order->delivery_time       = $input['delivery_time'];
	              $order->cleaningInstructions= $input['cleaningInstructions'];
	              $order->is_couponcode       = $input['is_couponcode'];
	              $order->couponcode          = $input['couponcode']?$input['couponcode']:'';
	              $order->actual_price        = $input['actual_price']; 
	              $order->final_price         = $input['final_price'];
	              $order->is_skip_items       = $input['is_skip_items'];
	              $order->delivery_slot_id    = $input['delivery_slot_id'];
	              $order->collection_slot_id  = $input['collection_slot_id'];
	              $order->lat                 = $userInfo['lat'];
	              $order->lng                 = $userInfo['lng'];
	              $order->delivery_notes      = $input['delivery_notes'];
	              $order->status              = 'Placed';
	              $order->building_name_no    = $userInfo['building_name_no'];
	              $order->street_name         = $userInfo['street_name'];
	              $order->post_code           = $userInfo['post_code'];
	              $order->save();
	              return $order;
	}

	public function updateLoyalityPoints($userId,$points) {
			if($points >250){
			$remainingPoints =$points-250; 
			$lytpoint =$points-$remainingPoints;
			User::where('id', $userId)->update(['remaining_points' => $remainingPoints]);
			User::where('id', $userId)->update(['loyalty_point' => $lytpoint]);
			}else{
			$oldPoint = User::where('id', $userId)->select('loyalty_point')->first();
			$pointUpdate = $points+$oldPoint['loyalty_point'];
			$loyalityPoint = User::where('id', $userId)->update(['loyalty_point' => $pointUpdate]);
			}
			return;
		}

	public function createOrderHistory($createOrderHistory, $order, $chargeMeta, $charge) {
			foreach($createOrderHistory as $i => $orderHistory) {
					$orderHistory['order_id'] =$order->id;
					$orderHistory['status'] ='Placed';
					$orderHistory['transaction_id'] =$charge['balance_transaction'];
					$orderHistory['charge_id']   = $charge['id'];
					$orderHistory['stripe_meta'] =$chargeMeta;
				    $saveHistory[$i] = (new OrderHistory())->forceCreate($orderHistory->only(['user_id', 'order_id','quantity','product_id','category_id',
					    	'transaction_id','charge_id','stripe_meta','name','description',
					    	'image','price','sale_price','status']));
					    $saveHistory[$i]->save();
					}
					return $saveHistory;
		}

	public function updateTimeSlots($request) {
		//getting time slot is availiblity
			$availablity = TimeSlot::where('id','=',$request->collection_slot_id)
				 ->select('is_free_collection','is_free_collection_limit')->first();


				 if(!empty($availablity) && $availablity['is_free_collection_limit'] !=0){
				 	$decreaseTimeSlot = $availablity['is_free_collection_limit'] - 1;
//updating time slot
				    TimeSlot::where('id',$request->collection_slot_id)->update([
				 				'is_free_collection_limit' =>$decreaseTimeSlot
				 				]);
				 		}
				 $checkAvailablityAgain = TimeSlot::where('id',$request->collection_slot_id)
				 ->select('is_free_collection','is_free_collection_limit')->first();
//updating time slot again if collection slot empty
				 if(!empty( $checkAvailablityAgain) &&  $checkAvailablityAgain['is_free_collection_limit'] ==0){
				 		 TimeSlot::where('id','=',$request->collection_slot_id)->update([
				 				'is_free_collection' =>0
				 			]);
				 }

			 //getting time slot is availiblity
		$availablityDelivery = TimeSlot::where('id','=',$request->delivery_slot_id)
			 ->select('is_free_delivery','is_free_delivery_limit')->first();
			  if(!empty($availablityDelivery) && $availablityDelivery['is_free_delivery_limit'] !=0){
			 	$decreaseTimeSlot = $availablityDelivery['is_free_delivery_limit'] - 1;
//updating time slot
			    TimeSlot::where('id',$request->collection_slot_id)->update([
			 				'is_free_delivery_limit' =>$decreaseTimeSlot
			 				]);
			 		}

	 		 $checkAvailablityDeliveryAgain = TimeSlot::where('id',$request->delivery_slot_id)
				 ->select('is_free_delivery','is_free_delivery_limit')->first();
			//updating time slot again if collection slot empty
			 if(!empty( $checkAvailablityDeliveryAgain) &&  $checkAvailablityDeliveryAgain['is_free_delivery_limit'] ==0){
	 		 TimeSlot::where('id','=',$request->delivery_slot_id)->update([
	 				'is_free_delivery' =>0
	 			]);
	 		}
				 return;
		}

		public function clearcart($userId) {
			$cart = CartItem::where('user_id',$userId)->delete();
			return $cart;
		}
}