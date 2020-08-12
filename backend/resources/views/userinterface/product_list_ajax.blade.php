<div class="tab-content" id="myTabContent">
<div class="tab-pane fade  show active">
    <div class="row">
        @if(count($products)>0)
        @forelse($products as $key => $product)
        <div class="col-sm-6">
            <div class="product-outer">
                <div class="image-outer">
                <img src="{{$product->image}}">
                </div>
                <div class="content-area">
                    <h3>{{$product['name']}}</h3>
                     <p>{{$product['description']}}</p>
                </div>
                <div class="bottom-text">
                    <a class="cust-cur" ><span>-</span></a>
                  <div class="price-value">£{{$product->price}}</div>
                    <a class="cust-cur"><span>+</span></a>
                </div>
            </div>
        </div>
         @empty
        @endforelse
        @else
         <p style="margin-left: 50%;">Products Not Found!</p>
        @endif
    </div>
</div>
 </div>