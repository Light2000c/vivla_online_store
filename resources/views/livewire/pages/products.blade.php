<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area dark-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
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
                                    {{-- <label class="con1 text-capitalize"><span>All Product</span>
                                        <input wire:ignore.self wire:model.defer="selectedCategory" type="radio"
                                            name="radio1" value="" wire:key="category"
                                            {{ $selectedCategory == null ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label> --}}
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
                                        class="amount-range" @disabled(true)>
                                    <input type="hidden" wire:model.lazy="hiddenRange" id="hidden-price-range">
                                </div>
                            </div>
                        </div>
                        {{-- <button wire:click.prevent="filterProduct" class="axil-btn btn-bg-primary">Filter</button> --}}
                        <button wire:click.prevent="filterProduct" class="axil-btn mb-4"
                            style="background-color: #DCC168;" wire:loading.attr="disabled">
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="axil-shop-top mb--40">
                                <div class="d-lg-none">
                                    <button class="product-filter-mobile filter-toggle"><i class="fas fa-filter"></i>
                                        FILTER</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($products->count())
                        <div class="row row--15">
                            @foreach ($products as $index => $product)
                                <div class="col-12 col-md-3 col-lg-3 col-xl-3" wire:key="product-{{ $index }}">
                                    {{-- <div class="col-12 col-md-3 col-lg-3 col-xl-3" >
                                        <livewire:components.product-item :key="time().$product->id" :product="$product" ></livewire:components.product-item> --}}
                                    <div class="axil-product  product-style-one mb--30">
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
                                                    <ul class="cart-action">
                                                        {{-- <li class="wishlist"><a
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
                                                            </li> --}}
                                                        <li class="select-option">
                                                            <a class="btn"
                                                                wire:click="openQuickView({{ $product->id }})">
                                                                <span wire:loading.remove
                                                                    wire:target="addToCart({{ $product->id }})">
                                                                    <i class="bi bi-handbag-fill me-2"></i>Quick
                                                                    View</span>
                                                                <span wire:loading
                                                                    wire:target="addToCart({{ $product->id }})"
                                                                    class="spinner-border spinner-border-sm"
                                                                    aria-hidden="true"></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                @else
                                                    <ul class="cart-action">
                                                        {{-- <li class="wishlist">
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
                                                            </li> --}}

                                                        <li class="select-option">
                                                            <a class="btn"
                                                                wire:click="openQuickView({{ $product->id }})">
                                                                <span wire:loading.remove
                                                                    wire:target="openQuickView({{ $product->id }})">
                                                                    <i class="bi bi-handbag-fill me-2"></i>Quick
                                                                    View</span>
                                                                <span wire:loading
                                                                    wire:target="openQuickView({{ $product->id }})"
                                                                    class="spinner-border spinner-border-sm"
                                                                    aria-hidden="true"></span>
                                                            </a>
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
                                                            class="price current-price">${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}</span>
                                                        <span
                                                            class="price old-price">${{ number_format($product->price, 2) }}</span>
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


    <!-- Product Quick View Modal Start -->
    <div wire:ignore.self class="modal fade quick-view-product" id="quickViewModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            @if ($activeProduct)
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
                                                class="single-product-thumbnail border product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                                                <div class="thumbnail">
                                                    <img src="/products/{{ $activeProduct->image ?? '' }}"
                                                        alt="Product Images">
                                                    <div class="label-block label-right">
                                                        @if ($activeProduct->discount ?? 0)
                                                            <div class="product-badget">
                                                                {{ $activeProduct->discount ?? 0 }}% OFF</div>
                                                        @endif
                                                    </div>
                                                    <div class="product-quick-view position-view">
                                                        <a href="/products/{{ $activeProduct->image ?? '' }}"
                                                            class="popup-zoom">
                                                            <i class="far fa-search-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 order-lg-1  mt-3">
                                            <div
                                                class="row d-flex flex-row flex-sm-row flex-md-column product-small-thumb small-thumb-wrapper">
                                                @if ($product_images->count())
                                                    @foreach ($product_images as $prod_image)
                                                        <div class="col small-thumb-img">
                                                            <img src="/products/{{ $prod_image->image }}"
                                                                alt="thumb image">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col small-thumb-img">
                                                        <img src="/products/{{ $activeProduct->image }}"
                                                            alt="thumb image">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 mb--40">
                                    <div class="single-product-content">
                                        <div class="inner">
                                            <h3 class="product-title">{{ $activeProduct->name ?? '' }}</h3>
                                            <div class="product-price-variant">
                                                <span
                                                    class="price-amount">${{ number_format(($activeProduct->price ?? 0) - (($activeProduct->price ?? 0) * ($activeProduct->discount ?? 0)) / 100,2) }}</span>
                                            </div>
                                            <div class="product-rating">
                                                @if (!$product_size->count())
                                                    <div class="review-link">
                                                        <a
                                                            href="#">({{ $activeProduct->quantity <= 1 ? $activeProduct->quantity . ' unit left' : $activeProduct->quantity . ' units left' }})</a>
                                                    </div>
                                                @endIf
                                            </div>
                                            <p class="description"> {!! Str::words($activeProduct->description ?? '', 22) !!}</p>

                                            <div class="product-variations-wrapper">

                                                @if ($activeProduct->brand ?? '')
                                                    <div class="product-variation product-size-variation">
                                                        <span><b>Brand</b></span>
                                                        <span class="ms-3">{{ $activeProduct->brand ?? '' }}</span>
                                                    </div>
                                                @endif
                                                @if ($activeProduct->category ?? '')
                                                    <div class="product-variation product-size-variation">
                                                        <span style="color: #DCC168;"><b>Category:</b></span>
                                                        <span
                                                            class="ms-3 text-capitalize">{{ $this->getCategory($activeProduct->category ?? '') }}</span>
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="product-variations-wrapper">

                                                <div class="product-variation">
                                                    @if ($product_size->count())
                                                        <div class="form-group">
                                                            <label for="">Size</label>
                                                            <select wire:model="size" wire:change="sizeChanged"
                                                                name="size" id="">
                                                                <option value="">Select a size</option>
                                                                @foreach ($product_size as $prod_size)
                                                                    <option value="{{ $prod_size->id }}">
                                                                        {{ $prod_size->size->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <small
                                                                class="text-primary">{{ $selectedSize ? $selectedSize->quantity . ' unit left' : '' }}</small>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>

                                            <!-- Start Product Action  -->
                                            @if (Auth::guest())
                                                <ul class="product-action d-flex-center mb--0">
                                                    @if ($product_size->count())
                                                        <li class="add-to-cart">
                                                            @if ($this->showAdd($activeProduct->id))
                                                                <a class="btn axil-btn btn-bg-primary"
                                                                    wire:click="removeQuickViewCartGuest({{ $activeProduct->id ?? '' }})"
                                                                    wire:loading.attr="disabled">
                                                                    <span wire:loading.remove
                                                                        wire:target="removeQuickViewCartGuest({{ $activeProduct->id ?? '' }})">
                                                                        <i class="bi bi-cart"></i> Remove</span>
                                                                    <span wire:loading
                                                                        wire:target="removeQuickViewCartGuest({{ $activeProduct->id ?? '' }})"
                                                                        class="spinner-border spinner-border-sm"
                                                                        aria-hidden="true"></span>
                                                                </a>
                                                            @else
                                                                <a class="btn axil-btn btn-bg-primary"
                                                                    wire:click="addQuickViewCartGuest({{ $activeProduct->id ?? '' }})"
                                                                    wire:loading.attr="disabled">
                                                                    <span wire:loading.remove
                                                                        wire:target="addQuickViewCartGuest({{ $activeProduct->id ?? '' }})">
                                                                        <i class="bi bi-cart"></i> Add</span>
                                                                    <span wire:loading
                                                                        wire:target="addQuickViewCartGuest({{ $activeProduct->id ?? '' }})"
                                                                        class="spinner-border spinner-border-sm"
                                                                        aria-hidden="true"></span>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @else
                                                        <ul class="product-action d-flex-center mb--0">
                                                            <li class="add-to-cart">
                                                                @if ($this->isInCart($activeProduct->id))
                                                                    <a class="btn axil-btn btn-bg-primary"
                                                                        wire:click="removeFromSessionCart({{ $activeProduct->id ?? '' }})"
                                                                        wire:loading.attr="disabled">
                                                                        <span wire:loading.remove
                                                                            wire:target="removeFromSessionCart({{ $activeProduct->id ?? '' }})">
                                                                            <i class="bi bi-cart"></i> Remove</span>
                                                                        <span wire:loading
                                                                            wire:target="removeFromSessionCart({{ $activeProduct->id ?? '' }})"
                                                                            class="spinner-border spinner-border-sm"
                                                                            aria-hidden="true"></span>
                                                                    </a>
                                                                @else
                                                                    <a class="btn axil-btn btn-bg-primary"
                                                                        wire:click="addToSessionCart({{ $activeProduct->id ?? '' }})"
                                                                        wire:loading.attr="disabled">
                                                                        <span wire:loading.remove
                                                                            wire:target="addToSessionCart({{ $activeProduct->id ?? '' }})">
                                                                            <i class="bi bi-cart"></i> Add</span>
                                                                        <span wire:loading
                                                                            wire:target="addToSessionCart({{ $activeProduct->id ?? '' }})"
                                                                            class="spinner-border spinner-border-sm"
                                                                            aria-hidden="true"></span>
                                                                    </a>
                                                                @endif
                                                            </li>
                                                    @endif
                                                    <li class="wishlist"><a href="{{ route('wishlist') }}"
                                                            class="axil-btn wishlist-btn"><i
                                                                class="far fa-heart"></i></a>
                                                    </li>
                                                </ul>
                                            @endif

                                            @if (Auth::user())
                                                <ul class="product-action d-flex-center mb--0">
                                                    @if ($product_size->count())
                                                        <li class="add-to-cart">
                                                            @if ($this->hasCartWithSize($activeProduct->id))
                                                                <a class="btn axil-btn btn-bg-primary"
                                                                    wire:click="removeQuickViewCart({{ $activeProduct->id ?? '' }})"
                                                                    wire:loading.attr="disabled">
                                                                    <span wire:loading.remove
                                                                        wire:target="removeQuickViewCart({{ $activeProduct->id ?? '' }})">
                                                                        <i class="bi bi-cart"></i> Remove</span>
                                                                    <span wire:loading
                                                                        wire:target="removeQuickViewCart({{ $activeProduct->id ?? '' }})"
                                                                        class="spinner-border spinner-border-sm"
                                                                        aria-hidden="true"></span>
                                                                </a>
                                                            @else
                                                                <a class="btn axil-btn btn-bg-primary"
                                                                    wire:click="addQuickViewCart({{ $activeProduct->id ?? '' }})"
                                                                    wire:loading.attr="disabled">
                                                                    <span wire:loading.remove
                                                                        wire:target="addQuickViewCart({{ $activeProduct->id ?? '' }})">
                                                                        <i class="bi bi-cart"></i> Add</span>
                                                                    <span wire:loading
                                                                        wire:target="addQuickViewCart({{ $activeProduct->id ?? '' }})"
                                                                        class="spinner-border spinner-border-sm"
                                                                        aria-hidden="true"></span>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @else
                                                        <ul class="product-action d-flex-center mb--0">
                                                            <li class="add-to-cart">
                                                                @if ($activeProduct->hasCart(Auth::user()))
                                                                    <a class="btn axil-btn btn-bg-primary"
                                                                        wire:click="removeFromCart({{ $activeProduct->id ?? '' }})"
                                                                        wire:loading.attr="disabled">
                                                                        <span wire:loading.remove
                                                                            wire:target="removeFromCart({{ $activeProduct->id ?? '' }})">
                                                                            <i class="bi bi-cart"></i> Remove</span>
                                                                        <span wire:loading
                                                                            wire:target="removeFromCart({{ $activeProduct->id ?? '' }})"
                                                                            class="spinner-border spinner-border-sm"
                                                                            aria-hidden="true"></span>
                                                                    </a>
                                                                @else
                                                                    <a class="btn axil-btn btn-bg-primary"
                                                                        wire:click="addToCart({{ $activeProduct->id ?? '' }})"
                                                                        wire:loading.attr="disabled">
                                                                        <span wire:loading.remove
                                                                            wire:target="addToCart({{ $activeProduct->id ?? '' }})">
                                                                            <i class="bi bi-cart"></i> Add</span>
                                                                        <span wire:loading
                                                                            wire:target="addToCart({{ $activeProduct->id ?? '' }})"
                                                                            class="spinner-border spinner-border-sm"
                                                                            aria-hidden="true"></span>
                                                                    </a>
                                                                @endif
                                                            </li>
                                                    @endif
                                                    @if ($product->hasWish(Auth::user()))
                                                        <li class="wishlist">
                                                            <a wire:click="removeFromWishlist({{ $product->id }})"
                                                                class="axil-btn wishlist-btn">
                                                                <i wire:loading.remove
                                                                    wire:target="removeFromWishlist({{ $product->id }})"
                                                                    class="far fa-heart text-danger"></i>
                                                                <span wire:loading
                                                                    wire:target="removeFromWishlist({{ $product->id }})"
                                                                    class="spinner-border" role="status"
                                                                    aria-hidden="true"></span>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li class="wishlist">
                                                            <a wire:click="addToWishlist({{ $product->id }})"
                                                                class="axil-btn wishlist-btn">
                                                                <i wire:loading.remove
                                                                    wire:target="addToWishlist({{ $product->id }})"
                                                                    class="far fa-heart "></i>
                                                                <span wire:loading
                                                                    wire:target="addToWishlist({{ $product->id }})"
                                                                    class="spinner-border" role="status"
                                                                    aria-hidden="true"></span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            @endIf
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    </div>
    <!-- Product Quick View Modal End -->
    </div>

    <script>
        window.addEventListener('message', function(e) {

            let data = e.detail;

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 4000,
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

    <script>
        window.addEventListener("openViewModal", function(e) {
            $("#quickViewModal").modal("show");
        });
    </script>
</main>
