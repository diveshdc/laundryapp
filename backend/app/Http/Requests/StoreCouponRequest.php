<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Coupon;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('coupon_create');
        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                    'coupon_code'   =>'required',
                    // 'price'         =>'required',
                    // 'expiry_date'   =>'required',
                    // 'description'   =>'required',
                    // 'discount_type' =>'required',
                    // 'minimum_spend' =>'required',
                    // 'maximum_spend' =>'required',
                    // 'usage_limit_per_coupon'=>'required',
                    // 'limit_usage_x_item' => 'required',
                    // 'usage_limit_per_user.required' =>'this is dhsaodhsaido',


        ];
    }
}
