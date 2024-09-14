<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eTrade || Home-05</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/web/assets/images/favicon.png">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/web/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="/web/assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="/web/assets/css/vendor/flaticon/flaticon.css">
    <link rel="stylesheet" href="/web/assets/css/vendor/slick.css">
    <link rel="stylesheet" href="/web/assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="/web/assets/css/vendor/jquery-ui.min.css">
    <link rel="stylesheet" href="/web/assets/css/vendor/sal.css">
    <link rel="stylesheet" href="/web/assets/css/vendor/magnific-popup.css">
    <link rel="stylesheet" href="/web/assets/css/vendor/base.css">
    <link rel="stylesheet" href="/web/assets/css/style.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/personal/personal.css">

    @livewireStyles

    @stack('scripts')


</head>


<body class="sticky-header">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
    <!-- Start Header -->
    <header class="header axil-header header-style-7">
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-dropdown">
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    USD
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">USD</a></li>
                                    <li><a class="dropdown-item" href="#">AUD</a></li>
                                    <li><a class="dropdown-item" href="#">EUR</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-link">
                            <ul class="quick-link">
                                <li><a href="#">Help</a></li>
                                @if (Auth::guest())
                                    <li><a href="{{ route('register') }}">Join Us</a></li>
                                    <li><a href="{{ route('login') }}">Sign In</a></li>
                                @endif
                                @if (Auth::user())
                                    <li><a href="sign-in.html"><i class="bi bi-person-fill"></i>
                                            {{ Auth::user()->name }}</a></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="btn btn-outline-light" type="submit">Logout</button>
                                        </form>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="index.html" class="logo logo-dark">
                            {{-- <img src="/web/assets/images/logo/logo.png" alt="Site Logo"> --}}
                            <img src="/logo/VIVLA MAIN LOGO WEBT2.png" alt="Site Logo" width="40" height="157">
                        </a>
                        <a href="index.html" class="logo logo-light">
                            {{-- <img src="/logo/VIVLA MAIN LOGO WEBT2.png" alt="Site Logo" > --}}
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="index.html" class="logo">
                                    <img src="/web/assets/images/logo/logo.png" alt="Site Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdown-header-menu" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="far fa-th-large"></i> Categories
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown-header-menu">
                                        <li><a class="dropdown-item" href="shop-sidebar.html">Fashion</a></li>
                                        <li><a class="dropdown-item" href="shop-sidebar.html">Electronics</a></li>
                                        <li><a class="dropdown-item" href="shop-sidebar.html">Home Decor</a></li>
                                        <li><a class="dropdown-item" href="shop-sidebar.html">Medicine</a></li>
                                        <li><a class="dropdown-item" href="shop-sidebar.html">Furniture</a></li>
                                        <li><a class="dropdown-item" href="shop-sidebar.html">Crafts</a></li>
                                        <li><a class="dropdown-item" href="shop-sidebar.html">Accessories</a></li>
                                        <li><a class="dropdown-item" href="shop-sidebar.html">Handicraft</a></li>
                                    </ul>
                                </li>
                                <li><a class="active" href="{{ route('home') }}"><i class="bi bi-house-door"></i>
                                        Home</a></li>
                                <li>
                                    <a href="{{ route('products') }}"><i class="bi bi-bag-dash"></i> Shop</a>
                                </li>
                                <li><a href="{{ route('about') }}"><i class="bi bi-info-circle"></i> About</a></li>
                                <li><a href="{{ route('contact') }}"><i class="bi bi-telephone"></i> Contact</a></li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="axil-search d-xl-block d-none">
                                <input type="search" class="placeholder product-search-input" name="search2"
                                    id="search2" value="" maxlength="128"
                                    placeholder="What are you looking for?" autocomplete="off">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="bi bi-search bi-sm"></i>
                                </button>
                            </li>
                            <li class="axil-search d-xl-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="bi bi-search bi-sm"></i>
                                </a>
                            </li>
                            <li class="wishlist">
                                <a href="{{ route('wishlist') }}">
                                    <i class="bi bi-heart"></i>
                                </a>
                            </li>
                            <li class="shopping-cart">
                                @if (Auth::user())
                                    <a class="cart-dropdown-btn">
                                        <span class="cart-count">
                                            <livewire:components.cart-count :display="'count'" />
                                        </span>
                                        <i class="bi bi-cart"></i>
                                    </a>
                                @endif
                                @if (Auth::guest())
                                    <a href="{{ route('cart') }}" class="cart-dropdown-new-btn">
                                        <span class="cart-count">
                                            <livewire:components.cart-count :display="'count'" />
                                        </span>
                                        <i class="bi bi-cart"></i>
                                    </a>
                                @endif
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="bi bi-list"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
        <div class="header-top-campaign">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-10">
                        <div class="header-campaign-activation axil-slick-arrow arrow-both-side header-campaign-arrow">
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>STUDENT NOW GET 10% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>STUDENT NOW GET 10% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->



    {{ $slot }}


    <div class="service-area mt-5">
        <div class="container">
            <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="/web/assets/images/icons/service1.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Fast &amp; Secure Delivery</h6>
                            <p>Tell about your service.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="/web/assets/images/icons/service2.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Money Back Guarantee</h6>
                            <p>Within 10 days.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="/web/assets/images/icons/service3.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">24 Hour Return Policy</h6>
                            <p>No question ask.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="/web/assets/images/icons/service4.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Pro Quality Support</h6>
                            <p>24/7 Live support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Footer Area  -->
    <footer class="axil-footer-area footer-style-2">
        <!-- Start Footer Top Area  -->
        <div class="footer-top separator-top">
            <div class="container">
                <div class="row">
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Support</h5>
                            <!-- <div class="logo mb--30">
                            <a href="index.html">
                                <img class="light-logo" src="/web/assets/images/logo/logo.png" alt="Logo Images">
                            </a>
                        </div> -->
                            <div class="inner">
                                <p>685 Market Street, <br>
                                    Las Vegas, LA 95820, <br>
                                    United States.
                                </p>
                                <ul class="support-list-item">
                                    <li><a href="mailto:example@domain.com"><i class="fal fa-envelope-open"></i>
                                            example@domain.com</a></li>
                                    <li><a href="tel:(+01)850-315-5862"><i class="fal fa-phone-alt"></i> (+01)
                                            850-315-5862</a></li>
                                    <!-- <li><i class="fal fa-map-marker-alt"></i> 685 Market Street,  <br> Las Vegas, LA 95820, <br> United States.</li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Account</h5>
                            <div class="inner">
                                <ul>
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="sign-up.html">Login / Register</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="shop.html">Shop</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Quick Link</h5>
                            <div class="inner">
                                <ul>
                                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="terms-of-service.html">Terms Of Use</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Download App</h5>
                            <div class="inner">
                                <span>Save $3 With App & New User only</span>
                                <div class="download-btn-group">
                                    <div class="qr-code">
                                        <img src="/web/assets/images/others/qr.png" alt="Axilthemes">
                                    </div>
                                    <div class="app-link">
                                        <a href="#">
                                            <img src="/web/assets/images/others/app-store.png" alt="App Store">
                                        </a>
                                        <a href="#">
                                            <img src="/web/assets/images/others/play-store.png" alt="Play Store">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                </div>
            </div>
        </div>
        <!-- End Footer Top Area  -->
        <!-- Start Copyright Area  -->
        <div class="copyright-area copyright-default separator-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="social-share">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-discord"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="copyright-left d-flex flex-wrap justify-content-center">
                            <ul class="quick-link">
                                <li>© 2023. All rights reserved by <a target="_blank"
                                        href="https://axilthemes.com/">Axilthemes</a>.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div
                            class="copyright-right d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
                            <span class="card-text">Accept For</span>
                            <ul class="payment-icons-bottom quick-link">
                                <li><img src="/web/assets/images/icons/cart/cart-1.png" alt="paypal cart"></li>
                                <li><img src="/web/assets/images/icons/cart/cart-2.png" alt="paypal cart"></li>
                                <li><img src="/web/assets/images/icons/cart/cart-5.png" alt="paypal cart"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area  -->
    </footer>
    <!-- End Footer Area  -->

    <!-- Product Quick View Modal Start -->
    <div class="modal fade quick-view-product" id="quick-view-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="single-product-thumb">
                        <div class="row">
                            <div class="col-lg-7 mb--40">
                                <div class="row">
                                    <div class="col-lg-10 order-lg-2">
                                        <div
                                            class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                                            <div class="thumbnail">
                                                <img src="/web/assets/images/product/product-big-01.png"
                                                    alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget">20% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a href="/web/assets/images/product/product-big-01.png"
                                                        class="popup-zoom">
                                                        <i class="far fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="thumbnail">
                                                <img src="/web/assets/images/product/product-big-02.png"
                                                    alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget">20% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a href="/web/assets/images/product/product-big-02.png"
                                                        class="popup-zoom">
                                                        <i class="far fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="thumbnail">
                                                <img src="/web/assets/images/product/product-big-03.png"
                                                    alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget">20% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a href="/web/assets/images/product/product-big-03.png"
                                                        class="popup-zoom">
                                                        <i class="far fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 order-lg-1">
                                        <div class="product-small-thumb small-thumb-wrapper">
                                            <div class="small-thumb-img">
                                                <img src="/web/assets/images/product/product-thumb/thumb-08.png"
                                                    alt="thumb image">
                                            </div>
                                            <div class="small-thumb-img">
                                                <img src="/web/assets/images/product/product-thumb/thumb-07.png"
                                                    alt="thumb image">
                                            </div>
                                            <div class="small-thumb-img">
                                                <img src="/web/assets/images/product/product-thumb/thumb-09.png"
                                                    alt="thumb image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 mb--40">
                                <div class="single-product-content">
                                    <div class="inner">
                                        <div class="product-rating">
                                            <div class="star-rating">
                                                <img src="/web/assets/images/icons/rate.png" alt="Rate Images">
                                            </div>
                                            <div class="review-link">
                                                <a href="#">(<span>1</span> customer reviews)</a>
                                            </div>
                                        </div>
                                        <h3 class="product-title">Serif Coffee Table</h3>
                                        <span class="price-amount">$155.00 - $255.00</span>
                                        <ul class="product-meta">
                                            <li><i class="fal fa-check"></i>In stock</li>
                                            <li><i class="fal fa-check"></i>Free delivery available</li>
                                            <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>
                                        </ul>
                                        <p class="description">In ornare lorem ut est dapibus, ut tincidunt nisi
                                            pretium. Integer ante est, elementum eget magna. Pellentesque sagittis
                                            dictum libero, eu dignissim tellus.</p>

                                        <div class="product-variations-wrapper">

                                            <!-- Start Product Variation  -->
                                            <div class="product-variation">
                                                <h6 class="title">Colors:</h6>
                                                <div class="color-variant-wrapper">
                                                    <ul class="color-variant mt--0">
                                                        <li class="color-extra-01 active"><span><span
                                                                    class="color"></span></span>
                                                        </li>
                                                        <li class="color-extra-02"><span><span
                                                                    class="color"></span></span>
                                                        </li>
                                                        <li class="color-extra-03"><span><span
                                                                    class="color"></span></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- End Product Variation  -->

                                            <!-- Start Product Variation  -->
                                            <div class="product-variation">
                                                <h6 class="title">Size:</h6>
                                                <ul class="range-variant">
                                                    <li>xs</li>
                                                    <li>s</li>
                                                    <li>m</li>
                                                    <li>l</li>
                                                    <li>xl</li>
                                                </ul>
                                            </div>
                                            <!-- End Product Variation  -->

                                        </div>

                                        <!-- Start Product Action Wrapper  -->
                                        <div class="product-action-wrapper d-flex-center">
                                            <!-- Start Quentity Action  -->
                                            <div class="pro-qty"><input type="text" value="1"></div>
                                            <!-- End Quentity Action  -->

                                            <!-- Start Product Action  -->
                                            <ul class="product-action d-flex-center mb--0">
                                                <li class="add-to-cart"><a href="cart.html"
                                                        class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                                <li class="wishlist"><a href="wishlist.html"
                                                        class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a>
                                                </li>
                                            </ul>
                                            <!-- End Product Action  -->

                                        </div>
                                        <!-- End Product Action Wrapper  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Quick View Modal End -->

    <!-- Header Search Modal End -->
    <div class="header-search-modal" id="header-search-modal">
        <button class="card-close sidebar-close"><i class="fas fa-times"></i></button>
        <livewire:components.search />
    </div>
    <!-- Header Search Modal End -->



    <div class="cart-dropdown" id="cart-dropdown">
        <div class="cart-content-wrap">
            <div class="cart-header">
                <h2 class="header-title">Cart review</h2>
                <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
            </div>
            <div class="cart-body">
                <ul class="cart-item-list">
                    @if (Auth::user())
                        <livewire:components.cart-count />
                    @endif
                </ul>
            </div>
            <div class="cart-footer">
                <h3 class="cart-subtotal">
                    <span class="subtotal-title">Subtotal:</span>
                    <livewire:components.cart-count :display="'total'" />
                </h3>
                <div class="group-btn">
                    <a href="cart.html" class="axil-btn btn-bg-primary viewcart-btn">View Cart</a>
                    <a href="checkout.html" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts

    @stack('scripts')


  


    {{-- <script src="/personal/personal.js"></script> --}}

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('cartUpdated', () => {
                // Emit an event to refresh the cart count
                Livewire.emit('cartUpdated');
            });
        });
    </script>


    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="/web/assets/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="/web/assets/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="/web/assets/js/vendor/popper.min.js"></script>
    <script src="/web/assets/js/vendor/bootstrap.min.js"></script>
    <script src="/web/assets/js/vendor/slick.min.js"></script>
    <script src="/web/assets/js/vendor/js.cookie.js"></script>
    <!-- <script src="/web/assets/js/vendor/jquery.style.switcher.js"></script> -->
    <script src="/web/assets/js/vendor/jquery-ui.min.js"></script>
    <script src="/web/assets/js/vendor/jquery.ui.touch-punch.min.js"></script>
    <script src="/web/assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="/web/assets/js/vendor/sal.js"></script>
    <script src="/web/assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="/web/assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="/web/assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="/web/assets/js/vendor/counterup.js"></script>
    <script src="/web/assets/js/vendor/waypoints.min.js"></script>

    <!-- Main JS -->
    <script src="/web/assets/js/main.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




</body>

</html>
