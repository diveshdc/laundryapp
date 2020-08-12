 <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- <title>Spotlex</title> -->
       <title>@yield('page-title')</title>
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Favicon -->
     <link rel="icon" href="{{ asset('userinterface/images/favicon.png')}}" type="image/x-icon">
    <!-- CSS -->
    <link href="{{ asset('userinterface/css/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('userinterface/css/main.css')}}">
    <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;
            background: url('{{ asset('userinterface/images/Preloader_2.gif') }}') center no-repeat #fff;
        }
    </style>

</head>
{{--<div class="mainloader"></div>--}}
<body>
 <div class="se-pre-con"></div>
 <div class="">
            <!-- header starts -->
            @include("userinterface.layouts.header")
            <!-- header end--- -->
            <div class="">
                <!-- main content starts -->
                @yield('content')
                <!-- main content end--- -->
            </div>
            <!-- footer starts -->
         @include("userinterface.layouts.footer")
            <!-- footer end--- -->
        </div>
    <!-- Scripts -->
    @yield('page-script')
</body>
<script src="{{ asset('userinterface/js/jquery.min.js') }}"></script>
<script src="{{ asset('userinterface/js/popper.min.js') }}"></script>
<script src="{{ asset('userinterface/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('userinterface/js/wow.js') }}"></script>
<script src="{{ asset('userinterface/js/aos.js') }}"></script>
<script src="{{ asset('userinterface/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('userinterface/js/custom.js') }}"></script>
<script src="{{ asset('userinterface/js/checkpostcode.js') }}"></script>
<script src="{{ asset('js/admin/jquery.validate.min.js') }}"></script>
<script src="https://www.jqueryscript.net/demo/Bootstrap-4-Dropdown-Select-Plugin-jQuery/dist/js/bootstrap-select.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script src="{{ asset('userinterface/js/formvalidation/registeruser.js') }}"></script>
<script src="{{ asset('js/admin/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('userinterface/js/send_message.js') }}"></script>
<script>
    jQuery('#phone_number').mask('(999) 9999-9999');
    jQuery('#mobile_number').mask('(999) 9999-9999');
    $("a[href='#how-it-works']").click(function() {
        $("html, body").animate({
            scrollTop: $($(this).attr("href")).offset().top
        }, 700);
    });
</script>

</html>


