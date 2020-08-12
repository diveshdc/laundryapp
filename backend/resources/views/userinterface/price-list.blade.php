@extends('userinterface.layouts.master')
@section('page-title')
Spotlex
@endsection
@section('content')
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
            <div id="productslist">

            </div>
           <!--  <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service-tab-2">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Accesories</h3>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service-tab-3">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Alterations</h3>
                    </div>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service-tab-4">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Household</h3>
                    </div>
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service-tab-5">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Dress & Skirts</h3>
                    </div>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service-tab-6">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Iron only</h3>
                    </div>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service-tab-7">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Laundry</h3>
                    </div>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service-tab-8">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Outdoors</h3>
                    </div>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link  active" data-toggle="tab" href="#service-tab-9">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Tops</h3>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service-tab-10">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Suits</h3>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service-tab-11">
                    <div class="icon-box-wrap">
                        <figure class="icon-wrap">
                        </figure>
                        <h3>Bundle Deals</h3>
                    </div>
                </a>
            </li> -->
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="service-tab-1">
              
            </div>
            <div class="tab-pane fade" id="service-tab-2">

            </div>
            <div class="tab-pane fade" id="service-tab-3">

            </div>
            <div class="tab-pane fade" id="service-tab-4">

            </div>
            <div class="tab-pane fade" id="service-tab-5">

            </div>
            <div class="tab-pane fade" id="service-tab-6">

            </div>
            <div class="tab-pane fade" id="service-tab-7">

            </div>
            <div class="tab-pane fade" id="service-tab-8">

            </div>
            <div id="response_html">
                
            </div>
            <!-- <div class="tab-pane fade  show active" id="service-tab-9"> -->

                <div class="row">
                    <div class="tab_title col-md-11 offset-md-1">
                        <p><strong>Price List</strong></p>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="price-list-box">
                            <ul>
                                <li>
                                    <div class="price-list-data">
                                        <span>Apron - Press Only</span>
                                        <span>£3.00</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Blanket - Press Only</span>
                                        <span>£15.00</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Blouse - Press Only</span>
                                        <span>£3.50</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Child’d Dress - Press Only </span>
                                        <span>£4.75</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Child’s Item - Press Only</span>
                                        <span>£2.50</span>
                                    </div>
                                </li>


                                <li>
                                    <div class="price-list-data">
                                        <span>Child’s Jacket - Press Only</span>
                                        <span>£2.95</span>
                                    </div>
                                </li>


                                <li>
                                    <div class="price-list-data">
                                        <span>Child’s Jacket - Press Only</span>
                                        <span>£2.50</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Child’s Trousers - Press Only</span>
                                        <span>£1.80</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-md-5 ">
                        <div class="price-list-box">
                            <ul>
                                <li>
                                    <div class="price-list-data">
                                        <span>Napkin - Press Only</span>
                                        <span>£1.00</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Napkin - Press Only</span>
                                        <span>£6.90</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Pashmina</span>
                                        <span>£5.80</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Pashmina - Press Only </span>
                                        <span>£6.00</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Pillowcase - Press Only</span>
                                        <span>£1.60</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Polo Shirt - Press Only</span>
                                        <span>£3.00</span>
                                    </div>
                                </li>


                                <li>
                                    <div class="price-list-data">
                                        <span>Pyjama Bottoms - Press Only</span>
                                        <span>£3.00</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="price-list-data">
                                        <span>Pyjama Top - Press Only</span>
                                        <span>£3.00</span>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 text-center find-looking-wrap">
                        <div class="title-heading">
                            <h3>CAN’T FIND WHAT YOU’RE LOOKING FOR?</h3>
                            <p>If you have an item you would like us to take care of but can't see it listed please contact us to clarify the price.</p> <br />

                            <p>The Minimum order is £15 you can give us fewer items and the order will be rounded up to £15. Collection and Delivery is FREE, a supplement of £10 will apply if you are not in for a collection or delivery.
                            </p>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
            <div class="tab-pane fade" id="service-tab-10">

            </div>
            <div class="tab-pane fade" id="service-tab-11">

            </div>
        </div>
    </div>
</section>
<a href="javascript:void(0);" id="top_arrow"></a>
@endsection