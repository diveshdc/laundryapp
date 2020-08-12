@extends('userinterface.layouts.master')
@section('page-title')
Spotlex
@endsection
@section('content')
<section class="banner commercial-banner inner-banner" style="background-image:url('{{ asset('userinterface/images/banner-2.jpg') }}');">
        <div class="container">
            <div class="banner-content">
                <h1>Commercial Services</h1>
            </div>
        </div>
    </section>
<section class="section regular-content-box commercial-content-box">  
    <div class="container">
        <div class="regular-content-inn text-center">
          <h3>Medical & Dental, Health & Fitness, Hotel & Rentals, Salons & Spas, <br />
Maintenance, Food Service, Recreation, Hospitality, Janitorial, <br />
Uniforms, Towels, Linens</h3>
          <p>We collect, clean and deliver garments when our professional laundry and dry cleaning services are complete. We understand that every business has specific needs, so we
endeavour to provide the highest standards at competitive prices with reliable results. We could stick to a rigid price list like every other laundry service, but we have decided to ask you what your pricing needs are. Your business is unique and your laundry needs are unique. We want to create a Laundry Plan that is the perfect fit for you – from when your pick up occurs to the amount due on your invoice.</p>
        </div> 
    </div>
 </section>


    <section class="how-it-work">
        <div class="container">
            <div class="how-it-work-inn">
                <div class="title-heading">
                    <h3>HOW IT WORKS</h3>
                    <p>It’s EASY! Just tell us about your laundry needs, your desired frequency and your budget
we’ll give you several options, at different prices so you can choose the Laundry Plan that suits your business.</p>
                </div>

                <div class="how-it-ser row">
                    <div class="col-lg-3 text-center">
                        <div class="service-box">
                        <figure class="service-figure service-figure-box" style="background-image:url('{{ asset('userinterface/images/service-img-1.jpg')}}');"></figure>
                        <h3>Budget</h3>
                        <p>Tell us your budget<p>
                     </div>
                    </div>


                     <div class="col-lg-3 text-center">
                        <div class="service-box">
                        <figure class="service-figure service-figure-box" style="background-image:url('{{ asset('userinterface/images/service-img-2.jpg') }}');"></figure>
                        <h3>Laundry Needs</h3>
                        <p>Describe your laundry needs<p>
                     </div>
                    </div>


                     <div class="col-lg-3 text-center">
                        <div class="service-box">
                        <figure class="service-figure service-figure-box" style="background-image:url('{{ asset('userinterface/images/service-img-3.jpg') }}');"></figure>
                        <h3>Service Plan</h3>
                        <p>We’ll develop a service plan<p>
                     </div>
                    </div>

                     <div class="col-lg-3 text-center">
                        <div class="service-box">
                        <figure class="service-figure service-figure-box" style="background-image:url('{{asset('userinterface/images/service-img-4.jpg')}}');"></figure>
                        <h3>Convenience</h3>
                        <p>We’ll meet your requirements<p>
                     </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    <section class="section choose-us-sec">
        <div class="container">
            <div class="choose-us-inn">
                <div class="title-heading text-center">
                    <h3>WHY CHOOSE US?</h3>
                    <p>The personalised service you will receive is not the only benefit that our corporate clients enjoy.</p>
                </div>

                <div class="how-it-ser row">
                    <div class="col-lg-4 text-center">
                        <div class="service-box service-box-icon">
                        <figure class="service-figure-icon">
                          <img src="{{asset('userinterface/images/choose-icon-1.png')}}" alt="choose-icon-1.png" />
                        </figure>
                        <h3>No Contract</h3>
                        <p>No length of service or minimum commitment<p>
                     </div>
                    </div>


                     <div class="col-lg-4 text-center">
                        <div class="service-box service-box-icon">
                       <figure class="service-figure-icon">
                          <img src="{{asset('userinterface/images/choose-icon-2.png')}}" alt="choose-icon-2.png" />
                        </figure>
                        <h3>Flexible Billing</h3>
                        <p>Choose from monthly or weekly billing options<p>
                     </div>
                    </div>


                     <div class="col-lg-4 text-center">
                        <div class="service-box service-box-icon">
                       <figure class="service-figure-icon">
                          <img src="{{asset('userinterface/images/choose-icon-3.png')}}" alt="choose-icon-3.png" />
                        </figure>
                        <h3>Easy Payment</h3>
                        <p>Pay by bank transfer, credit card, or direct debit<p>
                     </div>
                    </div>

                     <div class="col-lg-4 text-center">
                        <div class="service-box service-box-icon">
                      <figure class="service-figure-icon">
                          <img src="{{asset('userinterface/images/choose-icon-4.png')}}" alt="choose-icon-4.png" />
                        </figure>
                        <h3>No Hidden Fees</h3>
                        <p>Our pricing is clear and all inclusive<p>
                     </div>
                    </div>



                     <div class="col-lg-4 text-center">
                        <div class="service-box service-box-icon">
                       <figure class="service-figure-icon">
                          <img src="{{asset('userinterface/images/choose-icon-5.png')}}" alt="choose-icon-5.png" />
                        </figure>
                        <h3>Simple Scheduling</h3>
                        <p>We’ll work around your schedule and availability<p>
                     </div>
                    </div> 
                    


                     <div class="col-lg-4 text-center">
                        <div class="service-box service-box-icon">
                      <figure class="service-figure-icon">
                          <img src="{{asset('userinterface/images/choose-icon-6.png')}}" alt="choose-icon-6.png" />
                        </figure>
                        <h3>Pick up & Delivery</h3>
                        <p>Pick up and delivery is completely free<p>
                     </div>
                    </div>
                    


                     <div class="col-lg-4 text-center">
                        <div class="service-box service-box-icon">
                      <figure class="service-figure-icon">
                          <img src="{{asset('userinterface/images/choose-icon-7.png')}}" alt="choose-icon-7.png" />
                        </figure>
                        <h3>Adjustable Frequency</h3>
                        <p>Automate your services or schedule them accordingly<p>
                     </div>
                    </div>
                    

                   <div class="col-lg-4 text-center">
                        <div class="service-box service-box-icon">
                       <figure class="service-figure-icon">
                          <img src="{{asset('userinterface/images/choose-icon-8.png')}}" alt="choose-icon-8.png" />
                        </figure>
                        <h3>Priority Client Care</h3>
                        <p>We work to ensure that you are happy with our service<p>
                     </div>
                    </div>

                    <div class="col-lg-4 text-center">
                        <div class="service-box service-box-icon">
                       <figure class="service-figure-icon">
                          <img src="{{asset('userinterface/images/choose-icon-9.png')}}" alt="choose-icon-9.png" />
                        </figure>
                        <h3>Limitless Options</h3>
                        <p>Items are processed and delivered according to your requirements.<p>
                     </div>
                    </div>
                    

                 </div>  <!--row div -->

            </div>
        </div>
    </section>



<section class="enquire-form-sec section white-bg-field">
  <div class="container">
     <div class="enquire-form-main">
        <div class="title-heading text-center">
                    <h3>COMPLETE THE FORM BELOW TO PROCESS YOUR ENQUIRY</h3>
                    <p>Let us know about your laundry needs and we'll arrange a consultation</p>
                </div>

                <div class="enquier-frm  row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Company Name" />
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Nature Of Business" />
                    </div>
                  </div>

                   <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Business Address" />
                    </div>
                  </div>

                  
                   <div class="col-lg-6">
                    <div class="form-group">
                      <input type="number" class="form-control" placeholder="Post Code" />
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Contact Name" />
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="number" class="form-control" placeholder="Contact Number" />
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Email Address" />
                    </div>
                  </div>


                   <div class="col-lg-12"> 
                    <div class="form-group">
                     <textarea class="form-control form-textarea" placeholder="Describe your laundry needs and specify your budget" ></textarea>
                    </div>
                  </div>

                   <div class="col-lg-12">
                    <div class="form-group submit_btn_outer">
                    <button class="btn primary_btn nm_btn">SUBMIT</button>
                    </div>
                  </div>

                </div>
     </div>
  </div>
</section>
@endsection

    <a href="javascript:void(0); " id="top_arrow "></a>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="{{asset('userinterface/js/jquery.min.js')}}"></script>
    <script src="{{asset('userinterface/js/popper.min.js')}}"></script>
    <script src="{{asset('userinterface/js/bootstrap.min.js')}} "></script>
    <script src="{{asset('userinterface/js/wow.js')}} "></script>
    <script src="{{asset('userinterface/js/aos.js')}} "></script>
    <script src="{{asset('userinterface/js/jquery.mCustomScrollbar.concat.min.js')}} "></script>
    <script src="{{asset('userinterface/js/custom.js ')}}"></script>
