<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eTrade || Sign Up</title>
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/css/intlTelInput.css">

    {{-- <style>
        input {
            width: 250px;
            padding: 10px;
            border-radius: 2px;
            border: 1px solid #ccc;
        }

        input::placeholder {
            color: #BBB;
        }
    </style> --}}

</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="index.html" class="site-logo"><img src="./assets/images/logo/logo.png" alt="logo"></a>
                </div>
                <div class="col-md-6">
                    <div class="singin-header-btn">
                        <p>Already a member?</p>
                        <a href="{{ route('login') }}" class="axil-btn btn-bg-secondary sign-up-btn">Sign In</a>
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
                        <h3 class="title">I'm New Here</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        @if (session('error'))
                            <div class="alert alert-danger mb-4" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('register') }}" class="singin-form" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    placeholder="Full Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="name@example.com">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <input type="tel" id="phone" class="form-control tel-input" name="phone" required>
                                <input type="hidden" id="full_phone" name="full_phone"> 
                                <div class="invalid-feedback"></div>
                              </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">Create
                                    Account</button>
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

    <!-- intlTelInput JS -->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/intlTelInput.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
          var input = document.querySelector("#phone");
          var hiddenInput = document.querySelector("#full_phone"); // Select the hidden input
        
          // Initialize intlTelInput
          var iti = window.intlTelInput(input, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/utils.js",
            separateDialCode: true,
          });
        
          // Store the instance globally to access it from the console if needed
          window.iti = iti;
        
          // Listen for form submission to update the hidden input
          $('form').on('submit', function() {
            // Get the full phone number (country code + user's input)
            var fullPhoneNumber = iti.getNumber();
            
            // Set the value of the hidden input to the full phone number
            hiddenInput.value = fullPhoneNumber;
          });
        });
        </script>
        
        

</body>

</html>
