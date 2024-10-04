<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Vivla Closet | Online Store</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./web/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="./web/assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="./web/assets/css/vendor/flaticon/flaticon.css">
    <link rel="stylesheet" href="./web/assets/css/vendor/slick.css">
    <link rel="stylesheet" href="./web/assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="./web/assets/css/vendor/jquery-ui.min.css">
    <link rel="stylesheet" href="./web/assets/css/vendor/sal.css">
    <link rel="stylesheet" href="./web/assets/css/vendor/magnific-popup.css">
    <link rel="stylesheet" href="./web/assets/css/vendor/base.css">
    <link rel="stylesheet" href="./web/assets/css/style.min.css">

        <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/66f7ec7ee5982d6c7bb6005b/1i8s77jop';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-xl-4 col-sm-6">
                    <a href="{{  route("home") }}" class="site-logo"><img src="/logo/VIVLA MAIN LOGO WEBT2.png" alt="logo" width="40" height="157"></a>
                </div>
                <div class="col-md-2 d-lg-block d-none">
                    <a href="{{ route("login") }}" class="back-btn"><i class="far fa-angle-left"></i></a>
                </div>
                <div class="col-xl-6 col-lg-4 col-sm-6">
                    <div class="singin-header-btn">
                        <p>Already a member?</p>
                        <a href="{{ route("login") }}" class="sign-up-btn axil-btn btn-bg-secondary">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                    {{-- <h3 class="title">We Offer the Best Products</h3> --}}
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Forgot Password?</h3>
                        <p class="b2 mb--55">Enter the email address you used when you joined and we’ll send you
                            instructions to reset your password.</p>
                        <form  action="{{ route('password.email') }}"  method="POST">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success mb-3" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="name@example.com">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">
                                    {{ __('Send Password Reset Link') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="./web/assets/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="./web/assets/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="./web/assets/js/vendor/popper.min.js"></script>
    <script src="./web/assets/js/vendor/bootstrap.min.js"></script>
    <script src="./web/assets/js/vendor/slick.min.js"></script>
    <script src="./web/assets/js/vendor/js.cookie.js"></script>
    <!-- <script src="./web/assets/js/vendor/jquery.style.switcher.js"></script> -->
    <script src="./web/assets/js/vendor/jquery-ui.min.js"></script>
    <script src="./web/assets/js/vendor/jquery.ui.touch-punch.min.js"></script>
    <script src="./web/assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="./web/assets/js/vendor/sal.js"></script>
    <script src="./web/assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="./web/assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="./web/assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="./web/assets/js/vendor/counterup.js"></script>
    <script src="./web/assets/js/vendor/waypoints.min.js"></script>

    <!-- Main JS -->
    <script src="./web/assets/js/main.js"></script>

</body>

</html>
