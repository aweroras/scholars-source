<!doctype html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Scholar's Source</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.css') }}">
</head>
<body>
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo">
                        <img src="{{ asset('template/assets/img/logo/logo.png') }}"alt="">
                        </div>
                       <!-- Main-menu -->
                       <div class="main-menu d-none d-lg-block">
                            <nav>                                                
                                <ul id="navigation">  
                                    <li><a href="{{ route('customer.index') }}">Home</a></li>
                                    <li><a href="{{ route('customer.shop') }}">shop</a></li>
                                    <li><a href="{{ route('about') }}">about</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">
                            <ul>
                                <li>
                                    
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <!-- Hero Area Start
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>User Profile</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
        @yield('content')
     <!-- JS here -->

     <script src="{{ asset('template/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('template/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('template/assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('template/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/slick.min.js') }}"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('template/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="{{ asset('template/assets/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.sticky.js') }}"></script>

    <!-- contact js -->
    <script src="{{ asset('template/assets/js/contact.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('template/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('template/assets/js/main.js') }}"></script>

</body>
    
</html>