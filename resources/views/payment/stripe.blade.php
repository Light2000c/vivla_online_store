<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eTrade || Sign In</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>


<body>

    <!-- Start main-content -->
    <div class="main-content">

        <section>

            <div class="container mt-30 mb-30 pt-30 pb-30">

                <div class="row"
                    style="display: flex; justify-content: center; margin-top: 30px; margin-bottom: 30px;">
                    <div class=" col-md-6">

                        <div style="margin-bottom: 20px;">
                            <div
                                style="text-align: center; background-color: #7C9C47; padding-top: 8px; padding-bottom: 3px;">
                                <p
                                    style="color: whitesmoke; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: bold;">
                                    <i class="fa fa-credit-card"></i> Credit Card
                                </p>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible show" role="alert"
                                    style="margin-top: 5px; margin-bottom: 5px;">
                                    <strong>Error! </strong> {{ session('error') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div style="margin-top: 10px;">
                                <p>
                                    Please enter your card details to complete your payment. Your information is
                                    securely processed by Stripe, and we do not store your card details. All
                                    transactions are encrypted for your safety.
                                </p>
                                <li
                                    style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 18px;">
                                    <b>Customer Name: </b> {{ Auth::user()->name }}
                                </li>
                                <li
                                    style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 18px;">
                                    <b>Item Count: </b> {{ $itemCount }}
                                </li>
                                <li
                                    style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 18px;">
                                    <b>Sub Total: </b> ${{ $amount }}
                                </li>
                                <li
                                    style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 18px;">
                                    <b>Total Amount: </b> ${{ $amount }}
                                </li>
                            </div>
                            <hr>
                        </div>
                        <form action="/pay-checkout" method="post">
                            {{-- @csrf --}}
                            {{-- <input type="hidden" name="token"> --}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="amount" value="{{ $amount }}00">
                            <div class="form-group">
                                <label for="username">Full name (on the card)</label>
                                <input type="text" class="form-control" name="fullName" placeholder="Full Name">
                                @error('fullName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cardNumber">Card number</label>
                                <input type="text" class="form-control" name="cardNumber" placeholder="Card Number">
                                <div class="">
                                    <span class="input-group-text text-muted">
                                        <i class="fa fa-cc-visa fa-lg m-2"></i>
                                        <i class="fa fa-cc-amex fa-lg m-2"></i>
                                        <i class="fa fa-cc-mastercard fa-lg m-2"></i>
                                    </span>
                                </div>
                                @error('cardNumber')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label><span class="hidden-xs">Expiration</span> </label>
                                        <div class="input-group" style="display:flex;">
                                            <select class="form-control" name="month">
                                                <option value="">MM</option>
                                                @foreach (range(1, 12) as $month)
                                                    <option value="{{ $month }}">{{ $month }}</option>
                                                @endforeach
                                            </select>
                                            <select class="form-control" name="year">
                                                <option value="">YYYY</option>
                                                @foreach (range(date('Y'), date('Y') + 10) as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- @error('fullname')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title=""
                                            data-original-title="3 digits code on back side of the card">CVV <i
                                                class="fa fa-question-circle"></i></label>
                                        <input type="number" class="form-control" placeholder="CVV" name="cvv">
                                        @error('cvv')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button class="btn btn-expand btn-large" id="confirm-btn"
                                    style="background-color: #7C9C47; color: whitesmoke; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: bold;"
                                    type="submit" disabled>
                                    PROCEED</button>
                            </div>

                            <script type="text/javascript">
                                var submitButton = document.getElementById('confirm-btn');

                                window.onload = function() {
                                    submitButton.disabled = false;
                                }

                                document.getElementById('confirm-btn').onclick = function() {

                                    setTimeout(function() {
                                        submitButton.disabled = true;
                                    }, 1000);
                                }
                            </script>

                        </form>
                    </div>
                </div>

            </div>
        </section>
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
