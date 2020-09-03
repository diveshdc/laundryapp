@extends('layouts.admin')
@section('content')
<div class="card">
<div class="card-header d-flex align-items-center">Order<strong>#{{$order[0]['id']}}  details</strong><a class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none" href="#" onclick="javascript:window.print();">
<svg class="c-icon">
<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-print"></use>
</svg> Print</a>
</div>
<div class="card-body">
<div class="row mb-12">
<div class="col-sm-6 card">
<div><strong>Payment via Stripe</strong></div>
<!-- <div><strong>IP:</strong> 203.190.154.146</div> -->
<div><strong>General</strong></div>
<p></p>
<div>
<div><strong> {{ \Carbon\Carbon::parse($order[0]['updated_at'])->format('d/M/Y H:i:a')}}</strong></div>
<div><strong>Status:</strong>{{$order[0]['status']}}</div>
<!-- <div><strong>Customer</strong></div>
<div><strong>Guest</strong></div> -->
</div>

<div class="table-responsive-sm card">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th class="center">Image</th>
<th>Product</th>
<th>Cost</th>
<th class="center">Quantity</th>
<!-- <th class="right">Unit Cost</th> -->
<th class="right">Total</th>
</tr>
</thead>
<tbody>
	@foreach($order as $list)
<tr>
@foreach($list->productList as $key=> $products)
<td class="center">{{$key+1}}</td>
<td class="center"><img style="height: 30px; width: 30px;" src="{{$products['image']}}"></td>
<td class="center">{{$products['name']}}</td>
<td class="center">{{$list['actual_price']}}</td>
<td class="center">{{$products['quantity']}}</td>
<td class="center">{{$list['final_price'] }}</td>
@endforeach()
</tr>
@endforeach()
</tbody>
</table>
</div>
</div>
<div class="col-sm-3 card ">
<h6 class="mb-"><strong>Billing Address:</strong></h6>
<div><strong>{{$order[0]['userInfo']->first_name}} {{$order[0]['userInfo']->last_name}},</strong></div>
<div>{{$order[0]['userInfo']->building_name_no}}
          {{$order[0]['userInfo']->town}},</div>
<div>{{$order[0]['userInfo']->street_name}},</div>
<div><strong>Email:</strong> {{$order[0]['userInfo']->email}}</div>
<div><strong>Phone:</strong> +1 123-456-7890</div>
</div>
<div class="col-sm-3 card ">
<h6 class="mb-"><strong>Collection/Delivery:</strong></h6>
<div><strong>Acme Inc.</strong></div>
<div>{{$order[0]['shipping_address']}}</div>
<div>San Diego, CA 92154</div>
<div><strong>Email:</strong> {{$order[0]['userInfo']->email}} </div>
<div><strong>Phone:</strong> {{$order[0]['userInfo']->phone_number}}</div>
</div>

<!-- <div class="col-sm-4">
<h6 class="mb-3">Details:</h6>
<div>Invoice<strong>#90-98792</strong></div>
<div>March 30, 2020</div>
<div>VAT: EU9877281777</div>
<div>Account Name: ACME</div>
<div><strong>SWIFT code: 99 8888 7777 6666 5555</strong></div>
</div> -->
</div>


<div class="row">
<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<!-- <tr>
<td class="left"><strong>Subtotal</strong></td>
<td class="right">$8.497,00</td>
</tr>
<tr>
<td class="left"><strong>Discount (20%)</strong></td>
<td class="right">$1,699,40</td>
</tr>
<tr>
<td class="left"><strong>VAT (10%)</strong></td>
<td class="right">$679,76</td>
</tr> -->
<tr>
<td class="left"><strong>Total:</strong></td>
	@foreach($order as $list)
@foreach($list->productList as $key=> $products)
<td class="right"><strong>£{{$products['price']}}</strong></td>
@endforeach()
@endforeach()
</tr>
</tbody>
</table>
<!-- <a class="btn btn-success" href="#">
<svg class="c-icon">
</svg> Create Order</a> -->
</div>
</div>
</div>
</div>

@endsection