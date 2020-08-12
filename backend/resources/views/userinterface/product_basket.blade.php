@extends('userinterface.layouts.master')
@section('page-title')
Spotlex
@endsection
@section('content')
    <!--------Header Start---------->
    <scetion class="require-sec-wrap">
        <div class="container">
            <div class="require-wrap">
                <h3>What Service do you require?</h3>
                <div class="search-wrap has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </div>
        </div>
        </section>
        <section class="price-list-wrap">
            <div class="container">
                 <ul class="nav" id="myTab" role="tablist">
              @forelse($categories as $category)
            <li class="nav-item">
                <!-- data-toggle="tab" -->
                <a class="nav-link" href="javascript:onclick=getProductByCatId({{ $category['id']}})">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                            <img src="{{ $category['image']}}" alt="category image">
                        </figure>
                        <h3>{{$category['name']}}</h3>
                    </div>
                </a>
            </li>
            @empty
                <p>Category not found</p>
            @endforelse
                </ul>
            <div id="response_html">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade  show active" id="service-tab-9">
                        <div class="row">
                            @if(count($categories_product)>0)
                                @forelse($categories_product as $products)
                            <div class="col-sm-6">
                                <div class="product-outer">
                                    <div class="image-outer">
                                    <img src="{{$products->image}}">
                                    </div>
                                    <div class="content-area">
                                        <h3>{{$products->name}}</h3>
                                         <p>{{$products->description}}</p>
                                    </div>

                                    <div class="bottom-text">
                                        <a><span id="qtyminus()">-</span></a>
                                      <div class="price-value">£{{$products->price}}</div>
                                       <input type='text' name='quantity' value='0' class='qty' />
                                        <a id="qtyplus()"><span>+</span></a>
                                    </div>
                                    <div class="bottom-text">
                                    <a class="cust-cur"><span>-</span></a>
                                        <div class="price-value">£{{$products->price}}</div>
                                    <a class="cust-cur"><span>+</span></a>
                                </div>
                                </div>
                            </div>
                             @empty
                                <p>No result found</p>
                            @endforelse
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    <section class="select-cart active">
         <div class="container">
            <div class="row">
                <div class="col-sm-7">
                        <h4>Minimum Order Value $15</h4>
                </div>
                <div class="col-sm-5 text-right">
                    <h4>Total: $ 5.20</h4>
                </div>    
                <div class="col-sm-7">
                    <a href="#" class="support-here">
                      <span> <i class="fa fa-commenting" aria-hidden="true"></i></span>
                        Support
                    </a>
                </div> 
                  <div class="col-sm-5 text-right">
                    <a href="#" class="your-basket">
                        Skip Item Selection<i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="your-basket">
                        Your Basket <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                  </div>
            </div>
        </div>
    </section>
    <div class="ajax-load text-center" style="display:none">
    <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Products</p>
</div>
        @endsection
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script>

  // jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
        alert('dasdasda');
        console.log('oioioioioioioioioioioi');
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
// });

</script>