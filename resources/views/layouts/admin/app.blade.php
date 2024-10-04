<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Dunzo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Dunzo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    {{-- Ck editor script --}}
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>



    <title>Vivla Closet | Online Store</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Outfit:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/vector-map.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/style.css">
    <link id="color" rel="stylesheet" href="/web1/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/web1/assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @livewireStyles

    @stack('scripts')
</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper"><a href="{{ route("home") }}">
                            <img class="img-fluid for-light" src="/web1/assets/images/logo/logo-1.png" alt="">
                            <img class="img-fluid for-dark" src="/web1/assets/images/logo/logo.png" alt=""></a>
                    </div>
                    <div class="toggle-sidebar">
                        <svg class="sidebar-toggle">
                            <use href="/web1/assets/svg/icon-sprite.svg#stroke-animation"></use>
                        </svg>
                    </div>
                </div>
                <div class="left-header col-xxl-5 col-xl-6 col-auto box-col-6 horizontal-wrapper p-0">
                    <div class="left-menu-header">
                        <ul class="app-list">
                            <li class="onhover-dropdown">
                                <div class="app-menu"> <i data-feather="folder-plus"></i></div>
                                <ul class="onhover-show-div left-dropdown">
                                    <li> <a href="file-manager.html">File Manager</a></li>
                                    <li> <a href="kanban.html"> Kanban board</a></li>
                                    <li> <a href="social-app.html"> Social App</a></li>
                                    <li> <a href="bookmark.html"> Bookmark</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nav-right col-xxl-7 col-xl-6 col-auto box-col-6 pull-right right-header p-0 ms-auto">
                    <ul class="nav-menus">
                        <li class="serchinput">
                            <div class="serchbox">
                                <svg>
                                    <use href="/web1/assets/svg/icon-sprite.svg#fill-search"></use>
                                </svg>
                            </div>
                            <div class="form-group search-form">
                                <input type="text" placeholder="Search here...">
                            </div>
                        </li>
                        <li>
                            <div class="form-group w-100">
                                {{--   <div class="Typeahead Typeahead--twitterUsers">
                                    <div class="u-posRelative d-flex">
                                        <svg class="search-bg svg-color me-2">
                                            <use href="/web1/assets/svg/icon-sprite.svg#fill-search"></use>
                                        </svg>
                                        <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100"
                                            type="text" placeholder="Search Dunzo .." name="q"
                                            title="">
                                    </div> 
                                </div> --}}
                            </div>
                        </li>
                        <li class="profile-nav onhover-dropdown p-2">
                            <div class="d-flex align-items-center profile-media">
                                {{-- <img class="b-r-10 img-40" src="/web1/assets/images/dashboard/profile.png"
                                    alt=""> --}}
                                <div class="flex-grow-1"><span>{{ Auth::user()->name }}</span>
                                    <p class="mb-0">Admin <i class="middle fa fa-angle-down"></i></p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="{{ route("edit-account") }}"><i data-feather="user"></i><span>Account </span></a>
                                </li>
                                {{-- <li><a href=""><i data-feather="settings"></i><span>Settings</span></a></li> --}}
                                <li>
                                    <form  action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link btn-sm"><i data-feather="log-in"> </i><span>Logout</span></button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">name</div>
            </div>
            </div>
          </script>
                <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper" data-layout="fill-svg">
                <div>
                    <div class="logo-wrapper">
                        <a href="index.html"><img class="img-fluid"
                                src="/logo/VIVLA MAIN LOGO WEBT2.png"  alt="" width="40" height="157"></a>
                        {{-- <a href="index.html"><img class="img-fluid"
                                src="/web1/assets/images/logo/logo.png" alt=""></a> --}}
                        <div class="toggle-sidebar">
                            <svg class="sidebar-toggle">
                                <use href="/web1/assets/svg/icon-sprite.svg#toggle-icon"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid"
                                src="/web1/assets/images/logo/logo-icon.png" alt=""></a></div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="lan-1">General</h6>
                                    </div>
                                </li>

                                <li class="pin-title sidebar-main-title">
                                    <div>
                                        <h6>Pinned</h6>
                                    </div>
                                </li>
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="lan-1">General</h6>
                                    </div>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin-dashboard') }}">
                                        <span><i class="bi bi-speedometer2 me-2" style="font-size: 16px"></i>
                                            Dashboard</span></a>
                                </li>

                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="">Product</h6>
                                    </div>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('add-product') }}"><span>
                                            <i class="bi bi-bag-plus me-2" style="font-size: 16px"></i> Add
                                            Product</span></a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin-product') }}"><span>
                                            <i class="bi bi-handbag me-2"
                                                style="font-size: 16px"></i>Products</span></a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin-categories') }}"><span>
                                            <i class="bi bi-ui-checks me-2"
                                                style="font-size: 16px"></i>Categories</span></a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin-cart') }}"><span>
                                            <i class="bi bi-cart4 me-2" style="font-size: 16px"></i>Carts</span></a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin-wishlist') }}"><span>
                                            <i class="bi bi-heart me-2"
                                                style="font-size: 16px"></i>Wishlists</span></a>
                                </li>
                                {{-- <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin-order') }}"><span>Orders</span></a>
                                </li> --}}

                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="">Other</h6>
                                    </div>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin-transaction') }}"><span>
                                            <i class="bi bi-arrows-angle-contract me-2"
                                                style="font-size: 16px"></i>Transaction</span></a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href=""><span><i
                                                class="bi bi-credit-card-2-back me-2"
                                                style="font-size: 16px"></i>Payment</span></a>
                                </li>

                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="">User</h6>
                                    </div>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin-address') }}"><span>
                                            <i class="bi bi-person-lines-fill me-2"
                                                style="font-size: 16px"></i>Address</span></a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('users') }}"><span>
                                            <i class="bi bi-person-gear me-2"
                                                style="font-size: 16px"></i>Users</span></a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('team-member') }}"><span>
                                            <i class="bi bi-people me-2" style="font-size: 16px"></i>Team
                                            Members</span></a>
                                </li>




                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->

            {{ $slot }}

            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 p-0 footer-copyright">
                            <p class="mb-0">Copyright 2023 © Dunzo theme by pixelstrap.</p>
                        </div>
                        <div class="col-md-6 p-0">
                            <p class="heart mb-0">Hand crafted &amp; made with
                                <svg class="footer-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#heart"></use>
                                </svg>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @livewireScripts

    @stack('scripts')

    <!-- latest jquery-->
    <script src="/web1/assets/js/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="/web1/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="/web1/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/web1/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="/web1/assets/js/scrollbar/simplebar.js"></script>
    <script src="/web1/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="/web1/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="/web1/assets/js/sidebar-menu.js"></script>
    <script src="/web1/assets/js/sidebar-pin.js"></script>
    <script src="/web1/assets/js/slick/slick.min.js"></script>
    <script src="/web1/assets/js/slick/slick.js"></script>
    <script src="/web1/assets/js/header-slick.js"></script>
    <script src="/web1/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="/web1/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="/web1/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="/web1/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="/web1/assets/js/counter/counter-custom.js"></script>
    <script src="/web1/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/web1/assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/web1/assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js"></script>
    <script src="/web1/assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js"></script>
    <script src="/web1/assets/js/vector-map/map/jquery-jvectormap-au-mill.js"></script>
    <script src="/web1/assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js"></script>
    <script src="/web1/assets/js/vector-map/map/jquery-jvectormap-in-mill.js"></script>
    <script src="/web1/assets/js/vector-map/map/jquery-jvectormap-asia-mill.js"></script>
    <script src="/web1/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/web1/assets/js/datatable/datatables/datatable.custom.js"></script>
    <script src="/web1/assets/js/datatable/datatables/datatable.custom1.js"></script>
    <script src="/web1/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="/web1/assets/js/owlcarousel/owl-custom.js"></script>
    <script src="/web1/assets/js/vector-map/map-vector.js"></script>
    <script src="/web1/assets/js/dashboard/dashboard_2.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/web1/assets/js/script.js"></script>
    {{-- <script src="/web1/assets/js/theme-customizer/customizer.js"></script> --}}
    <!-- Plugin used-->


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        CKEDITOR.replace('editor', {
            versionCheck: false
        });
    </script>







</body>

</html>
