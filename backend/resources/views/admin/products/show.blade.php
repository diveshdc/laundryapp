@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.product.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.product.fields.name') }}
                    </th>
                    <td>
                        {{ $product->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.product.fields.description') }}
                    </th>
                    <td>
                        {!! $product->description !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.product.fields.price') }}
                    </th>
                    <td>
                        ${{ $product->price }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.product.fields.saleprice') }}
                    </th>
                    <td>
                        ${{ $product->sale_price }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.product.fields.category') }}
                    </th>
                    <td>
                      @foreach($product->product_category as $product_category)
                              {{$product_category->name.','}}
                     @endforeach
                    </td>
                </tr>
                 <tr>
                    <th>
                        {{ trans('global.product.fields.image') }}
                    </th>
                    <td>
                        <img src="{{$product->image ?? '' }}" width="50"; height="60">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection