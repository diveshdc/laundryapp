<?php
namespace App\Http\Traits;
use Exception;
use App\User;
use App\CardDetail;
use Session;
use Stripe;
use Auth;

trait StripeTraits {

public function createCustomer($userEmail,$cardToken) {
		 $customer = \Stripe\Customer::create(array(
	        'email' => $userEmail,
	        "source" => $cardToken
	    )); 
		  if(!empty($customer)){         
            $cardData = array(
				    'user_id'    => Auth::user()->id,
				    'customer_id'=> $customer['id'],
				    'card_id'    => $customer['sources']['data'][0]['id'],
				    'last_four'  => $customer['sources']['data'][0]['last4'],
				    'brand'      => $customer['sources']['data'][0]['brand'],
				    'exp_month'  => $customer['sources']['data'][0]['exp_month'],
				    'exp_year'   => $customer['sources']['data'][0]['exp_year']
			);
			 CardDetail::create($cardData);
			 return $cardData;
		}else{
				return response()->json([
            		'status' =>false,
            		'message'=> 'Invalid card token',
            	]);
		}
	}

public function createToken($request) {
		$token = \Stripe\Token::create([
				 'card' => [
				 'number' => $request->card_no,
				 'exp_month' => $request->expiry_month,
				 'exp_year' => $request->expiry_year,
				 'cvc' => $request->cvv,
				 ],
			]);
		return $token;
	}

public function createCharge($customerId, $userInfo, $request, $orderId) {
	 $charge = \Stripe\Charge::create([
 				'customer'    => $customerId,
 				'currency'    => 'GBP',
 				'amount'      =>  number_format($request['final_price'],2)*100,
 				'description' => 'Amount received against order'.$orderId,
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
		return $charge;
	}
}