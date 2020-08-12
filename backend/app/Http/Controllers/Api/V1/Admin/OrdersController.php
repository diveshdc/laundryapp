<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CartItem;
use App\Coupon;
use App\Product;
use App\OrderHistory;
use Validator;
use App\TimeSlot;
use App\Order;
use App\User;
use Auth;
use Config;
use Stripe;
use App\CardDetail;
use App\Helpers\Helper;
class OrdersController extends Controller
{
   public function addOrRemoveToCart(Request $request) {
    try{
   		$validator = Validator::make($request->all(), [ 
            'user_id'    => 'required',
            'product_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
        ],[
        	'user_id.required'    => 'user_id missing',
        	'product_id.required' => 'product_id missing',
    		]);
         if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                 return response()->json([
                    'status'  => false,
                    'message' => implode('<br />', $messages)
                ], 401); 
            }
            }
          $addProductOnCart = Helper::addToCart($request);
          if($addProductOnCart['quantity'] == 0){
            CartItem::where('user_id',$request['user_id'])->where('product_id',$request['product_id'])->delete();
          $addProductOnCart =CartItem::where('user_id',$request['user_id'])->where('product_id',$request['product_id'])->get();
          }
        if($addProductOnCart){
          return response()->json([
        'status'  => true, 
        'message' => 'success',
        'CartItem'    => $addProductOnCart
      ],200);
        }
      }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
   }

public function getCartItem($userId){
try{
  $cartData = CartItem::with('productInfo')->where('user_id',$userId)->get();
   if(count($cartData)>0){
              $data = array();
                foreach ($cartData as $key=> $item_value) {
                   // $data[] = array(
                    // $key;
                    $productData = $item_value->productInfo;
                    $productData['quantity'] = $item_value['quantity'];
                    $productData['user_id']  = $item_value['user_id'];
                  // );
                  array_push($data, $productData);
                }
                 // $json = json_encode($data, JSON_PRETTY_PRINT);
              }
              $items = CartItem::where('user_id',$userId)->sum('quantity');
              // dd($items);
              if(!empty($data) || $items >0){
               return response()->json([
                'status'        => true, 
                'message'       => 'success',
                'CartData'      => $data,
                'quantity_count'=>$items
              ],200);
             }else{
               return response()->json([
                'status'  => false, 
                'message' => 'not found',
              ],200);
             }
        }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
}

public function getTimeSlot(Request $request){
try{
  if($request->collection_date){
    $collection_time = TimeSlot::whereDate('collection_date', date("y-m-d", strtotime($request->collection_date)))->select('collection_time_slot','is_free_collection')->get(); 
      $collectionTime = array();
      foreach ($collection_time as $key => $value) {
        $timeslot['time_slot'] = $collection_time[0]['collection_time_slot'];
        $timeslot['is_free']   = $collection_time[0]['is_free_collection'];
         array_push($collectionTime, $timeslot);
      }
      if(!empty($collection_time)){
        return response()->json([
          'status'  =>true,
          'message' =>'timeslot found!',
          'timeslot'    => $collectionTime
        ],200);
      }else{
         return response()->json([
          'status'  =>false,
          'message' =>'timeslot not found!',
        ]);
      }
      }
    else if ($request->delivery_date) {
      $delivery_time = TimeSlot::whereDate('delivery_date',date("y-m-d", strtotime($request->delivery_date)))->select('delivery_time_slot','is_free_delivery')->get();

        $deliveryTime = array();
      foreach ($delivery_time as $key => $value) {
        $timeslot['time_slot'] = $delivery_time[0]['delivery_time_slot'];
        $timeslot['is_free']  = $delivery_time[0]['is_free_delivery'];
         array_push($deliveryTime, $timeslot);
      }
        if(!empty($delivery_time)){
        return response()->json([
          'status'  =>true, 
          'message' =>'timeslot found!',
          'timeslot'    => $deliveryTime
        ],200);
      }else{
         return response()->json([
          'status'  =>false,
          'message' =>'timeslot not found!',
        ]);
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


      public function getOrderHistory(Request $request) {
        try{
          $validator = Validator::make($request->all(), [ 
            'user_id'    => 'required',
        ],[
          'user_id.required'    => 'user_id missing',
        ]);
         if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                 return response()->json([
                    'status'  => false,
                    'message' => implode('<br />', $messages)
                ], 401); 
            }
            }
          $currentOrder =Helper::getCurrentOrders($request);
          $pastOrder = Helper::getPastOrders($request);
              if($currentOrder || $pastOrders){
        return response()->json([
            'status' =>true,
            'message'=>'Order History found!',
            'currentOrders' =>$currentOrder,
            'pastOrders' =>$pastOrder,
          ], 200);  
      }else{
              return response()->json([
                'status' =>false,
                'message'=>'Order history not found!',
                'currentOrders' =>$currentOrder,
                'pastOrders' =>$pastOrder,
              ], 200);  
      }
    }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
    }

      public function applyCoupon(Request $request){
        try{
        $validator = Validator::make($request->all(), [ 
            'couponcode'    => 'required',
            'actual_price'    => 'required',
        ],[
          'coupon_code.required'    => 'Coupon code missing!',
          'actual_price.required'    => 'Actual price missing!',
        ]);
         if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                 return response()->json([
                    'status'  => false,
                    'message' => implode('<br />', $messages)
                ], 401); 
            }
            }
          $couponCode = Coupon::where('coupon_code',$request['couponcode'])->select('price')->first();
          if(!empty($couponCode)){
            $returnData = array(
                'actual_price'=>  number_format($request['actual_price'],2),
                'final_price' =>  number_format(($couponCode['price'] / 100) * $request['actual_price'],2),
                'discount'    =>  number_format($request['actual_price'] - ($couponCode['price'] / 100) * $request['actual_price'],2),
              );
            return response()->json([
                'status'     => true,
                'couponData' => $returnData,
                'message'    => 'Valid coupon code!',
            ], 200);
          }else{
            return response()->json([
                'status' => false,
                'message' => 'Invalid Coupon Code!',
            ], 200);
          }
      }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
      }


public function reOrder(Request $request){
  try{
      $validator = Helper::validatReorder($request);
        if ($validator->fails()) {
              foreach ($validator->messages()->getMessages() as $field_name => $messages){
                   return response()->json([
                      'status'  => false,
                      'message' => implode('<br />', $messages)
                  ], 401); 
                }
          }
    $userInfo = Helper::getUserInfo($request['user_id']);
    $productIds = OrderHistory::where('order_id',$request['order_id'])->pluck('product_id');
    $checkProductsExist = Product::whereIn('id',$productIds)->count(); 
      if(count($productIds) ==  $checkProductsExist){
            $getProductsDetails = Product::whereIn('id',$productIds)->select('id','name','price','sale_price','image')->get(); 
            $actualPrice = 0;
           foreach ($getProductsDetails as  $productsDetail) {
                    $actualPrice += $productsDetail['sale_price'] ? $productsDetail['sale_price'] : 
                    $productsDetail['price'];
           }
           if($request['is_couponcode'] == 1 && !empty($request['couponcode'])){
                $coupon = Coupon::where('coupon_code',$request['couponcode'])->first();
                $finalPrice = $actualPrice - $coupon['price'];
           }else{
                $finalPrice = $actualPrice;
           }
           $customer = Helper::createCustomer($request['card_token']);
                  if(empty($customer['sources']['data'])){
                    return response()->json([
                      'status' =>false,
                      'message'=> 'Invalid card token',
                    ]);
                  }       
          if($customer){
                    Helper::saveCardDetails($request,$customer); 
                    $input = Helper::createReorderArray($request,$userInfo,$finalPrice);
                    $order = Order::create($input);
                    $charge = Helper::createCharge($customer->id,$order['final_price'],$order->id);
          if($charge['status'] == 'succeeded') {
                 User::where('id', $userInfo['id'])->update(['loyalty_point' => 10]);
                 $chargeMeta = json_encode($charge);
                 $createOrderHistory = OrderHistory::where('order_id',$request['order_id'])
                            ->with(array('get_product'=>function($query){
                            $query->select('id','price','sale_price');}))->get();
                            // return $createOrderHistory;
                 if(count($createOrderHistory)>0) {
                    Helper::createReorderHistory($createOrderHistory,$order->id,$charge,$chargeMeta);
                 }
                 return response()->json([
                    'status'     => true,
                    'message' => 'Payment successfull!',
                    'order_id'   =>  $order['id'],
                  ], 200); 
            }
              }
           // if($request['is_couponcode'] == 1){
           //          $request['coupon_code']    = $request['couponcode'];
           //  }else{
           //          $request['coupon_code']    = NULL;
           //  }

      }else{
         return response()->json([
          'status'  => false,
          'message' => 'Some items are missing in this order!'
      ],200);
      }
   }catch (\Exception $ex){
           return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
}


}
