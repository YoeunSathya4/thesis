<!doctype html>
<html class="no-js" lang="en">

    <!-- Mirrored from techlinqs.com/html/bookstore-0.2/bookstore-ltr/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Feb 2018 15:56:52 GMT -->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content=""/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
            <!-- Title Of Site -->
            <title>@yield('title')</title>
        <link rel="shortcut icon" href="{{ asset ('public/frontend/images/fav-icon.png')}}" type="image/x-icon">
        <!-- StyleSheets -->
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/animate.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/icomoon.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/main.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/color-1.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/style.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/responsive.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/transition.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/navbar.css')}}">
        @yield('css')
        @if($locale=="kh")
            <link href="https://fonts.googleapis.com/css?family=Hanuman" rel="stylesheet">
            <link href="{{ asset ('public/frontend/css/kh_laugauges.css')}}" rel="stylesheet">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        @endif
        <!-- Online Lib -->
        
        

        <!-- Switcher CSS -->
        <link href="{{ asset ('public/frontend/switcher/switcher.css')}}" rel="stylesheet" type="text/css"/> 
        <link rel="stylesheet" id="skins" href="{{ asset ('public/frontend/css/default.css')}}" type="text/css" media="all">
        <script src="{{ asset ('public/frontend/js/vendor/jquery.js')}}"></script>  
        

        <!-- FontsOnline -->
        <link href='https://fonts.googleapis.com/css?family=Merriweather:300,300italic,400italic,400,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900italic,900,100italic,100' rel='stylesheet' type='text/css'>

        <!-- JavaScripts -->
        <script src="{{ asset ('public/frontend/js/vendor/modernizr.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
   
<body>
    <!-- Wrapper -->
<div class="wrapper push-wrapper">

    <!-- Header -->
    <header id="header">
        
        <!-- Top Bar -->
        <div class="topbar">
            <div class="container">
                
                <!-- Online Option -->
                <div class="online-option">
                    <ul>
                        <li><a href="{{route('shopping-cart',$locale)}}" ><i class="fa fa-shopping-cart" style="font-size: 20px;"></i>  {{__('general.shopping-cart')}} <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span></a> </li>
                    </ul>
                </div>
                <!-- Online Option -->

                <!-- Social Icons -->
                <div class="social-icons pull-right">
                    <ul>
                        <li>
                            <a href="{{route($defaultData['routeName'], $defaultData['khRouteParamenters'])}}">
                                <img src="{{ asset ('public/frontend/images/khmer.png')}}">
                            </a>
                        </li>   
                        <li>
                            <a href="{{route($defaultData['routeName'], $defaultData['enRouteParamenters'])}}"> 
                                <img src="{{ asset ('public/frontend/images/english.png')}}">
                            </a>
                        </li>   
                    </ul>
                </div>
                <!-- Social Icons -->

                <!-- Cart Option -->
                <div class="cart-option">
                    <ul>
                        <!-- <li class="add-cart"><a href="#"><i class="fa fa-shopping-bag"></i><span>3</span></a></li>
                        <li><a href="#"><i class="fa fa-heart-o"></i>wish List 0 items</a></li> -->
                        @if(Auth::guard('customer')->user())
                                <li><a href="{{ route('profile', $locale) }}" ><i class="fa fa-user"></i>{{Auth::guard('customer')->user()->name}}</a> </li>
                                <li><a href="{{ route('logout', $locale) }}" >{{__('general.logout')}}</a> </li>
                        @else
                            <li><a href="{{ route('login', $locale) }}" ><i class="fa fa-user"></i>{{__('general.login')}}</a> </li>
                                <li><a href="{{ route('sign-up', $locale) }}" >{{__('general.sign-up')}}</a> </li>
                        @endif
                    </ul>
                </div>
                <!-- Cart Option -->

            </div>
        </div>
        <!-- Top Bar -->

        <!-- Nav -->
        <nav class="nav-holder style-1">
            <div class="container">
                <div class="mega-dropdown-wrapper">

                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ route('home', $locale) }}"><img src="{{ asset ('public/frontend/images/logo-1.png')}}" alt=""></a>
                    </div>
                    <!-- Logo -->

                    <!-- Search bar -->
                    <!-- <div class="search-bar">
                        <a href="#"><i class="fa fa-search"></i></a>
                    </div> -->
                    <!-- Search bar -->

                    <!-- Responsive Button -->
                    <div class="responsive-btn">
                        <a href="#menu" class="menu-link circle-btn"><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- Responsive Button -->

                    <!-- Navigation -->
                    <div class="navigation">
                        <ul>
                            
                            <li class="@yield('home')"><a href="{{ route('home', $locale) }}"><i class="fa fa-home"></i>{{__('general.home')}}</a></li>
                            <li class="@yield('about-us')"><a href="{{ route('about-us', $locale) }}"><i class="fa fa-user"></i>{{__('general.about-us')}}</a></li>
                            <li class="@yield('product')"><a href="{{ route('product', $locale) }}"><i class="fa fa-briefcase"></i>{{__('general.product')}}</a></li>
                            <li class="@yield('promotion')"><a href="{{ route('promotion', $locale) }}"><i class="fa fa-bullhorn"></i>{{__('general.promotion')}}</a></li>
                            <li class="@yield('news')"><a href="{{ route('news', $locale) }}"><i class="fa fa-pencil"></i>{{__('general.news')}}</a></li>
                            <li class="@yield('contact-us')"><a href="{{ route('contact-us', $locale) }}"><i class="fa fa-fax"></i>{{__('general.contact-us')}}</a></li>
                        </ul>
                    </div>
                    <!-- Navigation -->

                </div>
            </div>
        </nav>
        <!-- Nav -->

        

    </header>
   
<!-- Main Content -->
    <main class="main-content">

        @yield('content')
    </main>
    <!-- Main Content -->
    <!-- Footer -->
    <footer style="background-image: url({{ asset ('public/frontend/images/footer.png')}})" id="footer"> 

        <!-- Footer columns -->
        <div class="footer-columns">
            <div class="container">

                <!-- Columns Row -->
                <div class="row">
                    
                    <!-- Footer Column -->
                    <div class="col-lg-12 col-sm-12" style="text-align: center;">
                        <div class="footer-column logo-column">
                            <a href="index-1.html"><img src="{{ asset ('public/frontend/images/logo-2.png')}}" alt=""></a>
                            <p>@if($defaultData['slogan']) {{$defaultData['slogan']->content}} @endif</p>
                            <ul class="address-list">
                                <li><i class="fa fa-home"></i>@if($defaultData['address']) {{$defaultData['address']->content}} @endif</li>
                                <li><i class="fa fa-phone"></i>@if($defaultData['phone']) {{$defaultData['phone']->content}} @endif</li>
                                <li><i class="fa fa-envelope"></i>@if($defaultData['email']) {{$defaultData['email']->content}} @endif</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Column -->

                    
                        

                </div>
                <!-- Columns Row -->

            </div>
        </div>
        <!-- Footer columns -->
        
        <!-- Sub Footer -->
        <div class="sub-foorer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Copyright <i class="fa fa-copyright"></i> 2017-2018 <span class="theme-color"> Khemarareaksmey Book Center</span> All Rights Reserved.</p>
                    </div>
                    <div class="col-sm-6">
                        <a class="back-top" href="#">{{__('general.back-to-top')}}<i class="fa fa-caret-up"></i></a>
                      
                    </div>
                </div>
            </div>
        </div>
        <!-- Sub Footer -->

    </footer>
    <!-- Footer -->

</div>
<!-- Wrapper -->

<!-- Slide Menu -->
<nav id="menu" class="responive-nav">
    <a class="r-nav-logo" href="index-2.html"><img src="{{ asset ('public/frontend/images/logo-1.png')}}" alt=""></a>
    <ul class="respoinve-nav-list">
       <li class="@yield('home')"><a href="{{ route('home', $locale) }}"><i class="fa fa-home" style="padding-right: 5px;"></i>{{__('general.home')}}</a></li>
                            <li class="@yield('about-us')"> <a href="{{ route('about-us', $locale) }}"><i class="fa fa-user" style="padding-right: 5px;"></i> {{__('general.about-us')}}</a></li>
                            <li class="@yield('product')"> <a href="{{ route('product', $locale) }}"><i class="fa fa-briefcase" style="padding-right: 5px;"></i> {{__('general.product')}}</a></li>
                            <li class="@yield('promotion')"><a href="{{ route('promotion', $locale) }}"><i class="fa fa-bullhorn" style="padding-right: 5px;"></i> {{__('general.promotion')}}</a></li>
                            <li class="@yield('news')"><a href="{{ route('news', $locale) }}"><i class="fa fa-pencil" style="padding-right: 5px;"></i> {{__('general.news')}}</a></li>
                            <li class="@yield('contact-us')"><a href="{{ route('contact-us', $locale) }}"><i class="fa fa-fax" style="padding-right: 5px;"></i> {{__('general.contact-us')}}</a></li>                    
    </ul>
</nav>
<!-- Slide Menu -->


<!-- Java Script -->
     
<script src="{{ asset ('public/frontend/js/vendor/bootstrap.min.js')}}"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="{{ asset ('public/frontend/js/gmap3.min.js')}}"></script>                 
<script src="{{ asset ('public/frontend/js/datepicker.js')}}"></script>                    
<script src="{{ asset ('public/frontend/js/contact-form.js')}}"></script>                  
<script src="{{ asset ('public/frontend/js/bigslide.js')}}"></script>                          
<script src="{{ asset ('public/frontend/js/3d-book-showcase.js')}}"></script>                  
<script src="{{ asset ('public/frontend/js/turn.js')}}"></script>                          
<script src="{{ asset ('public/frontend/js/jquery-ui.js')}}"></script>                             
<script src="{{ asset ('public/frontend/js/mcustom-scrollbar.js')}}"></script>                 
<script src="{{ asset ('public/frontend/js/timeliner.js')}}"></script>                 
<script src="{{ asset ('public/frontend/js/parallax.js')}}"></script>               
<script src="{{ asset ('public/frontend/js/countdown.js')}}"></script> 
<script src="{{ asset ('public/frontend/js/countTo.js')}}"></script>       
<script src="{{ asset ('public/frontend/js/owl-carousel.js')}}"></script>  
<script src="{{ asset ('public/frontend/js/bxslider.js')}}"></script>  
<script src="{{ asset ('public/frontend/js/appear.js')}}"></script>                
<script src="{{ asset ('public/frontend/js/sticky.js')}}"></script>                    
<script src="{{ asset ('public/frontend/js/prettyPhoto.js')}}"></script>           
<script src="{{ asset ('public/frontend/js/isotope.pkgd.js')}}"></script>                   
<script src="{{ asset ('public/frontend/js/wow-min.js')}}"></script>           
<script src="{{ asset ('public/frontend/js/classie.js')}}"></script>                   
<script src="{{ asset ('public/frontend/js/main.js')}}"></script>   
<script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>   
<script type="text/javascript">

    function addfavorite(id){
           
                    alert(id);
                    $.ajax({
                        url: "",
                        type: 'POST',
                        data: {id:id},
                        success: function( response ) {
                           toastr.success("Product has been added to favorite.");
                           $('#add-favorite').css({'background' : '#b09b9b','color':'#e71e1e'});
                        },
                        error: function( response ) {
                           toastr.warning("Please sign in your account before add to favorite list.");
                        }
                            
                    });
                 
        }

        function removefavorite(id){
           
                    alert(id);
                    $.ajax({
                        url: "",
                        type: 'POST',
                        data: {id:id},
                        success: function( response ) {
                           toastr.success("Product has been unfavorite.");

                        },
                        error: function( response ) {
                           toastr.warning("Please sign in your account before add to favorite list.");
                        }
                            
                    });
                 
        }

        $.fn.andSelf = function() {
          return this.addBack.apply(this, arguments);
        }
</script>
<!-- Switcher JS -->
<script type="text/javascript" src="{{ asset ('public/frontend/switcher/cookie.js')}}"></script>
<script type="text/javascript" src="{{ asset ('public/frontend/switcher/colorswitcher.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- Switcher JS -->
@yield('product-search')
@yield('appbottomjs')
@yield('property-js')

@if(Session::has('msg'))
<script type="text/JavaScript">
toastr.success("{!!Session::get('msg')!!}");
</script>
@endif

@if(Session::has('error'))
<script type="text/JavaScript">
toastr.error("{!!Session::get('error')!!}");
</script>
@endif
  
</body>
</html>