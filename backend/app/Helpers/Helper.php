<?php
namespace App\Helpers;
use App\OrderHistory;
use App\CardDetail;
use App\CartItem;
use App\Order;
use App\User;
use Session;
use Stripe;
use Config;
use Auth;
use Validator;
class Helper
{
    public static function imploadValue($types){
        $strTypes = implode(",", $types);
        return $strTypes;
  }
 
  public static function explodeValue($types){
      $strTypes = explode(",", $types);
      return $strTypes;
  }
 
  public static function random_code(){
      return rand(1111, 9999);
  }

  public static function validatReorder($request) {

    $validator = Validator::make($request->all(), [ 
            'user_id'               => 'required',
            'collection_date'       => 'required',
            'collection_time'       => 'required',
            'delivery_date'         => 'required', 
            'delivery_time'         => 'required', 
            'is_couponcode'         => 'required',
            'card_token'            => 'required',
             ]);
    return $validator;
  }

  public static function addToCart($request) {
   $addProductOnCart = CartItem::updateOrCreate([
            'user_id'=>$request['user_id'],
            'product_id'=>$request['product_id']
          ],[
            'quantity'=>$request['quantity'],
            'category_id'=>$request['category_id'],
            'name'       =>$request['name'],
            'description'=>$request['description'],
            'price'=>$request['price'],
            'sale_price'=>$request['sale_price'],
            'image'=>$request['image'],
          ]);
   return $addProductOnCart;
  }

  public static function getCurrentOrders($request) {
    $currentOrder = Order::orderBy('id', 'DESC')->where('user_id',$request['user_id'])
                  ->whereIn('status',['Placed','Collected','Inprogress'])
                  ->select('id','user_id','collection_date','collection_time',
                           'delivery_date','delivery_time','cleaningInstructions',
                           'actual_price','final_price','status',
                           'building_name_no','street_name','post_code','delivery_slot_id','collection_slot_id',
                           'delivery_notes','lat','lng','is_skip_items',
                           'created_at','updated_at')
                  ->with(array('productList'=>function($query){
    $query->select('order_id','user_id','product_id',
                   'quantity','category_id','name','description',
                   'image','price','sale_price','status',
                   'created_at','updated_at');}))->get();
      return $currentOrder;
  }

  public static function getPastOrders($request) {
    $pastOrder = Order::orderBy('id', 'DESC')->where('user_id',$request['user_id'])
                ->whereIn('status',['Delivered','Cancelled'])
                ->select('id','user_id','collection_date',
                         'collection_time','delivery_date','delivery_time',
                         'cleaningInstructions','actual_price',
                         'final_price','status','building_name_no','collection_slot_id','delivery_slot_id',
                         'street_name','post_code',
                         'delivery_notes','lat','lng','is_skip_items',
                         'created_at','updated_at')
                ->with(array('productList'=>function($query){
  $query->select('order_id','user_id','product_id',
                 'quantity','category_id','name','description',
                 'image','price','sale_price','status',
                 'created_at','updated_at');}))->get();
    return $pastOrder;
  }

  public static function validateOrder($request) {

    $validator = Validator::make($request->all(), [ 
            'user_id'               => 'required',
            'collection_date'       => 'required',
            'collection_time'       => 'required',
            'delivery_date'         => 'required', 
            'delivery_time'         => 'required', 
            'is_couponcode'         => 'required',
            'actual_price'          => 'required',
            'card_token'      => 'required',
             ]);
    return $validator;
  }

  public static function getUserInfo($userId){
       $userInfo = User::where('id',$userId)
                  ->select('id','building_name_no','street_name',
                    'town','lat','lng','post_code','first_name',
                    'last_name')->first();
                  if(!empty($userInfo)){
                      return $userInfo;
                  }else{
                    return 'null';
                  }
  }

  public static function orderStatusCancel($orderId) {
                $orderStatusCancel =Order::where('id',$orderId)
                ->update(['status'=> 'Cancelled']);
                $orderStatusCancel = OrderHistory::where('order_id',$orderId)
                ->update(['status'=> 'Cancelled']);
                return $orderStatusCancel;
  }

  public static function createCustomer($card_token) {
    Stripe\Stripe::setApiKey(Config::get('services.stripe.secret'));
    $customer = \Stripe\Customer::create(array(
                'email' => Auth::user()->email,
                "source" => $card_token
            )); 
    return $customer;
  }

  public static function saveCardDetails($request, $customer) {
     $cardData = array(
           'user_id'    => $request['user_id'],
           'customer_id'=> $customer['id'],
           'card_id'    => $customer['sources']['data'][0]['id'],
           'last_four'  => $customer['sources']['data'][0]['last4'],
           'brand'      => $customer['sources']['data'][0]['brand'],
           'exp_month'  => $customer['sources']['data'][0]['exp_month'],
           'exp_year'   => $customer['sources']['data'][0]['exp_year']
      );
       $cardSave = CardDetail::create($cardData);
      return $cardSave;
  }

  public static function createCharge($customerId, $finalPrice,$orderId) {
        Stripe\Stripe::setApiKey(Config::get('services.stripe.secret'));
               $charge = \Stripe\Charge::create([
                        'customer'    => $customerId,
                        'currency'    => 'GBP',
                        'amount'      =>  number_format($finalPrice,2)*100,
                        'description' => 'Amount received against order'.$orderId 
                    ]);
      return $charge;
  }

  public static function createArray($request, $userInfo) {
          $input                     = $request->all();
          $input['delivery_date']    = date("y-m-d", strtotime($input['delivery_date']));
          $input['collection_date']  = date("y-m-d", strtotime($input['collection_date']));
          $input['status']           = 'Placed';
          $input['lat']              = $userInfo['lat'];
          $input['lng']              = $userInfo['lng'];
          $input['building_name_no'] = $userInfo['building_name_no'];
          $input['street_name']      = $userInfo['street_name'];
          $input['post_code']        = $userInfo['post_code'];
          $input['is_skip_items']    = $request['is_skip_items'];
          return $input;
  }

  public static function createReorderArray($request, $userInfo, $finalPrice) {
          $input                     = $request->all();
          $input['delivery_date']    = date("y-m-d", strtotime($input['delivery_date']));
          $input['collection_date']  = date("y-m-d", strtotime($input['collection_date']));
          $input['status']           = 'Placed';
          $input['actual_price']     = $finalPrice;
          $input['final_price']      = $finalPrice;
          $input['lat']              = $userInfo['lat'];
          $input['lng']              = $userInfo['lng'];
          $input['building_name_no'] = $userInfo['building_name_no'];
          $input['street_name']      = $userInfo['street_name'];
          $input['post_code']        = $userInfo['post_code'];
          return $input;
  }



  public static function createOrderHistory($createOrderHistory, $orderId, $charge,$chargeMeta) {
     foreach($createOrderHistory as $i => $orderHistory) {
              $orderHistory['order_id'] = $orderId;
              $orderHistory['status'] ='Placed';
              $orderHistory['transaction_id'] =$charge['balance_transaction'];
              $orderHistory['charge_id']   = $charge['id'];
              $orderHistory['stripe_meta'] =$chargeMeta;
              $saveHistory[$i] = (new OrderHistory())->forceCreate($orderHistory->only(['user_id', 'order_id','quantity','product_id','category_id',
                'transaction_id','charge_id','stripe_meta','name','description',
                'image','price','sale_price','status'])
            );
              $saveHistory[$i]->save();
          }
          return $saveHistory;
  }
  

  public static function createReorderHistory($createOrderHistory, $orderId, $charge,$chargeMeta) {

     foreach($createOrderHistory as $i => $orderHistory) {
              $orderHistory['order_id']      = $orderId;
              $orderHistory['status']        ='Placed';
              $orderHistory['transaction_id']= $charge['balance_transaction'];
              $orderHistory['charge_id']     = $charge['id'];
              $orderHistory['stripe_meta']   = $chargeMeta;
              $orderHistory['price']         = $orderHistory->get_product->price;
              $orderHistory['sale_price']    = $orderHistory->get_product->sale_price;
              $saveHistory[$i]    = (new OrderHistory())->forceCreate($orderHistory->only(['user_id', 'order_id','quantity','product_id','category_id',
                'transaction_id','charge_id','stripe_meta','name','description',
                'image','price','sale_price','status']));
              $saveHistory[$i]->save();
          }
          return $saveHistory;
  }

}