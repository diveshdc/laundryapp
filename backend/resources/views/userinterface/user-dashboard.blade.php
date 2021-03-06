@extends('userinterface.layouts.master')
@section('page-title')
Spotlex
@endsection
@section('content')
        <section class="dashboard-main">
            <div class="title">
                <h2>Welcome Maria!</h2>
            </div>
            <div class="dashboard-inner">
                <ul class="nav" id="dashboard-tabs">
                    <li>
                        <a href="javascript:void(0);" id="help-ssupport-block">
                            <div class="dashboard-menu-box">
                                <h3>Help</h3>
                                <figure class="footer-icon">
                                    <img src="{{ asset('userinterface/images/dashboard-menu-icon1.png') }}" />
                                </figure>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="" id="dashboard-tabs-1" data-toggle="tab" href="#place-new-order" role="tab" aria-controls="place-new-order" aria-selected="true">
                            <div class="dashboard-menu-box">
                                <h3>PLACE NEW ORDER</h3>
                                <figure class="footer-icon">
                                    <img src="{{ asset('userinterface/images/dashboard-menu-icon2.png') }}" alt="dashboard-menu-icon2.png" />
                                </figure>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a id="dashboard-tabs-2" data-toggle="tab" href="#account-setting" role="tab" aria-controls="account-setting" aria-selected="false">
                            <div class="dashboard-menu-box">
                                <h3>ACCOUNT SETTING</h3>
                                <figure class="footer-icon">
                                    <img src="{{ asset('userinterface/images/dashboard-menu-icon3.png') }}" alt="dashboard-menu-icon3.png" />
                                </figure>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a id="dashboard-tabs-3" data-toggle="tab" href="#order-history" role="tab" aria-controls="order-history" aria-selected="false">
                            <div class="dashboard-menu-box">
                                <h3>ORDER HISTORY</h3>
                                <figure class="footer-icon">
                                    <img src="{{ asset('userinterface/images/dashboard-menu-icon4.png') }}" alt="dashboard-menu-icon4.png" />
                                </figure>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a id="dashboard-tabs-4" data-toggle="tab" href="#refer-friend" role="tab" aria-controls="refer-friend" aria-selected="false">
                            <div class="dashboard-menu-box">
                                <h3>REFER YOUR FRIENDS</h3>
                                <figure class="footer-icon">
                                    <img src="{{ asset('userinterface/images/dashboard-menu-icon5.png') }}" alt="dashboard-menu-icon5.png" />
                                </figure>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a id="dashboard-tabs-5" class="active" data-toggle="tab" href="#loyality-point" role="tab" aria-controls="loyality-point" aria-selected="false">
                            <div class="dashboard-menu-box">
                                <h3>LOYALTY POINTS</h3>
                                <figure class="footer-icon">
                                    <img src="{{ asset('userinterface/images/dashboard-menu-icon6.png') }}" alt="dashboard-menu-icon6.png" />
                                </figure>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a id="dashboard-tabs-6" data-toggle="tab" href="#coupen" role="tab" aria-controls="coupen" aria-selected="false">
                            <div class="dashboard-menu-box">
                                <h3>COUPON/VOUCHER </h3>
                                <figure class="footer-icon">
                                    <img src="{{ asset('userinterface/images/dashboard-menu-icon7.png') }}" alt="dashboard-menu-icon7.png" />
                                </figure>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="chat-support-wrap">
                                <div class="char-tile">
                                    <h3>Live Support chat</h3>
                                    <a href="javascript:void(0);" class="chat-close-btn">X</a>
                                </div>
                                <div class="chat-support-content-wrap">
                                    <ul>
                                        <li>
                                            <div class="chat-box">
                                    <figure class="img-box" style="background-image:url('{{ asset('userinterface/images/avtar-1.png') }}');">
                                    </figure>
                                                <div class="chat-text-box">
                                                    <p>Hello! Can I help you?</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="chat-box user-chat">
                                                <figure class="img-box" style="background-image:url('{{ asset('userinterface/images/avtar-1.png') }}');"></figure>
                                                <div class="chat-text-box">
                                                    <p>Yes, can I pay via PayPal?</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="chat-box">
                                                <figure class="img-box" style="background-image:url('{{ asset('userinterface/images/avtar-1.png') }}');"></figure>
                                                <div class="chat-text-box">
                                                    <p>Sure you can!</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="chat-box user-chat">
                                                <figure class="img-box" style="background-image:url('{{ asset('userinterface/images/avtar-1.png') }}');"></figure>
                                                <div class="chat-text-box">
                                                    <p>Thanks</p>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                    <div class="type-msg-wrap">
                                        <input type="text" class="form-control" placeholder="Enter your message" />
                                    </div>
                                </div>

                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="dashboard-tabs-content">

                <div class="tab-pane fade " id="place-new-order" role="tabpanel" aria-labelledby="dashboard-tabs-1">

                        <div class="dashboard-tabs-content-box">
                            <div class="dashboard-tabs-content-title">
                                <h3>Cooming Soon</h3>
                            </div>
                            <div class="dashboard-tabs-content-inn">
                                working...
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="account-setting" role="tabpanel" aria-labelledby="dashboard-tabs-2">

                        <div class="dashboard-tabs-content-box">
                            <div class="dashboard-tabs-content-title">
                                <h3>Account Details</h3>
                            </div>
                            <div class="dashboard-tabs-content-inn">
                                <form class="row">
                                    <div class="col-md-5">
                                        <div class="dashboard-form-wrap">
                                            <div class="form-group  form-row">
                                                <label for="inputState" class="col-sm-3 col-form-label">Select Address<span class="required">*</span></label>
                                                <div class="col-sm-9">
                                                    <select id="inputState" class="form-control arrow-down  form-control-lg">
                                                    <option selected="">Your Post Code</option>
                                                    <option>...</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Post Code<span class="required">*</span></label>
                                                <div class="col-sm-6 input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="se187bg">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-1.png')}}" alt="form-field-icon-1.png" /></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 ">
                                                    <button type="submit" class="btn w-100 find-btn btn-success">Find <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                </div>
                                            </div>

                                            <div class="form-group  form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Building Name or Number<span class="required">*</span></label>
                                                <div class="col-sm-9 input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="Building Name or Number">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-2.png')}}" alt="form-field-icon-2.png" /></span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group  form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Street Name<span class="required">*</span></label>
                                                <div class="col-sm-9  input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="Street Name">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-3.png')}}" alt="form-field-icon-3.png" /></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group  form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Town<span class="required">*</span></label>
                                                <div class="col-sm-9  input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="Town">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-4.png') }}" alt="form-field-icon-4.png" /></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 offset-md-1">
                                        <div class="dashboard-form-wrap">
                                            <div class="form-group  form-row">
                                                <label for="inputState" class="col-sm-3 col-form-label">First Name<span class="required">*</span></label>
                                                <div class="col-sm-9 input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="Enter Your First Name">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-5.png') }}" alt="form-field-icon-5.png" /></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Last Name<span class="required">*</span></label>
                                                <div class="col-sm-9 input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="Enter Your Last Name">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-5.png') }}" alt="form-field-icon-5.png" /></span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group  form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Email Address<span class="required">*</span></label>
                                                <div class="col-sm-9 input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="Enter Your Email Address">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-6.png') }}" alt="form-field-icon-6.png" /></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group  form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Password<span class="required">*</span></label>
                                                <div class="col-sm-9 input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="Enter Your Current Password">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-7.png') }}" alt="form-field-icon-7.png" /></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group  form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Create New Password </label>
                                                <div class="col-sm-9 input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="Enter Your New Password">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-8.png') }}" alt="form-field-icon-8.png" /></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group  form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Confirm Password </label>
                                                <div class="col-sm-9 input-group">
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="Confirm Your New Password">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-8.png') }}" alt="form-field-icon-8.png" /></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group  form-row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Phone Number<span class="required">*</span></label>
                                                <div class="col-sm-9 input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">
                                                        <select class="selectpicker" data-width="fit">
                                                            <option data-content='<span class="flag-icon flag-icon-us"></span>'></option>
                                                        <option data-content='<span class="flag-icon flag-icon-mx"></span>'></option>
                                                        </select>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control form-control-lg" id="inputPassword" placeholder="123 456 7890">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><img src="{{ asset('userinterface/images/form-field-icon-9.png')}}" alt="form-field-icon-9.png" /></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="buttons-outer text-center">
                                            <button class="btn primary_border_btn nm_btn" type="button">Back</button>
                                            <button class="btn primary_btn nm_btn" type="button">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="order-history" role="tabpanel" aria-labelledby="dashboard-tabs-3">
                        <div class="dashboard-tabs-content-box">
                            <div class="dashboard-tabs-content-title">
                                <h3>Check your order history</h3>
                            </div>
                            <div class="dashboard-tabs-content-inn">
                                <div class="row">
                                     <div class="col-md-6">
                                     <div class="dashboard-history-table-wrap">
                                  <table id="order-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="#" class="">#2265</a></td>
                                                    <td>April 9, 2019</td>
                                                    <td>On Hold</td>
                                                    <td>£1.50 for 1 item</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2154</a></td>
                                                    <td>February 13, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£1.50 for 1 item</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2158</a></td>
                                                    <td>February 8, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£1.99 for 1 item</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2136</a></td>
                                                    <td>February 3, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£12.40 for 3 items</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2175</a></td>
                                                    <td>January 31, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£15.25 for 4 items</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2185</a></td>
                                                    <td>January 25, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£1.99 for 1 item</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2130</a></td>
                                                    <td>January 16, 2019</td>
                                                    <td>On Hold</td>
                                                    <td>£15.25 for 4 items</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2135</a></td>
                                                    <td>January 10, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£12.40 for 3 items</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2245</a></td>
                                                    <td>January 4, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£1.50 for 1 item</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2198</a></td>
                                                    <td>December 29, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£1.50 for 1 item</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2174</a></td>
                                                    <td>December 25, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£1.99 for 1 item</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2148</a></td>
                                                    <td>December 21, 2019</td>
                                                    <td>On Hold</td>
                                                    <td>£15.25 for 4 items</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2267</a></td>
                                                    <td>December 18, 2019</td>
                                                    <td>On Hold</td>
                                                    <td>£15.25 for 4 items</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2196</a></td>
                                                    <td>December 12, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£1.50 for 1 item</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#" class="">#2187</a></td>
                                                    <td>December 8, 2019</td>
                                                    <td>Processing</td>
                                                    <td>£12.40 for 3 items</td>
                                                    <td><a href="#" class="link_bttn">View</a></td>
                                                </tr>                                            
                                            </tbody>
                                        </table>
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                       <div class="order-details-wrap">
                                         <div class="title">
                                            <h3>Order details</h3>
                                            <p>Order #2239 was placed on January 14, 2019 and is currently Processing</p>
                                         </div>
                                         <div class="table-wrap table-row">
                                           <table class="table order-detail-table" style="width:100%">
                                             <thead>
                                               <tr>
                                                 <th>Product</th>
                                                 <th>Total</th>
                                               </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                  <th><a href="#">Hand Towel(Wash and Dry)</a> x 1</th>
                                                  <td>£1.50</td>
                                                </tr>
                                                <tr>
                                                    <th>Subtotal:</th>
                                                    <td><strong>£1.50</strong></td>
                                                </tr>
                                                  <tr>
                                                    <th>Paymnet Method:</th>
                                                    <td>Debit/Credit Card</td>
                                                  </tr>

                                                   <tr>
                                                    <th>TOTAL:</th>
                                                    <td><strong>£1.50</strong></td>
                                                  </tr>
                                             </toboy>
                                           </table>
                                         </div>
                                       <div class="table-row schedule-collection-wrap">
                                         <p><strong>Schedule your collection date:</strong> 14 January, 2019</p>
                                       </div>
                                         <div class="table-wrap table-row">
                                           <table class="table order-detail-table" style="width:100%">
                                             <tbody>
                                                <tr>
                                                  <th><strong>Select your collection day and time slots:</strong></th>
                                                  <td>Wednesday - 19:00-20:00</td>
                                                </tr>
                                             </toboy>
                                           </table>
                                         </div>
                                         <div class="billing-adress-wrap table-row">
                                           <h3>Billing address</h3>
                                           <p>Patrick Ejezie<br />
                                            2 Burrage Place,<br />
                                            SE18 78G<br />
                                            Info.spotlex@gmail.com</p>
                                         </div>

                                         <div class="table-row order-detail-button text-right">
                                           <button class="btn primary_btn">Reorder</button>
                                         </div>

                                        </div>
                                      </div> 
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="refer-friend" role="tabpanel" aria-labelledby="dashboard-tabs-3">
                        <div class="dashboard-tabs-content-box">
                            <div class="dashboard-tabs-content-title">
                                <h3>Refer Your Friends</h3>
                            </div>
                            <div class="dashboard-tabs-content-inn row">
                                <div class="col-md-2 offset-md-2">
                                    <div class="sm-buttons-outer">
                                        <ul>
                                            <li>
                                                <a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Share on Facebook  </a>
                                            </li>
                                            <li>
                                                <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Share on Twitter</a>
                                            </li>
                                            <li>
                                                <a href="#" class="googlePlus"><i class="fa fa-google-plus" aria-hidden="true"></i> Share on Google+</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-1">
                                    <div class="reger-frient-content">
                                        <h4>Refer friends now</h4>
                                        <p>When your friend completes their first Spotlex order using your referral code, you'll receive £10 of Spotlex credit</p>

                                        <div class="newsletter-wrap">
                                            <form>
                                                <input type="text" class="form-control" value="PATRICKE1" readonly />
                                                <button class="btn primary_btn">Copy</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade active show" id="loyality-point" role="tabpanel" aria-labelledby="dashboard-tabs-3">
                        <div class="dashboard-tabs-content-box">
                            <div class="dashboard-tabs-content-title">
                                <h3>Loyalty Points</h3>
                            </div>
                            <div class="dashboard-tabs-content-inn text-center">
                                <h3>You have 4 points</h3>
                                <p>For every pound you spend you earn one point. Once you reach 150 points, you will receive<br /> a 10GBP discount to use on future orders.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="coupen" role="tabpanel" aria-labelledby="dashboard-tabs-3">
                        <div class="dashboard-tabs-content-box">
                            <div class="dashboard-tabs-content-title">
                                <h3>Cooming Soon</h3>
                            </div>
                            <div class="dashboard-tabs-content-inn">
                                working...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection