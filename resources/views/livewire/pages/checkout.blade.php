<main class="main-wrapper">

    <!-- Start Checkout Area  -->
    <div class="axil-checkout-area axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-4">
                        <h4>Almost There!</h4>
                        <p>
                            You're just a few steps away from completing your purchase. Please review your order
                            details below, and choose your preferred payment method.
                        </p>
                    </div>

                    <div class="mb-4">
                        <h4 class="title mb--40">Billing details</h4>
                    </div>

                    <div>
                        <div class="mb-3">
                            <p>
                                If you need to change or edit your billing address, please visit your profile
                                settings. You can do this by going to your <a href=""
                                    class="text-primary"><b>Profile</b></a> and updating your address
                                information there.
                            </p>
                        </div>
                        <div class="address-info mb--40 border">
                            <div class="addrss-header d-flex align-items-center justify-content-between m-3">
                            </div>
                            <ul class="address-details m-3" style="list-style-type: none;">
                                <li>Name: {{ "$address->firstname $address->lastname" }}</li>
                                <li>Email: {{ $address->email }}</li>
                                <li>Phone: {{ $address->phone }}</li>
                                <li class="mt--30">Street/City: {{ $address->street }}</li>
                                <li>city: {{ $address->city }}</li>
                                <li>country: {{ $address->country }}</li>
                            </ul>
                        </div>
                    </div>


                </div>
                <div class="col-lg-6">
                    <div class="axil-order-summery order-checkout-summery">
                        <h5 class="title mb--20">Your Order</h5>
                        <div class="summery-table-wrap">
                            <table class="table summery-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($carts->count())
                                        @foreach ($carts as $cart)
                                            <tr class="order-product">
                                                <td>{{ $cart->product->name }}<span class="quantity">
                                                        {{ 'x  ' . $cart->quantity }}</span></td>
                                                <td>$
                                                    @if ($cart->product->discount)
                                                        {{ number_format($cart->quantity * ($cart->product->price - ($cart->product->price * $cart->product->discount) / 100)) }}
                                                    @else
                                                        {{ number_format($cart->quantity * $cart->product->price) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <div class="alert alert-secondary" role="alert">
                                            you have not product ready for order! <a href="{{ route('products') }}"
                                                class="ms-3 text-primary">Go to Shop >></a>
                                        </div>
                                    @endif
                                    <tr class="order-subtotal">
                                        <td>Subtotal</td>
                                        <td>${{ number_format($subTotal) }}</td>
                                    </tr>
                                    <tr class="order-shipping">
                                        <td colspan="2">
                                            <div class="shipping-amount">
                                                <span class="title">Shipping Method</span>
                                                <span class="amount">$35.00</span>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio1" name="shipping" checked>
                                                <label for="radio1">Free Shippping</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio2" name="shipping">
                                                <label for="radio2">Local</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio3" name="shipping">
                                                <label for="radio3">Flat rate</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Total</td>
                                        <td class="order-total-amount">${{ number_format($subTotal) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="order-payment-method">
                            {{-- <div class="single-payment">
                                    <div class="input-group">
                                        <input type="radio" id="radio4" name="payment">
                                        <label for="radio4">Direct bank transfer</label>
                                    </div>
                                    <p>Make your payment directly into our bank account. Please use your Order ID as the
                                        payment reference. Your order will not be shipped until the funds have cleared
                                        in our account.</p>
                                </div> --}}
                            <div class="single-payment">
                                <div class="input-group justify-content-between align-items-center">
                                    {{-- <input type="radio" id="radio6" name="payment" checked> --}}
                                    <label for="radio6">Stripe</label>
                                    <p>Pay via stripe: you can pay with your credit card.</p>
                                </div>
                            </div>

                        </div>
                        <form action="{{ route('pay') }}" method="POST">
                            @csrf

                            @if(session(session("error")))
                            <p>{{ session("error") }}</p>
                            @endif

                            {{-- <label for="fullName">Full Name:</label> --}}
                            <input type="hidden" name="fullName" value="{{ Auth::user()->name }}" required>
                            @error('fullName')
                                <small>{{ $message }}</small>
                            @enderror

                            {{-- <label for="amount">Amount:</label> --}}
                            <input type="hidden" name="amount" value="{{ $subTotal }}" required>
                            @error('amount')
                                <small>{{ $message }}</small>
                            @enderror
                            <button type="submit" class="axil-btn btn-bg-primary checkout-btn">Process to
                                Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Checkout Area  -->

    <script>
        window.addEventListener('message', function(e) {

            let data = e.detail;

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: data.icon,
                title: data.title
            });

        });
    </script>

</main>
