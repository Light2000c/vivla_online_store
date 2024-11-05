<div>
    {{-- <div class="axil-product product-style-one mb--30 border p-3">
        <div class="thumbnail"> --}}
    <div class="axil-product  product-style-one mb--30">
        <div class="thumbnail border p-3">
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
                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                        <li class="quickview"><a href="{{ route('product-detail', $product->id) }}"
                                data-bs-toggle="modal" data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a>
                        </li>
                    </ul>
                @else
                    <ul class="cart-action">
                        {{-- <li class="wishlist">
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
                        </li> --}}
                        <li class="select-option">
                            <a class="btn" wire:click="openQuickView({{ $product->id }})">
                                <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
                                    <i class="bi bi-handbag-fill me-2"></i>Quick View</span>
                                <span wire:loading wire:target="addToCart({{ $product->id }})"
                                    class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
        <div class="product-content">
            @if ($product->discount)
                <div class="inner">
                    <h5 class="title"><a href="{{ route('product-detail', $product->id) }}">{{ $product->name }}</a>
                    </h5>
                    <div class="product-price-variant">
                        <span
                            class="price current-price">${{ number_format($product->price - ($product->price * $product->discount) / 100,2) }}</span>
                        <span class="price old-price">${{ number_format($product->price,2) }}</span>
                    </div>
                </div>
            @else
                <div class="inner">
                    <h5 class="title"><a href="{{ route('product-detail', $product->id) }}">{{ $product->name }}</a>
                    </h5>
                    <div class="product-price-variant">
                        <span class="price current-price">${{ number_format($product->price,2) }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>





    <!-- Product Quick View Modal Start -->
    <div class="modal fade quick-view-product" id="quickViewModal{{ $product->id }}" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="single-product-thumb">
                        <div class="row">
                            <div class="col-lg-7 mb--40">
                                <div class="row">
                                    <div class="col-lg-10 order-lg-2">
                                        <div
                                            class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                                            <div class="thumbnail">
                                                <img src="/web/assets/images/product/product-big-01.png"
                                                    alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget">20% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a href="/web/assets/images/product/product-big-01.png"
                                                        class="popup-zoom">
                                                        <i class="far fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="thumbnail">
                                                <img src="/web/assets/images/product/product-big-02.png"
                                                    alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget">20% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a href="/web/assets/images/product/product-big-02.png"
                                                        class="popup-zoom">
                                                        <i class="far fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="thumbnail">
                                                <img src="/web/assets/images/product/product-big-03.png"
                                                    alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget">20% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a href="/web/assets/images/product/product-big-03.png"
                                                        class="popup-zoom">
                                                        <i class="far fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 order-lg-1">
                                        <div class="product-small-thumb small-thumb-wrapper">
                                            <div class="small-thumb-img">
                                                <img src="/web/assets/images/product/product-thumb/thumb-08.png"
                                                    alt="thumb image">
                                            </div>
                                            <div class="small-thumb-img">
                                                <img src="/web/assets/images/product/product-thumb/thumb-07.png"
                                                    alt="thumb image">
                                            </div>
                                            <div class="small-thumb-img">
                                                <img src="/web/assets/images/product/product-thumb/thumb-09.png"
                                                    alt="thumb image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 mb--40">
                                <div class="single-product-content">
                                    <div class="inner">
                                        <div class="product-rating">
                                            <div class="star-rating">
                                                <img src="/web/assets/images/icons/rate.png" alt="Rate Images">
                                            </div>
                                            <div class="review-link">
                                                <a href="#">(<span>1</span> customer reviews)</a>
                                            </div>
                                        </div>
                                        <h3 class="product-title">{{ $product->name }}</h3>
                                        <span class="price-amount">$156.00 - $255.00</span>
                                        <ul class="product-meta">
                                            <li><i class="fal fa-check"></i>In stock</li>
                                            <li><i class="fal fa-check"></i>Free delivery available</li>
                                            <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>
                                        </ul>
                                        <p class="description">In ornare lorem ut est dapibus, ut tincidunt nisi
                                            pretium. Integer ante est, elementum eget magna. Pellentesque sagittis
                                            dictum libero, eu dignissim tellus.</p>

                                        <div class="product-variations-wrapper">

                                            <div class="product-variation">
                                                <h6 class="title">Colors:</h6>
                                                <div class="color-variant-wrapper">
                                                    <ul class="color-variant mt--0">
                                                        <li class="color-extra-01 active"><span><span
                                                                    class="color"></span></span>
                                                        </li>
                                                        <li class="color-extra-02"><span><span
                                                                    class="color"></span></span>
                                                        </li>
                                                        <li class="color-extra-03"><span><span
                                                                    class="color"></span></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="product-variation">
                                                <h6 class="title">Size:</h6>
                                                <ul class="range-variant">
                                                    <li>xs</li>
                                                    <li>s</li>
                                                    <li>m</li>
                                                    <li>l</li>
                                                    <li>xl</li>
                                                </ul>
                                            </div>

                                        </div>

                                        <!-- Start Product Action Wrapper  -->
                                        <div class="product-action-wrapper d-flex-center">
                                            <!-- Start Quentity Action  -->
                                            <div class="pro-qty"><input type="text" value="1"></div>
                                            <!-- End Quentity Action  -->

                                            <!-- Start Product Action  -->
                                            <ul class="product-action d-flex-center mb--0">
                                                <li class="add-to-cart"><a href="cart.html"
                                                        class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                                <li class="wishlist"><a href="wishlist.html"
                                                        class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a>
                                                </li>
                                            </ul>
                                            <!-- End Product Action  -->

                                        </div>
                                        <!-- End Product Action Wrapper  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <script>
            window.addEventListener("openViewModal", function(e) {
                var productId = "{{ $product->id }}"; 
                console.log(productId);
                $("#quickViewModal" + productId).modal("show");
            });
        </script> --}}
        <script>
            window.addEventListener("openViewModal", function(e) {
                const productId = e.detail.productId; // Get the product ID from the event detail
                $("#quickViewModal" + productId).modal("show");
            });
        </script>
    </div>
    <!-- Product Quick View Modal End -->
</div>



{{-- <div class="axil-product  product-style-one mb--30">
        <div class="thumbnail border p-3">
            <a>
                <img class="shop-image" src="/products/{{ $product->image }}"
                    alt="Product Images">
            </a>
            @if ($product->discount)
                <div class="label-block label-right">
                    <div class="product-badget">{{ $product->discount }}% OFF</div>
                </div>
            @endif
            <div class="product-hover-action">
                @if (!Auth::user())
                    @if ($product->outOfStock())
                    <ul class="cart-action">
                        <li class="select-option">
                            <a class="btn" @disabled(true)>Out of Stock
                            </a>
                        </li>
                    </ul>
                    @else
                        <ul class="cart-action">
                            <li class="wishlist"><a
                                    wire:click="addToWishlist({{ $product->id }})"><i
                                        class="far fa-heart"></i></a></li>
                            <li class="select-option">
                                @if ($this->isInCart($product->id))
                                    <a class="btn"
                                        wire:click="removeFromSessionCart({{ $product->id }})"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove
                                            wire:target="removeFromSessionCart({{ $product->id }})"><i
                                                class="bi bi-cart"></i> Remove</span>
                                        <span wire:loading
                                            wire:target="removeFromSessionCart({{ $product->id }})"
                                            class="spinner-border spinner-border-sm"
                                            aria-hidden="true"></span>
                                    </a>
                                @else
                                    <a class="btn"
                                        wire:click="addToSessionCart({{ $product->id }})"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove
                                            wire:target="addToSessionCart({{ $product->id }})"><i
                                                class="bi bi-cart"></i> Add</span>
                                        <span wire:loading
                                            wire:target="addToSessionCart({{ $product->id }})"
                                            class="spinner-border spinner-border-sm"
                                            aria-hidden="true"></span>
                                    </a>
                                @endif
                            </li>
                            <li class="quickview"><a
                                    href="{{ route('product-detail', $product->id) }}">
                                    <i class="far fa-eye"></i>
                                </a>
                            </li>
                        </ul>
                    @endif
                @else
                    @if ($product->outOfStock())
                        <ul class="cart-action">
                            <li class="select-option">
                                <a class="btn" @disabled(true)>Out of Stock
                                </a>
                            </li>
                        </ul>
                    @else
                        <ul class="cart-action">
                            <li class="wishlist">
                                @if ($product->hasWish(Auth::user()))
                                    <a wire:click="removeFromWishlist({{ $product->id }})"
                                        class="btn" wire:loading.attr="disabled">
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
                                        class="btn" wire:loading.attr="disabled">
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
                            <li class="select-option">
                                @if ($product->hasCart(Auth::user()))
                                    <a class="btn"
                                        wire:click="removeFromCart({{ $product->id }})"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove
                                            wire:target="removeFromCart({{ $product->id }})">
                                            <i class="bi bi-cart"></i> Remove</span>
                                        <span wire:loading
                                            wire:target="removeFromCart({{ $product->id }})"
                                            class="spinner-border spinner-border-sm"
                                            aria-hidden="true"></span>
                                    </a>
                                @else
                                    <a class="btn"
                                        wire:click="addToCart({{ $product->id }})"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove
                                            wire:target="addToCart({{ $product->id }})">
                                            <i class="bi bi-cart"></i> Add</span>
                                        <span wire:loading
                                            wire:target="addToCart({{ $product->id }})"
                                            class="spinner-border spinner-border-sm"
                                            aria-hidden="true"></span>
                                    </a>
                                @endif
                            </li>
                            <li class="quickview"><a
                                    href="{{ route('product-detail', $product->id) }}"><i
                                        class="far fa-eye"></i></a>
                            </li>
                        </ul>
                    @endif
                @endif
            </div>
        </div>
        <div class="product-content">
            @if ($product->discount)
                <div class="inner">
                    <h5 class="title"><a
                            href="{{ route('product-detail', $product->id) }}">{{ $product->name }}</a>
                    </h5>
                    <div class="product-price-variant">
                        <span
                            class="price current-price">${{ number_format($product->price - ($product->price * $product->discount) / 100,2) }}</span>
                        <span
                            class="price old-price">${{ number_format($product->price,2) }}</span>
                    </div>
                </div>
            @else
                <div class="inner">
                    <h5 class="title"><a
                            href="{{ route('product-detail', $product->id) }}">{{ $product->name }}</a>
                    </h5>
                    <div class="product-price-variant">
                        <span
                            class="price current-price">${{ number_format($product->price,2) }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div> --}}
