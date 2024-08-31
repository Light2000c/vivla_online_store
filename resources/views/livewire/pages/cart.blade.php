<main class="main-wrapper">

    <!-- Start Cart Area  -->
    <div class="axil-product-cart-area axil-section-gap">
        <div class="container">
            <div class="axil-product-cart-wrap">
                <div class="product-table-heading">
                    <h4 class="title">Your Cart</h4>
                    <a href="#" class="cart-clear">Clear Shoping Cart</a>
                </div>
                <div class="table-responsive">
                    <table class="table axil-product-table axil-cart-table mb--40">
                        <thead>
                            <tr>
                                <th scope="col" class="product-remove"></th>
                                <th scope="col" class="product-thumbnail">Product</th>
                                <th scope="col" class="product-title"></th>
                                <th scope="col" class="product-price">Price</th>
                                <th scope="col" class="product-quantity">Quantity</th>
                                <th scope="col" class="product-subtotal">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Auth::user())
                                @foreach ($carts as $index => $cart)
                                    <tr>
                                        <td class="product-remove">
                                            <a wire:click="delete({{ $cart->id }})" class="remove-wishlist">
                                                <i wire:loading.remove wire:target="delete({{ $cart->id }})"
                                                    class="fal fa-times"></i>
                                                <span wire:loading wire:target="delete({{ $cart->id }})"
                                                    class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td class="product-thumbnail"><a href="single-product.html"><img
                                                    src="/storage/products/{{ $cart->product->image }}"
                                                    alt="Digital Product"></a></td>
                                        <td class="product-title"><a
                                                href="single-product.html">{{ $cart->product->name }}</a></td>
                                        <td class="product-price" data-title="Price"><span
                                                class="currency-symbol">$</span>
                                            @if ($cart->product->discount)
                                                {{ number_format($cart->product->price - ($cart->product->price * $cart->product->discount) / 100) }}
                                            @else
                                                {{ number_format($cart->product->price) }}
                                            @endif
                                        </td>
                                        <td class="product-quantity" data-title="Qty">
                                            <div class="pro-qty">
                                                <span wire:click="dec({{ $cart->id }})" class="dec qtybtn">
                                                    <span wire:loading.remove
                                                        wire:target="dec({{ $cart->id }})">-</span>
                                                    <span wire:loading wire:target="dec({{ $cart->id }})"
                                                        class="spinner-grow spinner-grow" role="status"
                                                        aria-hidden="true"></span>
                                                </span>
                                                <input wire:change="update({{ $cart->id }}, $event.target.value)"
                                                    type="number" class="quantity-input"
                                                    value="{{ $cart->quantity }}">
                                                <span wire:click="inc({{ $cart->id }})" class="inc qtybtn">
                                                    <span wire:loading.remove
                                                        wire:target="inc({{ $cart->id }})">+</span>
                                                    <span wire:loading wire:target="inc({{ $cart->id }})"
                                                        class="spinner-grow spinner-grow" role="status"
                                                        aria-hidden="true"></span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="product-subtotal" data-title="Subtotal"><span
                                                class="currency-symbol">$</span>
                                            @if ($cart->product->discount)
                                                {{ number_format($cart->quantity * $cart->product->price - ($cart->product->price * $cart->product->discount) / 100) }}
                                            @else
                                                {{ number_format($cart->quantity * $cart->product->price) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
 
                <div class="row">
                    <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                        <div class="axil-order-summery mt--80">
                            <h5 class="title mb--20">Order Summary</h5>
                            <div class="summery-table-wrap">
                                <table class="table summery-table mb--30">
                                    <tbody>
                                        <tr class="order-subtotal">
                                            <td>Subtotal</td>
                                            <td>${{ number_format($subTotal) }}</td>
                                        </tr>
                                        <tr class="order-shipping">
                                            <td>Shipping</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="radio" id="radio1" name="shipping" checked>
                                                    <label for="radio1">Free Shippping</label>
                                                </div>
                                                <div class="input-group">
                                                    <input type="radio" id="radio2" name="shipping">
                                                    <label for="radio2">Local: $35.00</label>
                                                </div>
                                                <div class="input-group">
                                                    <input type="radio" id="radio3" name="shipping">
                                                    <label for="radio3">Flat rate: $12.00</label>
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
                            <a href="checkout.html" class="axil-btn btn-bg-primary checkout-btn">Process to
                                Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart Area  -->


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
