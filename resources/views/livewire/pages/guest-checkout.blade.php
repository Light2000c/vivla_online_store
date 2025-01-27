
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

                        <div class="address-info mb--40 border">

                            <div class="form-group p-3 mt-3">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input wire:model="name" type="text" class="form-control"
                                                    placeholder="Full Name">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input wire:model="email" type="email" class="form-control"
                                                    placeholder="name@example.com">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div wire:ignore class="form-group" style="z-index: 1;">
                                                <label>Phone</label>
                                                <input wire:model="phone"  type="tel" id="phone"
                                                    class="form-control tel-input" name="phone" required>
                                                {{-- <input wire:model="phone" type="hidden" id="full_phone"
                                                    name="full_phone"> --}}
                                                <div class="invalid-feedback"></div>
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group" style="z-index: 0;">
                                                <label>Street Address (Optional)</label>
                                                <input wire:model="street" type="text" class="form-control">
                                                @error('street')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group" style="z-index: 0;">
                                                <label>City (Optional)</label>
                                                <input wire:model="city" type="text" class="form-control">
                                                @error('city')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb--40" style="z-index: 0;">
                                                <label>Country/ Region (Optional)</label>
                                                <select wire:model="country" class="select2">
                                                    <option value="">Select a country</option>
                                                    @foreach ($countries as $code => $name)
                                                        <option value="{{ $name }}">{{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('country')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                            </div>
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
                                        <th>price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($carts->count())
                                        @foreach ($carts as $cart)
                                            <tr class="order-product">
                                                <td class="checkout-text">{{ $this->getProductName($cart->id) }}<span
                                                        class="quantity">
                                                        {{ 'x  ' . $cart->quantity }}</span></td>
                                                <td class="checkout-text">$
                                                    {{ number_format($this->getProductPrice($cart->id, $cart->quantity), 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <div class="alert alert-secondary" role="alert">
                                            you have no product ready for order! <a href="{{ route('products') }}"
                                                class="ms-3 text-primary">Go to Shop >></a>
                                        </div>
                                    @endif

                               

                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <tr class="order-total checkout-item">
                                        <td>Subtotal</td>
                                        <td>${{ number_format($subTotal, 2) }}</td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Tax</td>
                                        <td class="order-total-amount">
                                            ${{ number_format($this->getTax($subTotal), 2) }}</td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Shipping Fee</td>
                                        <td class="order-total-amount">
                                            ${{ $carts->count() ? number_format($shipping->price, 2) : 0 }}</td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Total</td>
                                        <td class="order-total-amount">
                                            ${{ number_format($subTotal + ($carts->count() ? $shipping->price : 0) + $this->getTax($subTotal), 2) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="order-payment-method">
                            <div class="single-payment">
                                <div class="input-group justify-content-between align-items-start text-white">
                                    <p>Checkout with your stripe credit card or paypal for seamless experience</p>
                                </div>
                            </div>

                        </div>
                        <form id="payment-form" action="{{ route('guest-pay') }}" method="POST">
                            @csrf

                            @if (session(session('error')))
                                <p>{{ session('error') }}</p>
                            @endif

                            <input type="hidden" name="amount" value="{{ $subTotal }}" required>

                           
                            {{-- <button type="submit" class="axil-btn btn-bg-primary checkout-btn mb-3">Checkout with Stripe</button> --}}
                        </form>
                        <button wire:click="payWithCard" wire:target="pay"
                            class="axil-btn btn-bg-primary checkout-btn mb-3">Pay with
                            Card</button>

                        <form id="paypal-payment-form" action="{{ route('payWithPaypal') }}" method="POST">
                            @csrf

                            @if (session(session('error')))
                                <p>{{ session('error') }}</p>
                            @endif

                            <input type="hidden" name="amount" value="{{ $subTotal }}" required>
                        </form>
                        <button wire:click="payWithPaypal" class="axil-btn btn-bg-primary checkout-btn mb-3">Pay
                            with
                            Paypal</button>
                        {{-- <a href="{{ $whatsAppUrl }}" class="axil-btn btn-bg-primary checkout-btn">Checkout on
                            WhatsApp</a> --}}
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



        window.addEventListener("alert", function(e) {

            let data = e.detail;

            console.log(data);

            Swal.fire({
                title: data.title,
                text: data.text,
                icon: data.icon,
                showCancelButton: true,
                confirmButtonText: 'Go To Cart',
                cancelButtonText: 'Close'
            }).then((result) => {
                if (result.isConfirmed) {
                    //  Redirect to the URL
                    window.location.href = data.redirectUrl;
                }
            });

        });

        window.addEventListener('submit-payment-form', function() {
            document.getElementById('payment-form').submit();
        });

        window.addEventListener('submit-paypal-payment-form', function() {
            document.getElementById('paypal-payment-form').submit();
        });
    </script>


    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let iti;

                window.addEventListener('initializePhoneInputs', function(event) {
                    const updateInput = document.querySelector("#updatePhone");
                    const input = document.querySelector("#phone");
                    const hiddenUpdateInput = document.querySelector("#full_update_phone");

                    if (iti) {
                        iti.destroy();
                    }

                    if (event.detail[0].address) {
                        console.log("Entered here second 2");
                        console.log("Event address ==> ", event.detail[0].address);
                        if (updateInput) {
                            iti = window.intlTelInput(updateInput, {
                                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/utils.js",
                                separateDialCode: true,
                            });
                            iti.setNumber(event.detail[0].phone);

                            document.querySelector('#updateForm').onsubmit = function() {
                                const fullPhoneNumber = iti.getNumber();
                                hiddenUpdateInput.value = fullPhoneNumber;
                                @this.set('updatePhone', fullPhoneNumber);
                            };
                        } else {}
                    } else {
                        console.log("Entered here first 1");
                        if (input) {
                            iti = window.intlTelInput(input, {
                                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/utils.js",
                                separateDialCode: true,
                            });

                            document.querySelector('#createForm').onsubmit = function() {
                                const fullPhoneNumber = iti.getNumber();
                                @this.set('phone', fullPhoneNumber);
                            };
                        } else {
                            console.error("Phone input not found!");
                        }
                    }
                });

                Livewire.on('inputUpdated', () => {
                    if (document.querySelector("#updatePhone")) {
                        iti = window.intlTelInput(document.querySelector("#updatePhone"), {
                            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/utils.js",
                            separateDialCode: true,
                        });
                    }
                    if (document.querySelector("#phone")) {
                        iti = window.intlTelInput(document.querySelector("#phone"), {
                            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/utils.js",
                            separateDialCode: true,
                        });
                    }
                });
            });
        </script>
    @endpush
    @stack('scripts')


</main>
