@extends('userinterface.layouts.master')
@section('page-title')
Spotlex
@endsection
@section('content')
<section class="no-cardSec" style="background-image:url({{ asset('userinterface/images/no_card_banner.jpg') }})">
        <div class="container">
            <div class="no-cardSec-title">
                <h3>We don’t cover your area yet</h3>
                <p>But we will if we get enough votes! So register your vote now and spread the word.</p>
            </div>
            <div class="no_card_form">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First Name" />
                    </div>

                    <div class="form-group">
                        <input type="Password" class="form-control" placeholder="Email Address" />
                    </div>

                    <div class="form-group ">
                        <button class="btn primary_btn nm_btn">Subcribe</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <a href="javascript:void(0);" id="top_arrow"></a>
    @endsection
