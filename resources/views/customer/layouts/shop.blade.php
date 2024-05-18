<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Scholar's Source</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('template/assets/img/logo/logo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('template/assets/img/logo/logo.png') }}"
                                    alt=""></a>
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
                                    <div class="nav-search search-switch">
                                        <span class="flaticon-search"></span>
                                    </div>
                                </li>
                                <li> <a href="login.html"><span class="flaticon-user"></span></a></li>
                                <li class="user-dropdown">
                                    <a id="user-icon" href="#">
                                        <span class="flaticon-shopping-cart"></span>
                                    </a>
                                    <div class="user-dropdown-content" id="user-dropdown-content">
                                        <a href="{{ route('customer.cart') }}">My Cart</a>
                                        <a href="{{ route('customer.orderinfo') }}">Order History</a>
                                        <a href="{{ route('reviews.index') }}">My Reviews</a>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div class="col-12">
                <div class="mobile_menu d-block d-lg-none"></div>
            </div>
        </div>
        </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Header End -->
    </header>
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Your Stationery Staples</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main>
            @yield('content') <!-- This will be replaced by the content from customer.shop -->
        </main>

        <footer>

            <!--? Search model Begin -->
            <div class="search-model-box">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <div class="search-close-btn">+</div>
                    <form class="search-model-form" action="{{ route('customer.search') }}" method="GET">
                        <!-- Use the 'name' attribute to ensure the input value is sent with the correct parameter name -->
                        <input type="text" name="search" id="search-input" placeholder="Searching key.....">
                        <button type="submit" class="btn btn-sm hero-btn"
                            style="font-size: 13px; padding: 15px 20px;">Search</button>
                    </form>
                </div>
            </div>
            <!-- Search model end -->

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
