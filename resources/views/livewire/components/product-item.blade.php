<div class="axil-product product-style-one mb--30 border p-3">
        <div class="thumbnail">
            <a>
                <img src="/products/{{ $product->image }}" alt="Product Images">
            </a>
            @if ($product->discount)
                <div class="label-block label-right">
                    <div class="product-badget">{{ $product->discount }}% OFF</div>
                </div>
            @endif
            <div class="product-hover-action">

                @if (!Auth::user())
                    <ul class="cart-action">
                        <li class="wishlist"><a href="wishlist.html"><i
                                    class="far fa-heart"></i></a></li>
                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                        <li class="quickview"><a href="{{ route("product-detail", $product->id) }}" data-bs-toggle="modal"
                                data-bs-target="#quick-view-modal"><i
                                    class="far fa-eye"></i></a>
                        </li>
                    </ul>
                @else
                    <ul class="cart-action">
                        <li class="wishlist">
                            @if ($product->hasWish(Auth::user()))
                                <a wire:click="removeFromWishlist({{ $product->id }})"
                                    class="btn">
                                    <i wire:loading.remove
                                        wire:target="removeFromWishlist({{ $product->id }})"
                                        class="far fa-heart text-danger"></i>
                                    <span wire:loading
                                        wire:target="removeFromWishlist({{ $product->id }})"
                                        class="spinner-border spinner-border-sm"
                                        aria-hidden="true"></span>
                                </a>
                            @else
                                <a wire:click="addToWishlist({{ $product->id }})"
                                    class="btn">
                                    <i wire:loading.remove
                                        wire:target="addToWishlist({{ $product->id }})"
                                        class="far fa-heart"></i>
                                    <span wire:loading
                                        wire:target="addToWishlist({{ $product->id }})"
                                        class="spinner-border spinner-border-sm"
                                        aria-hidden="true"></span>
                                </a>
                            @endif
                        </li>
                        {{-- <li class="wishlist"><a href="wishlist.html"><i
                                    class="far fa-heart"></i></a></li> --}}
                        <li class="select-option">
                            @if ($product->hasCart(Auth::user()))
                                <a class="btn"
                                    wire:click="removeFromCart({{ $product->id }})">
                                    <span wire:loading.remove
                                        wire:target="removeFromCart({{ $product->id }})">Remove
                                        from Cart</span>
                                    <span wire:loading
                                        wire:target="removeFromCart({{ $product->id }})"
                                        class="spinner-border spinner-border-sm"
                                        aria-hidden="true"></span>
                                </a>
                            @else
                                <a class="btn"
                                    wire:click="addToCart({{ $product->id }})">
                                    <span wire:loading.remove
                                        wire:target="addToCart({{ $product->id }})">Add
                                        to
                                        Cart</span>
                                    <span wire:loading
                                        wire:target="addToCart({{ $product->id }})"
                                        class="spinner-border spinner-border-sm"
                                        aria-hidden="true"></span>
                                </a>
                            @endif
                        </li>
                        <li class="quickview"><a href="{{ route("product-detail", $product->id) }}" ><i
                                    class="far fa-eye"></i></a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
        <div class="product-content">
            @if ($product->discount)
                <div class="inner">
                    <h5 class="title"><a
                            href="{{ route("product-detail", $product->id) }}">{{ $product->name }}</a>
                    </h5>
                    <div class="product-price-variant">
                        <span
                            class="price current-price">${{ number_format($product->price - ($product->price * $product->discount) / 100) }}</span>
                        <span
                            class="price old-price">${{ number_format($product->price) }}</span>
                    </div>
                </div>
            @else
                <div class="inner">
                    <h5 class="title"><a
                            href="{{ route("product-detail", $product->id) }}">{{ $product->name }}</a>
                    </h5>
                    <div class="product-price-variant">
                        <span
                            class="price current-price">${{ number_format($product->price) }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

