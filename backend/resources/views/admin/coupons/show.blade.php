@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.coupon.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.coupon.fields.coupon_code') }}
                    </th>
                    <td>
                        {{ $coupon->coupon_code }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.coupon.fields.coupon_type') }}
                    </th>
                    <td>
                        {{ $coupon->discount_type }}
                    </td>
                </tr>
                 <tr>
                    <th>
                        {{ trans('global.coupon.fields.price') }}
                    </th>
                    <td>
                        {{ $coupon->price }}
                    </td>
                </tr>
                <!-- <tr>
                    <th>
                        {{ trans('global.coupon.fields.product_ids') }}
                    </th>
                    <td>
                        {{ $coupon->start_date }}
                    </td>
                </tr>
                <tr> -->
                    <th>
                        {{ trans('global.coupon.fields.enddate') }}
                    </th>
                    <td>
                        {{ $coupon->expiry_date }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.coupon.fields.description') }}
                    </th>
                    <td>
                        {{ $coupon->description }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.coupon.fields.usage_limit') }}
                    </th>
                    <td>
                        {{ $coupon->usage_limit_per_coupon }}
                    </td>
                </tr>
                
                
            </tbody>
        </table>
    </div>
</div>

@endsection