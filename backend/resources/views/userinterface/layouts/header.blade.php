    <!--------Header Start---------->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/user') }}"><img src="{{ asset('userinterface/images/logo.png')}}" alt="logo.png" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
             <!--    @php
                print_r(Auth::User());
                @endphp -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                     @guest
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url('user/login')}}">Sign In</a>
                    </li>
                     @endguest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('price/list')}}">Pricing</a>
                    </li>

                    <li class="nav-item">
{{--                        <a class="nav-link" href="{{ url('how-it-works')}}">How It Works</a>--}}
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('commercial-services')}}">Commercial</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('refer-a-friend') }}">Refer a friend</a>
                    </li>

                    <li class="nav-item">
                        @if(Auth::user())
                        <a class="nav-link order_btn" href="#">Order Now</a>
                        @else
                        <a class="nav-link order_btn" href="{{ url('user/login')}}">Order Now</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>



