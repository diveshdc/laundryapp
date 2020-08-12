<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use Config;

class PaymentController extends Controller
{
    public function addCardDetails(Request $request){
    try{
		 // $validator     = Validator::make($request->all(), [
		 // 'card_no'      => 'required',
		 // 'expiry_month' => 'required',
		 // 'expiry_year'  => 'required',
		 // 'cvv'          => ['required', 'digits:3'],
		 // //'amount' => 'required',
		 // ]);
		 //  if ($validator->fails()) {
   //          foreach ($validator->messages()->getMessages() as $field_name => $messages){
   //               return response()->json([
   //                  'status'  => false,
   //                  'message' => implode('<br />', $messages)
   //              ], 401); 
   //          }
   //          }
			     $stripe = Stripe\Stripe::setApiKey('sk_test_5oNEANMo71RzIz5OQ1j8psso00mnwk66v2');
			        // create card token
				   $token = \Stripe\Token::create([
						 'card' => [
						 'number' => $request->get('card_no'),
						 'exp_month' => $request->get('expiry_month'),
						 'exp_year' => $request->get('expiry_year'),
						 'cvc' => $request->get('cvv'),
						 ],
			]);
			 $card_token = $token->id;
			 return $card_token;
			   #Create new customer
            $customer = \Stripe\Customer::create(array(
                'email' => Auth::user()->email,
                "source" => $card_token
            )); 
            if($customer){         
            $cardData = array(
				    'user_id'    => Auth::user()->id,
				    'customer_id'=>$customer['id'],
				    'card_id'    => $customer['sources']['data'][0]['id'],
				    'last_four'  =>$customer['sources']['data'][0]['last4'],
				    'brand'      =>$customer['sources']['data'][0]['brand'],
				    'exp_month'  =>$customer['sources']['data'][0]['exp_month'],
				    'exp_year'   =>$customer['sources']['data'][0]['exp_year']
			);
			return response()->json([
				'data'=>$cardData
			]);
			$saveCardData = CardDetail::create($cardData);
			return response()->json([
					'status'    => true,
					'message'	=> 'Card added successfully!',
					'card_id'   => $customer['sources']['data'][0]['id'],
			]);
		}
	}catch (\Exception $ex){
	            return response()->json([
	                'status' => false,
	                'message' => $ex->getMessage(),
	                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
	            ], 200);
	        }
}

public function chargeOrder(Request $request) {
	try{
	 	$userInfo = User::where('id',$request->user_id)->select('id','building_name_no','street_name','town','lat','lng','post_code','first_name','last_name')->first();
		// dd($request);
		 $validator = Validator::make($request->all(), [ 
            'user_id'               => 'required',
            'collection_date'       => 'required',
            'collection_time'       => 'required',
            'delivery_date'         => 'required', 
            'delivery_time'         => 'required', 
            'is_couponcode'         => 'required',
            'actual_price'          => 'required',
            'card_token'			=> 'required',
             ]);
         if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                 return response()->json([
                    'status'  => false,
                    'message' => implode('<br />', $messages)
                ], 401); 
              }
            }
		 $stripe= Stripe\Stripe::setApiKey(Config::get('services.stripe.secret'));
		 $card_token = $request['card_token'];
			   #Create new customer
            $customer = \Stripe\Customer::create(array(
                'email' => Auth::user()->email,
                "source" => $card_token
            )); 
            if(empty($customer['sources']['data'])){
            	return response()->json([
            		'status' =>false,
            		'message'=> 'Invalid card token',
            	]);
            }
            if($customer){         
            $cardData = array(
				    'user_id'    => Auth::user()->id,
				    'customer_id'=>$customer['id'],
				    'card_id'    =>$customer['sources']['data'][0]['id'],
				    'last_four'  =>$customer['sources']['data'][0]['last4'],
				    'brand'      =>$customer['sources']['data'][0]['brand'],
				    'exp_month'  =>$customer['sources']['data'][0]['exp_month'],
				    'exp_year'   =>$customer['sources']['data'][0]['exp_year']
			);
            //Save card details
				 CardDetail::create($cardData);
				 //creating Order 
				  $input                      = $request->all();
	              $order                      = new Order;
	              $order->user_id             = $input['user_id'];
	              $order->collection_date     = date("y-m-d", strtotime($input['collection_date']));
	              $order->collection_time     = $input['collection_time'];
	              $order->delivery_date       = date("y-m-d", strtotime($input['delivery_date']));
	              $order->delivery_time       = $input['delivery_time'];
	              $order->cleaningInstructions= $input['cleaningInstructions'];
	              $order->is_couponcode       = $input['is_couponcode'];
	              $order->couponcode          = $input['couponcode'];
	              $order->actual_price        = $input['actual_price']; 
	              $order->final_price         = $input['final_price'];
	              $order->is_skip_items       = $input['is_skip_items'];
	              $order->lat                 = $userInfo['lat'];
	              $order->lng                 = $userInfo['lng'];
	              $order->delivery_notes      = $input['delivery_notes'];
	              $order->status              = 'Placed';
	              $order->building_name_no    = $userInfo['building_name_no'];
	              $order->street_name         = $userInfo['street_name'];
	              $order->post_code           = $userInfo['post_code'];
	              $order->save();
					 $charge = \Stripe\Charge::create([
			 				'customer'    => $customer->id,
			 				'currency'    => 'GBP',
			 				'amount'      =>  number_format($request['final_price'],2)*100,
			 				'description' => 'Amount received against order'.$order->id,
			 				'shipping'    => [
						    'name'        => $userInfo['first_name'].' '.$userInfo['last_name'],
						    'address'     => [
						    'line1'       => $userInfo['building_name_no'].' '.$userInfo['street_name'],
						    'postal_code' => $userInfo['post_code'],
						    'city'        => $userInfo['town'],
						    'state'       => 'CA',
						    'country'     => 'UK',
						    ],
						  ],
	 				]);
	 	   if($charge['status'] == 'succeeded') {
	 	   		User::where('id', $userInfo['id'])->update(['loyalty_point' => 10]);
	 	   		$chargeMeta = json_encode($charge);
				   //get cart items for creating the order history
				   $createOrderHistory = CartItem::where('user_id',$userInfo['id'])->get();
				    //creating Order  History
	 		  if(count($createOrderHistory)>0){
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
				 }
              if(!empty($order)){
              	CartItem::where('user_id',$userInfo['id'])->delete();
                  return response()->json([
                    'status'     => true,
                    'message' => 'Payment successfull!',
                    'order_id'   =>  $order['id'],
                ], 200); 
              }
	 }
}
	}catch (\Exception $ex){
	            return response()->json([
	                'status' => false,
	                'message' => $ex->getMessage(),
	                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
	            ], 200);
	        }
}

public function cancelOrder(Request $request) {
	try{
		 $validator = Validator::make($request->all(), [ 
            'order_id'               => 'required',
             ],['order_id.required' => 'Order id missing!'
         ]);
         if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                 return response()->json([
                    'status'  => false,
                    'message' => implode('<br />', $messages)
                ], 401); 
            }
            }

            // $cancelOrder = 
            Order::where('id',$request['order_id'])->update(['status'=> 'Cancelled']);
            // $changeOrderHistoryStatus = 
            OrderHistory::where('order_id',$request['order_id'])->update(['status'=> 'Cancelled']);
            return response()->json([
            	'status' =>true,
            	'message'=>'Your Spotlex cancel request processed.'
            ],200);
	}catch (\Exception $ex){
	            return response()->json([
	                'status' => false,
	                'message' => $ex->getMessage(),
	                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
	            ], 200);
	        }
}
}
