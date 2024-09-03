<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">Shop</li>
                        </ul>
                        <h1 class="title">Explore All Products</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="/web/assets/images/product/product-45.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start Shop Area  -->
    <div class="axil-shop-area axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="axil-shop-sidebar">
                        <div class="d-lg-none">
                            <button class="sidebar-close filter-close-btn"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="toggle-list product-categories active">
                            <h6 class="title">CATEGORIES</h6>
                            <div class="shop-submenu">
                                <ul class="form-check">
                                    @foreach ($categories as $index => $category)
                                    <label class="con1"><span>{{ $category->name }}</span>
                                        <input wire:model.defer="selectedCategory" type="radio" name="radio1" value="{{ $category->name }}" wire:key="category-{{ $index }}">
                                        <span class="checkmark"></span>
                                      </label>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="toggle-list product-price-range active">
                            <h6 class="title">PRICE RANGE</h6>
                            <div class="shop-submenu">
                                {{-- <ul>
                                    <li class="chosen"><a href="#">30</a></li>
                                    <li><a href="#">5000</a></li>
                                </ul> --}}
                                <form  class="mt--25">
                                    <div id="slider-range"></div>
                                    <div class="flex-center mt--20">
                                        <span class="input-range">Price: </span>
                                        <input wire:model="range"  type="text" id="amount" class="amount-range" >
                                    </div>
                                </form>
                            </div>
                        </div>
                        <button wire:click.prevent="filterProduct" class="axil-btn btn-bg-primary">Filter</button>
                    </div>
                    <!-- End .axil-shop-sidebar -->
                </div>
                <div class="col-lg-9">
                    <!-- End .row -->
                    <div class="row row--15">
                        @foreach ($products as $index => $product)
                            <div class="col-xl-4 col-sm-6" wire:key="product-{{ $index }}">
                                {{-- <livewire:components.product-item :product="$product"  /> --}}
                                <div class="axil-product product-style-one mb--30 border p-3">
                                    <div class="thumbnail">
                                        <a>
                                            {{-- <img src="/storage/products/{{ $product->image }}" alt="Product Images"> --}}
                                            <img src="/web/assets/images/product/fashion/product-13.png" alt="Product Images">
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
                                                    <li class="select-option">
                                                        @if($this->isInCart($product->id))
                                                        <a wire:click="removeFromSessionCart({{ $product->id }})">Remove from Cart</a>
                                                        @else
                                                        <a wire:click="addToSessionCart({{ $product->id }})">Add to Cart</a>
                                                        @endif
                                                    </li>
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
                            
                            
                            
                            
                            </div>
                        @endforeach
                        <!-- End Single Product  -->
                    </div>
                    <div class="text-center pt--20">
                         {{ $products->withQueryString()->links() }} 
                    </div>
                </div>
            </div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End Shop Area  -->

    <!-- Start Axil Newsletter Area  -->
    <div class="axil-newsletter-area axil-section-gap pt--0">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                <div class="newsletter-content">
                    <span class="title-highlighter highlighter-primary2"><i
                            class="fas fa-envelope-open"></i>Newsletter</span>
                    <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
                    <div class="input-group newsletter-form">
                        <div class="position-relative newsletter-inner mb--15">
                            <input placeholder="example@gmail.com" type="text">
                        </div>
                        <button type="submit" class="axil-btn mb--15">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End Axil Newsletter Area  -->
</main>
