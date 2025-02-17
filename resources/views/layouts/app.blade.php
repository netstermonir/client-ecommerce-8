<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/8330d3dfaf.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.css">
    <link href="{{ asset('public/frontend') }}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/responsive.css">
    <link rel="stylesheet" href="{{asset('public/backend/plugins/toastr/toastr.min.css')}}">
         <style>
     #social-links ul{
          padding-left: 0;
     }
     #social-links ul li {
          display: inline-block;
     } 
     #social-links ul li a {
          padding: 6px;
          border: 1px solid #ccc;
          border-radius: 5px;
          margin: 1px;
          font-size: 25px;
     }
     #social-links .fa-facebook{
           color: #0d6efd;
     }
     #social-links .fa-twitter{
           color: deepskyblue;
     }
     #social-links .fa-linkedin{
           color: #0e76a8;
     }
     #social-links .fa-whatsapp{
          color: #25D366
     }
     #social-links .fa-reddit{
          color: #FF4500;;
     }
     #social-links .fa-telegram{
          color: #0088cc;
     }
     </style>
</head>

<body>

<div class="super_container">

    <!-- Header -->

    <header class="header">

        <!-- Top Bar -->

        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-row">
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('public/frontend') }}/images/phone.png" alt=""></div>{{ $setting->phone_two }}</div>
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('public/frontend') }}/images/mail.png" alt=""></div><a href=""><span class="__cf_email__" data-cfemail="">{{ $setting->main_mail }}</span></a></div>
                        <div class="top_bar_content ml-auto">
                            @if(Auth::check())
                            <div class="top_bar_menu">
                                <ul class="standard_dropdown top_bar_dropdown">
                                    <li>
                                        <a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
                                        <ul style="width: 300px; padding: 10px; left: -100px;">
                                            <li><a href="{{ route('profile') }}">Profile</a></li>
                                            <li><a href="{{ route('customar.logout') }}">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            @endif
                             @guest
                            <div class="top_bar_menu">
                                <ul class="standard_dropdown top_bar_dropdown">
                                    <li>
                                        <a href="#">Login<i class="fas fa-user"></i></a>
                                        <ul style="width: 300px; padding: 10px; left: -100px;">
                                            <br>
                                            <div class="login">
                                                <form action="{{ route('login') }}" method="POST">
                                                    @csrf
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" name="email" class="form-control" required id="email" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password:</label>
                                                    <input type="password" name="password" class="form-control" required id="password" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <div class="ml-4 offset-md-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Remember Me') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" style="cursor:pointer;" class="form-control btn btn-sm btn-info">Login</button>
                                                </div>
                                            </form>
                                            <div class="form-group">
                                                <a href="{{ route('social.oauth', 'google') }}" class="text-white">
                                                    <button type="submit" style="cursor:pointer;" class="form-control btn btn-sm btn-secondary">
                                                        <img width="30" src="{{ asset('public/frontend') }}/images/google.png" alt="Login With Google"> Login With Google
                                                    </button>
                                                </a>
                                            </div>
                                            </div>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}">Register<i class="fas fa-sign-out-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Main -->

        <div class="header_main">
            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="col-lg-2 col-sm-3 col-3 order-1">
                        <div class="logo_container">
                            <div class="logo"><a href="{{ url('/') }}">Online</a></div>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                        <div class="header_search">
                            <div class="header_search_content">
                                <div class="header_search_form_container">
                                    <form action="#" class="header_search_form clearfix">
                                        <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
                                        <div class="custom_dropdown">
                                            <div class="custom_dropdown_list">
                                                <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                <i class="fas fa-chevron-down"></i>
                                                <ul class="custom_list clc">
                                                    <li><a class="clc" href="#">All Categories</a></li>
                                                    <li><a class="clc" href="#">Computers</a></li>
                                                    <li><a class="clc" href="#">Laptops</a></li>
                                                    <li><a class="clc" href="#">Cameras</a></li>
                                                    <li><a class="clc" href="#">Hardware</a></li>
                                                    <li><a class="clc" href="#">Smartphones</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset('public/frontend') }}/images/search.png" alt=""></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    @php
                        $wishlist = DB::table('wishlists')->where('user_id', Auth::id())->count();
                    @endphp
                    <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                        <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                            <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                <div class="cart_icon">
                                    <img src="{{ asset('public/frontend') }}/images/heart.png" alt="">
                                    <div class="cart_count">{{ $wishlist }}</div>
                                </div>
                                <div class="wishlist_content">
                                    <div class="wishlist_text"><a href="{{ route('wishlist.page') }}">Wishlist</a></div>

                                </div>
                            </div>

                            <!-- Cart -->
                            <div class="cart">
                                <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                    <div class="cart_icon">
                                        <img src="{{ asset('public/frontend') }}/images/cart.png" alt="">
                                        <div class="cart_count"><span class="cart_qty"></span></div>
                                    </div>
                                    <div class="cart_content">
                                        <div class="cart_text"><a href="{{ route('cart.page') }}">Cart</a></div>
                                        <div class="cart_price">{{ $setting->currency }}<span class="cart_total"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('main-nav')
    </header>

    @yield('content')

    <!-- Footer -->

    @include('layouts.front-partial.footer')

<script src="{{ asset('public/frontend') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('public/frontend') }}/styles/bootstrap4/popper.js"></script>
<script src="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/easing/easing.js"></script>
<script src="{{ asset('public/frontend') }}/js/custom.js"></script>
<script src="{{ asset('public/frontend') }}/js/product_custom.js"></script>
<script src="{{ asset('public/frontend') }}/js/cart_custom.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/parallax-js-master/parallax.min.js"></script>
<script src="{{ asset('public/frontend') }}/js/shop_custom.js"></script>
<script src="{{ asset('public/backend/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/backend/plugins/printThis/printThis.js') }}"></script>
<script src="{{ asset('public/js/share.js') }}"></script>

<script type="text/javascript">
    function Cart() {
      $.ajax({
      url: '{{ route('all.cart') }}',
      type:'get',
      async: false,
      dataType: 'json',
      success:function(data){
        $('.cart_qty').empty();
        $('.cart_total').empty();
        $('.cart_qty').append(data.cart_qty);
        $('.cart_total').append(data.cart_total);
      }
    });
    }
    $(document).ready(function (event){
        Cart();
    })
</script>
<script>
  @if(Session::has('messege'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch(type){
      case 'info':
      toastr.info("{{ Session::get('messege') }}");
      break;
      case 'success':
      toastr.success("{{ Session::get('messege') }}");
      break;
      case 'warning':
      toastr.warning("{{ Session::get('messege') }}");
      break;
      case 'error':
      toastr.error("{{ Session::get('messege') }}");
      break;
    }
  @endif
</script>

</body>


</html>
