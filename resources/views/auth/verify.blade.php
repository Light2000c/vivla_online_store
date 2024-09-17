{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection --}}


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Vivla Closet | Onlin Store</title>
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

</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-xl-4 col-sm-6">
                    <a href="index.html" class="site-logo"><img src="./assets/images/logo/logo.png" alt="logo"></a>
                </div>
                <div class="col-md-2 d-lg-block d-none">
                    <a href="sign-in.html" class="back-btn"><i class="far fa-angle-left"></i></a>
                </div>
                <div class="col-xl-6 col-lg-4 col-sm-6">
                    <div class="singin-header-btn">
                        <a href="{{ route("home") }}" class="sign-up-btn axil-btn btn-bg-secondary">Home</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                    <h3 class="title">We Offer the Best Products</h3>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">

                        <div class="card">
                            {{-- <h3 class="title ">{{ __('Verify Your Email Address') }}</h3> --}}
                            <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                            <div class="card-body p-2 m-4">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <div class="d-flex justify-content-center mb-3">
                                    <button type="submit"
                                        class="axil-btn btn-bg-primary submit-btn btn-sm mt-5">{{ __('click here to request another') }}</button>
                                    </div>
                                    {{-- <button type="submit" class="btn btn-outline p-0 m-0 align-baseline">{{ __('click here to request another') }}</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

</body>

</html>
