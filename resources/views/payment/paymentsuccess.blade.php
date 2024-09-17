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

</head>


<body>
    <div class="container">
      <div class="row mb-5 mt-5">
        <div class="col mt-5">
            <div style="text-align: center;">
                <h3>🎉 Payment Successful!</h3>
                <p>Thank you for your purchase! Your order has been successfully processed.</p>
            
                <div style="margin: 20px 0;">
                    <p><strong>Amount Paid:</strong> ${{ number_format($session->amount_total / 100) }}</p>
                    <p><strong>Order Number:</strong> {{ $reference }}</p>
                </div>
            
                <div>
                    <a href="{{ route("home") }}" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Go to Home</a>
                    <a href="{{ route("order", $reference) }}" style="padding: 10px 20px; background-color: #008CBA; color: white; text-decoration: none; border-radius: 5px; margin-left: 10px;">View Order</a>
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
