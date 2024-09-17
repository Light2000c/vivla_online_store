<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area dark-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="index.html" class="text-dark">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">Shop</li>
                        </ul>
                        <h1 class="title">Explore All Products</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        {{-- <div class="bradcrumb-thumb">
                            <img src="/web/assets/images/product/product-45.png" alt="Image">
                        </div> --}}
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
                        <div wire:ignore class="toggle-list product-categories active">
                            <h6 class="title">CATEGORIES</h6>
                            <div class="shop-submenu">
                                <ul class="form-check">
                                    <label class="con1 text-capitalize"><span>All Product</span>
                                        <input wire:ignore.self wire:model.defer="selectedCategory" type="radio"
                                            name="radio1" value="" wire:key="category-"
                                            {{ $selectedCategory == null ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    @foreach ($categories as $index => $category)
                                        <label class="con1 text-capitalize"><span>{{ $category->name }}</span>
                                            <input wire:ignore.self wire:model.defer="selectedCategory" type="radio"
                                                name="radio1" value="{{ $category->name }}"
                                                wire:key="category-{{ $index }}">
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="toggle-list product-price-range active">
                            <h6 class="title">PRICE RANGE</h6>
                            <div wire:ignore class="shop-submenu">
                                <div id="slider-range"></div>
                                <div class="flex-center mt--20">
                                    <span class="input-range">Price: </span>
                                    <input wire:model.lazy="price_range" type="text" id="amount"
                                        class="amount-range">
                                    <input type="hidden" wire:model.lazy="hiddenRange" id="hidden-price-range">
                                </div>
                            </div>
                        </div>
                        {{-- <button wire:click.prevent="filterProduct" class="axil-btn btn-bg-primary">Filter</button> --}}
                        <button wire:click.prevent="filterProduct" class="axil-btn mb-4" style="background-color: #DCC168;" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="filterProduct">Filter</span>
                            <span wire:loading wire:target="filterProduct" class="spinner-border" role="status"
                                aria-hidden="true"></span>
                        </button>
                        <button wire:click.prevent="resetFilters" class="axil-btn mb-4"
                            style="background-color: #DCC168;" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="resetFilters">Reset Filters</span>
                            <span wire:loading wire:target="resetFilters" class="spinner-border" role="status"
                                aria-hidden="true"></span>
                        </button>
                    </div>
                    <!-- End .axil-shop-sidebar -->
                </div>
                <div class="col-lg-9">
                    <!-- End .row -->
                    @if ($products->count())
                        <div class="row row--15">
                            @foreach ($products as $index => $product)
                                <div class="col-xl-3 col-sm-6" wire:key="product-{{ $index }}">
                                    {{-- <livewire:components.product-item :product="$product"  /> --}}
                                    <div class="axil-product  product-style-one mb--30">
                                        {{-- <div class="axil-product  product-style-one mb--30 border p-3"> --}}
                                        <div class="thumbnail border p-3">
                                            <a>
                                                <img class="shop-image" src="/storage/products/{{ $product->image }}"
                                                    alt="Product Images">
                                            </a>
                                            @if ($product->discount)
                                                <div class="label-block label-right">
                                                    <div class="product-badget">{{ $product->discount }}% OFF</div>
                                                </div>
                                            @endif
                                            <div class="product-hover-action">

                                                @if (!Auth::user())
                                                    <ul class="cart-action">
                                                        <li class="wishlist"><a
                                                                wire:click="addToWishlist({{ $product->id }})"><i
                                                                    class="far fa-heart"></i></a></li>
                                                        <li class="select-option">
                                                            @if ($this->isInCart($product->id))
                                                                <a class="btn"
                                                                    wire:click="removeFromSessionCart({{ $product->id }})" wire:loading.attr="disabled">
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
                                                                    wire:click="addToSessionCart({{ $product->id }})" wire:loading.attr="disabled">
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
                                                                    wire:click="removeFromCart({{ $product->id }})" wire:loading.attr="disabled">
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
                                                                    wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled">
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
                                                            class="price current-price">${{ number_format($product->price - ($product->price * $product->discount) / 100) }}</span>
                                                        <span
                                                            class="price old-price">${{ number_format($product->price) }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="inner">
                                                    <h5 class="title"><a
                                                            href="{{ route('product-detail', $product->id) }}">{{ $product->name }}</a>
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
                    @else
                        <div class="alert alert-secondary" role="alert">
                            {{ $selectedCategory || $hiddenRange ? "Your filter didn't return any result" : 'No Product To Show Yet!' }}
                        </div>
                    @endif
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
