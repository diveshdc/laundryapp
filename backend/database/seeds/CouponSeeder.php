<?php

use Illuminate\Database\Seeder;
use App\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $coupon = [
            [
            'Coupon_code' => 'testcoupen32',
            'price'		  => '52',
            'expiry_date' => '2019-04-15',
            'description' => 'test desctiption',
            'minimum_spend' => '1',
            'maximum_spend' => '1',
            'usage_limit_per_coupon' => '10',
            'limit_usage_x_item' => '10',
            'usage_limit_per_user' => '10',
            'used_time' => '0',
            'individual_use_only' => '0',
            'exclude_sale_item' => '0',
            'discount_type' => 'Percentage',
            'deleted_at'  => NULL
            
        ],
        [
            'Coupon_code' => 'testcoupen32',
            'price'       => '52',
            'expiry_date' => '2019-04-15',
            'description' => 'test desctiption',
            'minimum_spend' => '1',
            'maximum_spend' => '1',
            'usage_limit_per_coupon' => '10',
            'limit_usage_x_item' => '10',
            'usage_limit_per_user' => '10',
            'used_time' => '0',
            'individual_use_only' => '0',
            'exclude_sale_item' => '0',
            'discount_type' => 'Fixed',
            'deleted_at'  => NULL
            
        ],
        [
            'Coupon_code' => 'testcoupen32',
            'price'       => '52',
            'expiry_date' => '2019-04-15',
            'description' => 'test desctiption',
            'minimum_spend' => '1',
            'maximum_spend' => '1',
            'usage_limit_per_coupon' => '10',
            'limit_usage_x_item' => '10',
            'usage_limit_per_user' => '10',
            'used_time' => '0',
            'individual_use_only' => '0',
            'exclude_sale_item' => '0',
            'discount_type' => 'Percentage discount',
            'deleted_at'  => NULL
            
        ],
    [
            'Coupon_code' => 'testcoupen32',
            'price'       => '52',
            'expiry_date' => '2019-04-15',
            'description' => 'test desctiption',
            'minimum_spend' => '1',
            'maximum_spend' => '1',
            'usage_limit_per_coupon' => '10',
            'limit_usage_x_item' => '10',
            'usage_limit_per_user' => '10',
            'used_time' => '0',
            'individual_use_only' => '0',
            'exclude_sale_item' => '0',
            'discount_type' => 'Percentage discount',
            'deleted_at'  => NULL
            
        ]
    ];
    Coupon::insert($coupon);
    }
}
