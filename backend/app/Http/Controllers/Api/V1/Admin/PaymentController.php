<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\StripeTraits;
use App\Http\Traits\OrderTraits;
use App\Mail\OrderConfirmation;
use App\OrderHistory;
use App\CardDetail;
use App\CartItem;
use App\Order;
use Validator;
use Exception;
use App\User;
use Session;
use Stripe;
use Input;
use Auth;
use DB;
use Mail;
use Config;
use App\TimeSlot;
class PaymentController extends Controller
{
	use StripeTraits;
	use OrderTraits;
    public function addCardDetails(Request $request){
    try{
		 $validator     = Validator::make($request->all(), [
		 'card_no'      => 'required',
		 'expiry_month' => 'required',
		 'expiry_year'  => 'required',
		 'cvv'          => ['required', 'digits:3'],
		 //'amount' => 'required',
		 ]);
		  if ($validator->fails()) {
            return $this->sendValidationMessage($validator);
           	 }
		     $stripe = Stripe\Stripe::setApiKey(Config::get('services.stripe.secret'));
		        // create card token
			   $token = $this->createToken($request);
		 		return $token->id;
			   #Create new customer
			  $customer = $this->createCustomer(Auth::user()->email, $token->id);
			return response()->json([
					'status'    => true,
					'message'	=> 'Card added successfully!',
					'card_id'   => $customer['sources']['data'][0]['id'],
			]);
		}catch (\Exception $ex){
		            return $this->returnException($ex);
		        }
	}

public function chargeOrder(Request $request) {
	try{
	 	$userInfo = User::where('id',$request->user_id)->select('id','building_name_no','email','street_name','town','lat','lng','post_code','first_name','last_name')->first();
		// dd($request);
		 $validator = Validator::make($request->all(), [ 
            'user_id'         => 'required',
            // 'collection_date' => 'required',
            // 'collection_time' => 'required',
            // 'delivery_date'   => 'required', 
            // 'delivery_time'   => 'required', 
            'is_couponcode'   => 'required',
            'actual_price'    => 'required',
            'card_token'		  => 'required',
             ]);
         if ($validator->fails()) {
            return $this->sendValidationMessage($validator);
            }
		 $stripe= Stripe\Stripe::setApiKey(Config::get('services.stripe.secret'));
		 $customer = $this->createCustomer(Auth::user()->email, $request['card_token']);
            if($customer){
				  $input = $request->all();
				  //creating Customer
            		$order = $this->createOrder($input, $userInfo);         
					 //creating Order 
           $charge =$this->createCharge($customer['customer_id'], $userInfo, $request, $order->id);         
	 	   	if($charge['status'] == 'succeeded') {
	 	   		$loyalityPoint = $this->updateLoyalityPoints($userInfo['id'],$request['final_price']);
          //updateTimeslot booking time
         $timeSlot = $this->updateTimeSlots($request);
	 	   		$chargeMeta = json_encode($charge);
				   //get cart items for creating the order history
          $orderItems='';
          if($request->is_skip_items ==0){
				    $createOrderHistory = CartItem::where('user_id',$userInfo['id'])->get();
				    //creating Order  History
    	 		  if(count($createOrderHistory)>0){
    				  $orderItems = $this->createOrderHistory($createOrderHistory, $order, $chargeMeta, $charge);
    				 }
          }
          // if($request->is_skip_items ==1){

          // }
              if(!empty($order)){
              	$this->clearCart($userInfo['id']);
                  Mail::to($userInfo['email'])->send(new OrderConfirmation($order,$orderItems,$userInfo));
                  return response()->json([
                    'status'     => true,
                    'message' => 'Payment successfull!',
                    'order_id'   =>  $order['id'],
                ], 200); 
              }
	 	}
	}
	}catch (\Exception $ex){
	             return $this->returnException($ex);
	        }
}

public function cancelOrder(Request $request) {
	try{
		 $validator = Validator::make($request->all(), [ 
            'order_id'               => 'required',
          ],
             ['order_id.required' => 'Order id missing!'
         ]);
         if ($validator->fails()) {
           return $this->sendValidationMessage($validator);
            }
            // $finalprice = Order::where('id',$request['order_id'])->select('final_price')->first();
            $loyalityPoints = User::where('id',Auth::user()->id)->select('loyalty_point')->first();

            if($loyalityPoints['loyalty_point'] >= $request->final_price){
            $updatedLoyalityPoints = $loyalityPoints['loyalty_point'] - $request->final_price;
            }
            if($request->final_price>=$loyalityPoints['loyalty_point']){
            $updatedLoyalityPoints = $request->final_price - $loyalityPoints['loyalty_point'];
            }
            Order::where('id',$request['order_id'])->update(['status'=> 'Cancelled']);
            $collectionAvailablity = TimeSlot::where('id','=',$request->collection_slot_id)
                                          ->select('is_free_collection','is_free_collection_limit',
                                                   'is_free_delivery_limit')->first();
         if(!empty($collectionAvailablity) && $collectionAvailablity['is_free_collection_limit'] < 100){
          if($collectionAvailablity['is_free_collection'] ==0){
                TimeSlot::where('id',$request->collection_slot_id)->update([
                                'is_free_collection' =>1
              ]);
          }
          $increaseTimeSlot = $collectionAvailablity['is_free_collection_limit'] + 1;
          //updating time slot
            TimeSlot::where('id',$request->collection_slot_id)->update([
                'is_free_collection_limit' =>$increaseTimeSlot
              ]);
           }
// update delivery slot
            $collectionAvailablity = TimeSlot::where('id','=',$request->delivery_slot_id)
                                            ->select('is_free_delivery',
                                                'is_free_delivery_limit')->first();
            if(!empty($availablity) && $availablity['is_free_delivery_limit'] < 100){
              if($availablity['is_free_delivery'] ==0){
                    TimeSlot::where('id',$request->collection_slot_id)->update([
                                    'is_free_delivery' =>1
                  ]);
              }
              $increaseTimeSlot = $availablity['is_free_delivery_limit'] + 1;
              //updating time slot
                TimeSlot::where('id',$request->delivery_slot_id)->update([
                    'is_free_delivery_limit' =>$increaseTimeSlot
                  ]);
           }
            OrderHistory::where('order_id',$request['order_id'])->update(['status'=> 'Cancelled']);
            User::where('id',Auth::user()->id)->update([
              'loyalty_point'=> $updatedLoyalityPoints
            ]);
            return response()->json([
            	'status' =>true,
            	'message'=>'Your Spotlex cancel request processed.'
            ],200);
		}catch (\Exception $ex){
	            return $this->returnException($ex);
	        }
}

  protected function returnException($ex){
     		return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
    }

    	protected function sendValidationMessage($validator){
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                 return response()->json([
                    'status'  => false,
                    'message' => implode('<br />', $messages)
                ], 401); 
            }
    }
}
