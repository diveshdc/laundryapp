@extends('userinterface.layouts.master')
@section('page-title')
    Spotlex
@endsection
@section('content')
    <section class="section signUp-wrap">
        <div class="container">
            <div class="signUp-title text-center">
                <h3>Create your new account, already have an account? <a href="{{ url('user/login')}}">Sign In</a></h3>
            </div>
            <div class="signUp-form-wrap">
                <form class="row" id="register_user" action="{{ route('user/register') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 offset-md-3">
                        <div class="dashboard-form-wrap">
                            <div class="form-group  form-row">
                                <label for="inputState" class="col-sm-4 col-form-label">Select Address<span
                                        class="required">*</span></label>
                                <div class="col-sm-8">
                                    <select id="post_code" name=""
                                            class="form-control arrow-down  form-control-lg">
                                        <option selected="">Your Post Code</option>
                                        <option>1234</option>
                                        <option>5678</option>
                                    </select>
                                </div>
                            </div><!-- 
                            <p id="post_code"></p>
                            <p id="country"></p>
                            <p id="town"></p>
                            <p id="city"></p> -->
                            <div class="form-group form-row">
                                <label for="post_code" class="col-sm-4 col-form-label">Post Code<span
                                        class="required">*</span></label>
                                <div class="col-sm-6 input-group">
                                    <input type="text" name="post_code" class="form-control form-control-lg" id="location" value="{{ old('post_code')}}" placeholder="se187bg">
                                    @if($errors->has('post_code'))
                                        <em class="error">
                                            {{ $errors->first('post_code') }}
                                        </em>
                                    @endif
                                    <div class="input-group-append">
                                        <span class="input-group-text"><img
                                                src="{{ asset('userinterface/images/form-field-icon-1.png') }}"
                                                alt="form-field-icon-1.png">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-2 ">
                                    <button type="button" id="go_find" onclick="ckeckPostCode(this)"
                                            class="btn w-100 h-100 find-btn btn-success">Find
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </button>
                                    <div style="display: none;" id="check_postcode_loader" 
                                            class="btn w-100 h-100 find-btn btn-success">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </div>
                                </div>
                           <!--  <div style="display: none;" id="check_postcode_loader" class="btn w-100 h-100 find-btn btn-success">
                               <div class="threedotspineer">
                              <div class="bounce1"></div>
                              <div class="bounce2"></div>
                              <div class="bounce3"></div>
                            </div>
                                One moment, checking postcode
                            </div> -->
                             <div class="col-sm-10 input-group" style="margin-left: 34%;">
                                <div class="print-error-msg error post-code-error" style="display:none">
                                    <ul>
                                    </ul>
                                </div>
                            </div>
                            </div>
                    <div class="form-group  form-row">
                        <label for="building_name_no" class="col-sm-4 col-form-label">Building Name or
                            Number<span
                                class="required">*</span></label>
                        <div class="col-sm-8 input-group">
                            <input type="text" class="form-control form-control-lg" name="building_name_no" value="{{ old('building_name_no')}}"
                                   id="building_name_no"
                                   placeholder="Building Name or Number">
                                    @if($errors->has('building_name_no'))
                                        <em class="error">
                                            {{ $errors->first('building_name_no') }}
                                        </em>
                                    @endif
                            <div class="input-group-append">
                                <span class="input-group-text"><img
                                        src="{{ asset('userinterface/images/form-field-icon-2.png') }}"
                                        alt="form-field-icon-2.png"></span>
                            </div>
                        </div>
                    </div>
                            <div class="form-group  form-row">
                                <label for="street" class="col-sm-4 col-form-label">Street Name<span
                                        class="required">*</span></label>
                                <div class="col-sm-8  input-group">
                                    <input type="text" class="form-control form-control-lg" name="street" id="street" value="{{ old('street')}}"
                                           placeholder="Street Name">
                                           @if($errors->has('street'))
                                                <em class="error">
                                                    {{ $errors->first('street') }}
                                                </em>
                                            @endif
                                    <div class="input-group-append">
                                        <span class="input-group-text"><img
                                                src="{{ asset('userinterface/images/form-field-icon-3.png') }}"
                                                alt="form-field-icon-3.png"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  form-row">
                                <label for="town" class="col-sm-4 col-form-label">Town<span
                                        class="required">*</span></label>
                                <div class="col-sm-8  input-group">
                                    <input type="text" name="town" class="form-control form-control-lg" id="town" value="{{ old('town')}}"
                                           placeholder="Town">
                                           @if($errors->has('town'))
                                                <em class="error">
                                                    {{ $errors->first('town') }}
                                                </em>
                                            @endif
                                    <div class="input-group-append">
                                        <span class="input-group-text"><img
                                                src="{{ asset('userinterface/images/form-field-icon-4.png') }}"
                                                alt="form-field-icon-4.png"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-form-wrap">
                                <div class="form-group  form-row">
                                    <label for="first_name" class="col-sm-4 col-form-label">First Name<span
                                            class="required">*</span></label>
                                    <div class="col-sm-8 input-group">
                                        <input type="text" class="form-control form-control-lg" name="first_name"
                                               id="first_name" value="{{ old('first_name')}}"
                                               placeholder="Enter Your First Name">
                                                @if($errors->has('first_name'))
                                                <em class="error">
                                                    {{ $errors->first('first_name') }}
                                                </em>
                                            @endif
                                        <div class="input-group-append">
                                            <span class="input-group-text"><img
                                                    src="{{ asset('userinterface/images/form-field-icon-5.png') }}"
                                                    alt="form-field-icon-5.png"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-row">
                                    <label for="last_name" class="col-sm-4 col-form-label">Last Name<span
                                            class="required">*</span></label>
                                <div class="col-sm-8 input-group">
                                    <input type="text" class="form-control form-control-lg" name="last_name" id="last_name" value="{{ old('last_name')}}"
                                               placeholder="Enter Your Last Name">
                                               @if($errors->has('last_name'))
                                                <em class="error">
                                                    {{ $errors->first('last_name') }}
                                                </em>
                                            @endif
                                        <div class="input-group-append">
                                            <span class="input-group-text"><img
                                                    src="{{ asset('userinterface/images/form-field-icon-5.png') }}"
                                                    alt="form-field-icon-5.png"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  form-row">
                                    <label for="email" class="col-sm-4 col-form-label">Email Address<span
                                            class="required">*</span></label>
                                    <div class="col-sm-8 input-group">
                                        <input type="text" class="form-control form-control-lg" name="email" id="email" value="{{ old('email')}}" placeholder="Enter Your Email Address">
                                        @if($errors->has('email'))
                                                <em class="error">
                                                    {{ $errors->first('email') }}
                                                </em>
                                            @endif
                                        <div class="input-group-append">
                                            <span class="input-group-text"><img
                                                    src="{{ asset('userinterface/images/form-field-icon-6.png') }}"
                                                    alt="form-field-icon-6.png"></span>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group  form-row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Password<span
                                        class="required">*</span></label>
                                <div class="col-sm-8 input-group">
                                    <input type="password" class="form-control form-control-lg" name="password"
                                           id="password"
                                           placeholder="Enter New Password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><img
                                                src="{{ asset('userinterface/images/form-field-icon-7.png') }}"
                                                alt="form-field-icon-7.png"></span>
                                    </div>
                                </div>
                            </div>

                                <div class="form-group  form-row">
                                    <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password </label>
                                    <div class="col-sm-8 input-group">
                                        <input type="password" class="form-control form-control-lg" id="confirm_password" name="password_confirmation"
                                               placeholder="Confirm Your Password">
                                               @if($errors->has('password_confirmation'))
                                                <em class="error">
                                                    {{ $errors->first('password_confirmation') }}
                                                </em>
                                            @endif
                                        <div class="input-group-append">
                                            <span class="input-group-text"><img
                                                    src="{{ asset('userinterface/images/form-field-icon-8.png') }}"
                                                    alt="form-field-icon-8.png"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  form-row">
                                    <label for="phone_number" class="col-sm-4 col-form-label">Phone Number<span
                                            class="required">*</span></label>
                                    <div class="col-sm-8 input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">
                                         <select class="selectpicker" data-width="fit"
                                                 style="display: none;">
                                            <option
                                                data-content="<span class=&quot;flag-icon flag-icon-us&quot;></span>"></option>
                                           <option
                                               data-content="<span class=&quot;flag-icon flag-icon-mx&quot;></span>"></option>
                                          </select>  
                                           </span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" name=     "phone_number"id="phone_number" value="{{ old('phone_number') }}"
                                             placeholder="123 456 7890">
                                            @if($errors->has('phone_number'))
                                                <em class="error">
                                                    {{ $errors->first('phone_number') }}
                                                </em>
                                            @endif
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <img src="{{ asset('userinterface/images/form-field-icon-9.png') }}"
                                                    alt="form-field-icon-9.png">
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group label-wrap">
                                    <p>Where did you hear about Spotlex?</p>

                                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="reference_from" data-live-search-placeholder="Test">
                                        <option value="Tom Foolery" data-subtext="Rep California">Tom Foolery</option>
                                        <option value="Bill Gordon" data-subtext="Sen California">Bill Gordon</option>
                                        <option value="Elizabeth Warren" data-subtext="Sen Massacusetts">Elizabeth Warren</option>
                                        <option value="Mario Flores" data-subtext="Rep Alabama">Mario Flores</option>
                                        <option value="Don Young" data-subtext="Rep Alaska">Don Young</option>
                                        <option value="Marvin Martinez" data-subtext="Rep California" disabled="disabled">Marvin Martinez
                                        </option>
                                    </select>

                                </div>  

                                <div class="custom_checkbox tram_wrap">
                                    <label class="align-items-start">
                                        <input type="checkbox"/>
                                        <span class="check_text">
                                            </span>
                                        <p>By signing up you are agreeing to the <a href="#">Terms and Conditions</a>
                                            and <a href="#"> Privacy Policy</a></p>

                                    </label>

                                    <label class="align-items-start">
                                        <input type="checkbox" name="receive_offer" />
                                        <span class="check_text">
                                            </span>
                                        <p>I want to receive exclusive news and special offers from Spotlex</p>
                                    </label>
                                    <label class="align-items-start">
                                        <input type="checkbox"/>
                                        <span class="check_text">
                                            </span>
                                        <p>I want to receive mail about account creation.</p>

                                    </label>
                                </div>
                                <div class="buttons-outer">
                                    <button class="btn primary_btn nm_btn" type="submit">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
