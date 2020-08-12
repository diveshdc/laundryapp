@extends('userinterface.layouts.master')
@section('page-title')
    Spotlex
@endsection
@section('content')
    <section class="banner home-banner">

        <div id="home-banner" class="carousel slide" data-ride="carousel">
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active"
                     style="background-image:url('{{ asset('userinterface/images/home-slide-1.jpg') }}');"></div>
                <div class="carousel-item"
                     style="background-image:url('{{asset('userinterface/images/home-slide-1.jpg')}}');"></div>
                <div class="carousel-item"
                     style="background-image:url('{{ asset('userinterface/images/home-slide-1.jpg') }}');"></div>
            </div>
            <div class="banner-content-wrap">
                <div class="container">
                    <div class="banner-content">
                        <h1>dRY cLEANING aND lAUNDRY ON-DEMAND <br/> at tHE TOUCH OF a bUTTON</h1>
                            <div class="book-now-wrap" {{ $errors->has('post_code') ? 'has-error' : ''}}">
                                <input type="text" id="post_code" name="post_code" class="form-control"
                                       placeholder="Enter Postcode"/>
                                <a type="button" id="post_code_button" class="btn book_btn" onclick="ckeckPostCode(this)" id="find_post_code" >Book Now</a>
                            </div>
                                      <div class="alert alert-danger print-error-msg" style="display:none">
                                            <ul>
                                                
                                            </ul>
                                        </div>
                <div style="display: none;" id="check_postcode_loader" class="alert alert-success alert-dismissible col-sm-12">
                               <div class="threedotspineer">
                              <div class="bounce1"></div>
                              <div class="bounce2"></div>
                              <div class="bounce3"></div>
                            </div>
                                One moment, checking postcode
                            </div>
                        @if (Auth::guest())
                        <p><strong>Already have an account?</strong> <a href="{{ url('user/login') }}">Sign in here</a>
                        </p>
                            @endif
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#home-banner" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </a>
                    <a class="carousel-control-next" href="#home-banner" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>

    </section>

    <!-- how it section -->

    <section class="how-it-work bg-white" id="how-it-works">
        <div class="container">
            <div class="how-it-work-inn">
                <div class="title-heading">
                    <h3>HOW IT WORKS</h3>
                    <p>Trained professionals collect, clean and deliver laundry at the click of a button.
                        You will never have to do laundry or ironing ever again!</p>
                </div>

                <div class="how-it-ser row">
                    <div class="col-lg-4 text-center">
                        <div class="service-box">
                            <figure class="service-figure service-arrow-figure"
                                    style="background-image:url('{{ asset('userinterface/images/how-it-work-1.jpg') }}');"></figure>
                            <h3>SCHEDULE YOUR FREE COLLECTION </h3>
                            <p>Register to schedule your collection via mobile app or online
                                We’ll bring a bag. We offer a variety of time slots on each day
                                of the week from Monday – Sunday.
                            <p>
                        </div>
                    </div>


                    <div class="col-lg-4 text-center">
                        <div class="service-box">
                            <figure class="service-figure service-arrow-figure"
                                    style="background-image:url('{{ asset('userinterface/images/how-it-work-2.jpg') }}');"></figure>
                            <h3>PROFESSIONAL SERVICE</h3>
                            <p>Whatever we collect will be taken for a professional service,
                                Whether it be dry cleaning, laundry or alterations.
                            <p>
                        </div>
                    </div>


                    <div class="col-lg-4 text-center">
                        <div class="service-figure service-box">
                            <figure class="service-figure  service-arrow-figure"
                                    style="background-image:url('{{ asset('userinterface/images/how-it-work-3.jpg') }}');"></figure>
                            <h3>FREE DELIVERY</h3>
                            <p>You will receive your delivery in less than 48 hours of your chosen service.
                                Your items will be spotless and we won’t charge a penny for delivery.
                            <p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>


    <section class="section tap-section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6">
                    <div class="tap-left-block text-center">
                        <div class="title-heading">
                            <h3>Tap, track & sit back</h3>
                            <p>Watch our video to see how it is done <br/> Saving your time to do what you love most.
                            </p>
                        </div>
                        <div class="book-now-wrap ">
                            <input type="text" class="form-control"  href="{{ route('signup') }}" placeholder="Enter Postcode"/>
                            <button class="btn book_btn">Book Now</button>
                        </div>
                    </div>
                </div>
                <div class="offset-lg-1 col-lg-4 ">
                    <div class="tap-right-block video-block">
                        <video width="320" height="240" controls>
                            <source src="{{ asset('userinterface/video/dummy.mp4') }}" type="video/mp4">
                            <source src="{{ asset('userinterface/video/dummy.mp4') }}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="our-grantee-sec bg-grey section">
        <div class="container">
            <div class="title-heading text-center">
                <h3>Our Guarantee</h3>
                <p>We are dedicated to ensuring your satisfaction</p>
            </div>

            <div class="list-icon-block">
                <ul>
                    <li><i class="fa fa-heart" aria-hidden="true"></i> <strong>WE PROMISE 100% HAPPINESS:</strong> If
                        you’re not completely happy with your laundry or cleaning, we’ll re-process your order for free!
                    <li>
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i><strong>OUR SERVICE IS CONVENIENT:</strong> We
                        collect, clean and deliver at a time that suits you.
                    </li>
                    <li><i class="fa fa-leaf" aria-hidden="true"></i> <strong>ENVIRONMENTALLY CONSCIOUS:</strong> We
                        have the environment in mind. No harsh chemicals are used.
                    </li>
                    <li><i class="fa fa-bookmark" aria-hidden="true"></i> <strong>QUALITY SERVICES:</strong> We are
                        dedicated to ensuring high-quality services so your items are returned in an exceptional
                        condition every time you place an order.
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="truepoilet-sec"
             style="background-image:url('{{ asset('userinterface/images/truepliot-bg.jpg') }}');">
        <div class="container">
            <div class="truepoilet-inn">
                <h3>We are now on trustpilot, watch this space for impressive reviews!</h3>
                <figure><img src="{{ asset('userinterface/images/truepoilet-logo.png')}}" alt="truepoilet-logo.png"/>
                </figure>
            </div>
        </div>
    </section>


    <section class="section exp-sec bg-grey ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title-heading text-center">
                        <h3>Experience Laundry & dry cleaning <br/> at your fingertips</h3>
                        <p>Many app make life easier, but Spotlex does laundry & <br/>
                            dry cleaning with optimal care. Experience our quality <br/>
                            service with a few simple clicks.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="download-box">

                        <div class="title-heading text-center">
                            <h3>Download The App</h3>
                        </div>


                        <div class="book-now-wrap download-form-box">
                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile Number"/>
                            <button class="btn book_btn" id="send_app_link" onclick='sendAppLink()'>Get the dowload link</button>
                            <button style="display: none;" id="sending_msg_loader" class="btn book_btn">
                                <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                Sending...
                            </button>
                        </div>
                        <div class="download-option-wrap">
                            <ul>
                                <li><a href="#"><img src="{{ asset('userinterface/images/google-play.png') }}"></a>
                                </li>
                                <li><a href="#"><img src="{{ asset('userinterface/images/ios-icon.png') }}"></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="about-service section">
        <div class="container">
            <div class="title-heading text-center">
                <h3>ABOUT OUR SERVICES</h3>
                <p>Spotlex is a fast-growing on-demand business</p>
            </div>

            <div class="about-cont">
                <p>We offer on demand laundry and dry cleaning services, which include specialism such as alterations
                    and commercial laundry. We collect, clean and deliver to your door in less than 48 hours. Our London
                    based service is available within most London postcodes and its surrounding environ. Spotlex
                    customers enjoy a smarter and simpler way of doing laundry and dry cleaning. If your suit needs to
                    be cleaned in a particular way, or your dress has specific care instructions, you can rely on us for
                    quality and care. Our dry cleaning experts handle everything from daily work attire to delicate
                    fabrics/fragile garments. Simply let us know your preferences when ordering via apps or online.</p>

                <p>Spotlex is dedicated to providing high-quality services, through our trusted partners’ network. Our
                    work is even backed by a definitive quality guarantee. Our flexible collection and drop off
                    schedules prevent customers from dealing with restrictive opening times. Orders can be placed 24/7
                    with free collection and free delivery.</p>
            </div>


            <div class="about-cont-list-wrap dot_list">
                <h3>Our services at a glance:</h3>

                <ul>
                    <li>Dry Cleaning Service</li>
                    <li>Laundry Free Pickup & Delivery</li>
                    <li>Dress Dry Cleaning</li>
                    <li>Duvet Cleaning</li>
                    <li>Shirt Service</li>
                    <li>Alteration Service</li>
                    <li>Ironing Services</li>
                    <li>Bedding Service</li>
                    <li>Airbnb Host Laundry Service</li>
                    <li>Laundry Service</li>
                    <li>Suit Dry Cleaning</li>
                    <li>Commercial & Restaurant Laundry Service</li>
                    <li>Wash & Fold</li>
                </ul>
            </div>

            <div class="about-cont">
                <p>If you still have questions or concerns, do not hesitate to get in touch. We love to receive
                    feedback, questions and ideas as we want to keep improving and meeting your needs. To contact us for
                    a quick response email info@spotlex.co.uk or text 07478221373.</p>
            </div>
        </div>
    </section>


    <section class=" refer-friend-sec text-center"
             style="background-image:url('{{ asset('userinterface/images/truepliot-bg.jpg') }}');">
        <div class="container">
            <div class="refer-friend-inn">
                <h3>REFER A FRIEND TO GET A DISCOUNT YOU CAN BOTH ENJOY</h3>
                <p>When your friend places an order with Spotlex you will both receive £10 off any order worth £15 or
                    more!</p>
            </div>
        </div>
    </section>


    <section class="section review-sec">
        <div class="container">
            <div class="review-inn">
                <div class="title-heading text-center">
                    <h3>OUR CUSTOMER REVIEWS</h3>
                </div>
                <div class="review-block">
                    <img src="{{ asset('userinterface/images/review-img.jpg')}}" alt="review-img.jpg"/>
                </div>
            </div>
        </div>
    </section>

    <a href="javascript:void(0); " id="top_arrow "></a>
@endsection
