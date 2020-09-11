<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
class CouponController extends Controller
{
   public function getcoupons() {
   	$coupon = Coupon::get();
   	 return response()->json([
                'status'=>true,
                'message'=>'data found!',
                'data' =>$coupon
            ]);
   }
}
