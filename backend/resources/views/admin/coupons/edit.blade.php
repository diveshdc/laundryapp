@extends('layouts.admin')
@section('content')
    <style type="text/css">
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            display: none;
        }

        input[type=date]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            display: none;
        }
    </style>
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('global.coupon.title_singular') }}
        </div>

        <div class="card-body">
            @if($errors->any())
                <p class="resetPasswordError" style="color:red;">{{$errors->first()}}</p>
            @endif
            <form id="edit_coupon" action="{{ route('admin.coupons.update', [$coupon->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group {{ $errors->has('coupon_code') ? 'has-error' : '' }}">
                    <label for="coupon_code">{{ trans('global.coupon.fields.coupon_code') }}*</label>
                    <input type="text" id="coupon_code" name="coupon_code" placeholder="Coupon Code"
                           class="form-control"
                           value="{{ old('coupon_code', isset($coupon) ? $coupon->coupon_code : '') }}">
                    @if($errors->has('coupon_code'))
                        <em class="invalid-feedback">
                            {{ $errors->first('coupon_code') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('global.coupon.fields.name_helper') }}
                    </p>
                </div>
                <input class="btn btn-primary genarate_coupon_code" type="button"
                       value="{{ trans('global.generate') }}">

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">{{ trans('global.coupon.fields.description') }}</label>
                    <input type="text" id="description" name="description" placeholder="Description (optional)"
                           class="form-control"
                           value="{{ old('description', isset($coupon) ? $coupon->description : '') }}">
                    @if($errors->has('description'))
                        <em class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('global.coupon.fields.name_helper') }}
                    </p>
                </div>
                <p>
                    <button class="btn btn-link" type="button" id="multiCollapseButton">
                        Coupon Data
                    </button>
                </p>
                <div class="row">
                    <div class="col">
                        <div id="multiCollapseShow">
                            <div class="card card-body">
                                <div class="accordion" id="accordion">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="panel-group" id="accordion" role="tablist"
                                                 aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <i class="fa fa-certificate" aria-hidden="true"></i>
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                       href="#collapseOne" aria-expanded="true"
                                                       aria-controls="collapseOne">
                                                        General
                                                    </a>
                                                </div>
                                                <div class="panel panel-default">
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                       data-parent="#accordion" href="#collapseTwo"
                                                       aria-expanded="false" aria-controls="collapseTwo">
                                                        Usage Restriction
                                                    </a>
                                                </div>
                                                <div class="panel panel-default">
                                                    <i class="fa fa-arrow-up"></i>
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                       data-parent="#accordion" href="#collapseThree"
                                                       aria-expanded="false" aria-controls="collapseThree">
                                                        Usage limits
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="" id="headingOne">
                                            </div>
                                            <div id="collapseOne" class="collapse panel-body"
                                                 aria-labelledby="headingOne" data-parent="">
                                                <div
                                                    class="form-group {{ $errors->has('discount_type') ? 'has-error' : '' }}">
                                                    <label
                                                        for="discount_type">{{ trans('global.coupon.fields.discount_type') }}
                                                        *</label>
                                                    <select name="discount_type" id="discount_type"
                                                            class="form-control">
                                                        <option value="">Fixed product discount</option>
                                                        <option value="Percentage">Percentage discount</option>
                                                        <option value="Fixed">Fixed basket discount</option>
                                                    </select>
                                                    @if($errors->has('discount_type'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('discount_type') }}
                                                        </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.product.fields.discount_type_helper') }}
                                                    </p>
                                                </div>
                                                <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                                    <label for="price">{{ trans('global.coupon.fields.price') }}</label>
                                                    <input type="number" id="price" name="price" class="form-control"
                                                           value="{{ old('price', isset($coupon) ? $coupon->price : '') }}">
                                                    @if($errors->has('price'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('price') }}
                                                        </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.coupon.fields.end_date_helper') }}
                                                    </p>
                                                </div>
                                                <div
                                                    class="form-group {{ $errors->has('expiry_date') ? 'has-error' : '' }}">
                                                    <label for="expiry_date">{{ trans('global.coupon.fields.enddate') }}
                                                        (Format:mm/dd/yyyy)</label>
                                                    <input type="date" id="expiry_date" name="expiry_date"
                                                           class="form-control"
                                                           value="{{ old('expiry_date', isset($coupon) ? $coupon->expiry_date : '') }}">
                                                    @if($errors->has('expiry_date'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('global.coupon.fields.end_date_helper') }}
                                                        </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.coupon.fields.end_date_helper') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div id="collapseTwo" class="collapse panel-body"
                                                 aria-labelledby="headingTwo" data-parent="">
                                                <div class="card-body">
                                                    <div
                                                        class="form-group {{ $errors->has('minimum_spend') ? 'has-error' : '' }}">
                                                        <label
                                                            for="minimum_spend">{{ trans('global.coupon.fields.minimum_spend') }}</label>
                                                        <input type="text" id="minimum_spend" name="minimum_spend"
                                                               class="form-control"
                                                               alue="{{ old('minimum_spend', isset($coupon) ? $coupon->minimum_spend : '') }}">
                                                        @if($errors->has('minimum_spend'))
                                                            <em class="invalid-feedback">
                                                                {{ $errors->first('minimum_spend') }}
                                                            </em>
                                                        @endif
                                                        <p class="helper-block">
                                                            {{ trans('global.coupon.fields.minimum_spend_helper') }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="form-group {{ $errors->has('maximum_spend') ? 'has-error' : '' }}">
                                                        <label
                                                            for="maximum_spend">{{ trans('global.coupon.fields.maximum_spend') }}</label>
                                                        <input type="text" id="maximum_spend" name="maximum_spend"
                                                               class="form-control"
                                                               alue="{{ old('maximum_spend', isset($coupon) ? $coupon->maximum_spend : '') }}">
                                                        @if($errors->has('maximum_spend'))
                                                            <em class="invalid-feedback">
                                                                {{ $errors->first('maximum_spend') }}
                                                            </em>
                                                        @endif
                                                        <p class="helper-block">
                                                            {{ trans('global.coupon.fields.maximum_spend_helper') }}
                                                        </p>
                                                    </div>

                                                    {{trans('global.coupon.fields.individual')}}
                                                    <div>
                                                        <input type="checkbox" name="individual_use_only" value=""
                                                               class="" id="">
                                                        <label>{{trans('global.coupon.fields.individual_only')}}</label>
                                                    </div>

                                                    {{trans('global.coupon.fields.exclude_sale')}}
                                                    <div>
                                                        <input type="checkbox" name="exclude_sale_item" value=""
                                                               class="" id="">
                                                        <label>{{trans('global.coupon.fields.exclude_sale_item')}}</label>
                                                    </div>


                                                    <div
                                                        class="form-group {{ $errors->has('products') ? 'has-error' : '' }}">
                                                        <label
                                                            for="category_name">{{ trans('global.coupon.fields.products') }}
                                                            <span
                                                                class="btn btn-info btn-xs select-all">Select all</span>
                                                            <span
                                                                class="btn btn-info btn-xs deselect-all">Deselect all</span>
                                                        </label>
                                                        <select name="product[]" id="product"
                                                                class="form-control select2 product"
                                                                multiple="multiple">
                                                            @foreach($product as $id => $products)
                                                                <option
                                                                    value="{{ $id }}" {{ (in_array($id, old('products', [])) || isset($user) && $user->products->contains($id)) ? 'selected' : '' }}>
                                                                    {{ $products }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('products'))
                                                            <em class="invalid-feedback">
                                                                {{ $errors->first('products') }}
                                                            </em>
                                                        @endif
                                                        <p class="helper-block">
                                                            {{ trans('global.coupon.fields.products_helper') }}
                                                        </p>
                                                    </div>


                                                    <div
                                                        class="form-group {{ $errors->has('exclude_products') ? 'has-error' : '' }}">
                                                        <label
                                                            for="exclude_products">{{ trans('global.coupon.fields.exclude_products') }}
                                                        <!--   <span class="btn btn-info btn-xs select-all">Select all</span>
                        <span class="btn btn-info btn-xs deselect-all">Deselect all</span> -->
                                                        </label>
                                                        <select name="exclude_products[]" id="exclude_products"
                                                                class="form-control product select2"
                                                                multiple="multiple">
                                                            @foreach($product as $id => $exclude_products)
                                                                <option
                                                                    value="{{ $id }}" {{ (in_array($id, old('exclude_products', [])) || isset($user) && $user->exclude_products->contains($id)) ? 'selected' : '' }}>
                                                                    {{ $exclude_products }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('exclude_products'))
                                                            <em class="invalid-feedback">
                                                                {{ $errors->first('exclude_products') }}
                                                            </em>
                                                        @endif
                                                        <p class="helper-block">
                                                            {{ trans('global.coupon.fields.exclude_products_helper') }}
                                                        </p>
                                                    </div>


                                                    <div
                                                        class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                                        <label
                                                            for="categories">{{ trans('global.coupon.fields.categories') }}
                                                            <span
                                                                class="btn btn-info btn-xs select-all">Select all</span>
                                                            <span
                                                                class="btn btn-info btn-xs deselect-all">Deselect all</span>
                                                        </label>
                                                        <select name="category[]" id="category"
                                                                class="form-control select2" multiple="multiple">
                                                            @foreach($category as $id => $categories)
                                                                <option
                                                                    value="{{ $id }}" {{ (in_array($id, old('categories', [])) || isset($user) && $user->categories->contains($id)) ? 'selected' : '' }}>
                                                                    {{ $categories }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('categories'))
                                                            <em class="invalid-feedback">
                                                                {{ $errors->first('categories') }}
                                                            </em>
                                                        @endif
                                                        <p class="helper-block">
                                                            {{ trans('global.coupon.fields.categories_helper') }}
                                                        </p>
                                                    </div>
                                                </div class="form-group {{ $errors->has('exclude_categories') ? 'has-error' : '' }}">
                                                <label
                                                    for="exclude_categories">{{ trans('global.coupon.fields.exclude_categories') }}
                                                <!--   <span class="btn btn-info btn-xs select-all">Select all</span>
                        <span class="btn btn-info btn-xs deselect-all">Deselect all</span> -->
                                                </label>
                                                <select name="exclude_categories[]" id="exclude_categories"
                                                        class="form-control select2" multiple="multiple">
                                                    @foreach($category as $id => $exclude_categories)
                                                        <option
                                                            value="{{ $id }}" {{ (in_array($id, old('exclude_categories', [])) || isset($user) && $user->exclude_categories->contains($id)) ? 'selected' : '' }}>
                                                            {{ $exclude_categories }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('exclude_categories'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('exclude_categories') }}
                                                    </em>
                                                @endif
                                                <p class="helper-block">
                                                    {{ trans('global.coupon.fields.exclude_categories_helper') }}
                                                </p>
                                            </div>
                                            <div id="collapseThree" class="collapse panel-body"
                                                 aria-labelledby="headingThree" data-parent="">
                                                <div
                                                    class="form-group {{ $errors->has('usage_limit_per_coupon') ? 'has-error' : '' }}">
                                                    <label
                                                        for="usage_limit_per_coupon">{{ trans('global.coupon.fields.useage_limitper_coupon') }}</label>
                                                    <input type="text" id="usage_limit_per_coupon"
                                                           name="usage_limit_per_coupon" class="form-control"
                                                           value="{{ old('usage_limit_per_coupon', isset($coupon) ? $coupon->usage_limit_per_coupon : '') }}">
                                                    @if($errors->has('usage_limit_per_coupon'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('usage_limit_per_coupon') }}
                                                        </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.coupon.fields.usage_limit_per_coupon_helper') }}
                                                    </p>
                                                </div>
                                                <div
                                                    class="form-group {{ $errors->has('limit_usage_x_item') ? 'has-error' : '' }}">
                                                    <label
                                                        for="limit_usage_x_item">{{ trans('global.coupon.fields.limit_usage_x_item') }}</label>
                                                    <input type="text" id="limit_usage_x_item" name="limit_usage_x_item"
                                                           class="form-control"
                                                           value="{{ old('limit_usage_x_item', isset($coupon) ? $coupon->limit_usage_x_item : '') }}">
                                                    @if($errors->has('limit_usage_x_item'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('limit_usage_x_item') }}
                                                        </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.coupon.fields.limit_usage_x_item_helper') }}
                                                    </p>
                                                </div>
                                                <div
                                                    class="form-group {{ $errors->has('usage_limit_per_user') ? 'has-error' : '' }}">
                                                    <label
                                                        for="usage_limit_per_user">{{ trans('global.coupon.fields.usage_limit_per_user') }}</label>
                                                    <input type="text" id="usage_limit_per_user"
                                                           name="usage_limit_per_user" class="form-control"
                                                           value="{{ old('usage_limit_per_user', isset($coupon) ? $coupon->usage_limit_per_user : '') }}">
                                                    @if($errors->has('usage_limit_per_user'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('usage_limit_per_user') }}
                                                        </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.coupon.fields.usage_limit_per_user_helper') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>
        </div>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $("#multiCollapseShow").hide();
//          $("#product").change(function(){
//             console.log('1');
//                     $("select option").prop("disabled", false); //enable everything

//                             //collect the values from selected;
//                             var arr = $.map(
//                                 $("#product option:selected"), function (n) {
//                                     return n.value;
//                                 });
//                             console.log('2',arr);

//                             //disable elements
//                             $("#exclude_products option").filter(function () {
//                                 console.log($(this).val(),'exclude');
//                                 return $.inArray($(this).val(), arr) > 1; //if value is in the array of selected values
//                             }).prop("disabled", true);

//                             //re-enable elements
//                             $("select option").filter(function () {
//                                 return $.inArray($(this).val(), arr) == -1; //if value is not in the array of selected values
//                             }).prop("disabled",false);
// });


            $('#product').change(function () {
                if ($('select option[value="' + $(this).val() + '"]:selected').length > 1) {
                    $(this).val('-1').change();
                    alert('You have already selected this option previously - please choose another.')
                }
            });
            $('#category').change(function () {
                if ($('select option[value="' + $(this).val() + '"]:selected').length > 1) {
                    $(this).val('-1').change();
                    alert('You have already selected this option previously - please choose another.')
                }
            });

            $("#multiCollapseButton").click(function () {
                $("#multiCollapseShow").toggle({
                    duration: 100,
                });
            });

        });
        $(document).click(function (e) {
            if (!$(e.target).is('.panel-body') && (e.target.hash == '#collapseOne' || e.target.hash == '#collapseTwo' || e.target.hash == '#collapseThree')) {
                $('.collapse').collapse('hide');
            }
        });
    </script>

@endsection
