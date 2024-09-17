<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area dark-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item" aria-current="{{ route('products') }}">Shop</li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">{{ $product->name }}</li>
                        </ul>
                        <h1 class="title">{{ $product->name }}</h1>
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
    <div wire:ignore.self class="axil-single-product-area axil-section-gap pb--0 bg-color-white">
        <div class="single-product-thumb mb--40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb--40">
                        <div class="row">
                            <div class="col-lg-10 order-lg-2">
                                <div class="single-product-thumbnail-wrap zoom-gallery">
                                    <div class="single-product-thumbnail product-large-thumbnail-3 axil-product">
                                        <div class="thumbnail border">
                                            <a href="/storage/products/{{ $product->image }}" class="popup-zoom">
                                                <img src="/storage/products/{{ $product->image }}" alt="Product Images">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="label-block">
                                        @if ($product->discount)
                                            <div class="product-badget">{{ $product->discount }}% OFF</div>
                                        @endif
                                    </div>
                                    <div class="product-quick-view position-view">
                                        <a href="/storage/products/{{ $product->image }}" class="popup-zoom">
                                            <i class="far fa-search-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb--40">
                        <div class="single-product-content">
                            <div class="inner">
                                <h2 class="product-title">{{ $product->name }}</h2>
                                @if ($product->discount)
                                    <div class="price-amount price-offer-amount">
                                        <span
                                            class="price current-price">${{ number_format($product->price - ($product->price * $product->discount) / 100) }}</span>
                                        <span class="price old-price">${{ number_format($product->price) }}</span>
                                        {{-- <span class="offer-badge">20% OFF</span> --}}
                                    </div>
                                @else
                                    <div class="price-amount price-offer-amount">
                                        <span class="price current-price">${{ number_format($product->price) }}</span>
                                    </div>
                                @endif
                                <div class="product-rating">
                                    {{-- <div class="star-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div> --}}
                                    <div class="review-link">
                                        <a href="#">(<span>2</span> customer reviews)</a>
                                    </div>
                                </div>
                                <p class="description">
                                    {!! Str::words($product->description, 22) !!}
                                </p>

                                <div class="product-variations-wrapper">


                                    <!-- Start Product Variation  -->
                                    @if ($product->brand)
                                        <div class="product-variation product-size-variation">
                                            <span><b>Brand</b></span>
                                            <span class="ms-3">{{ $product->brand }}</span>
                                        </div>
                                    @endif
                                    @if ($product->category)
                                        <div class="product-variation product-size-variation">
                                            <span style="color: #DCC168;"><b>Category:</b></span>
                                            <span class="ms-3 text-capitalize">{{ $this->getCategory($product->category) }}</span>
                                        </div>
                                    @endif
                                    <!-- End Product Variation  -->

                                </div>

                                <!-- Start Product Action Wrapper  -->
                                @if (Auth::guest())
                                    <div class="product-action-wrapper d-flex-center">
                                        @if ($this->isInCart($product->id))
                                            <div class="pro-qty">
                                                <span wire:click="decSessionCart({{ $product->id }})"
                                                    class="dec qtybtn">
                                                    <span wire:loading.remove
                                                        wire:target="decSessionCart({{ $product->id }})">-</span>
                                                    <span wire:loading
                                                        wire:target="decSessionCart({{ $product->id }})"
                                                        class="spinner-grow spinner-grow" role="status"
                                                        aria-hidden="true"></span>
                                                </span>
                                                <input type="text" value="1" disabled>
                                                <span wire:click="incSessionCart({{ $product->id }})"
                                                    class="dec qtybtn">
                                                    <span wire:loading.remove
                                                        wire:target="incSessionCart({{ $product->id }})">+</span>
                                                    <span wire:loading
                                                        wire:target="incSessionCart({{ $product->id }})"
                                                        class="spinner-grow spinner-grow" role="status"
                                                        aria-hidden="true"></span>
                                                </span>
                                            </div>
                                        @endif
                                        <!-- End Quentity Action  -->

                                        <!-- Start Product Action  -->
                                        <ul class="product-action d-flex-center mb--0">
                                            @if ($this->isInCart($product->id))
                                                <li class="add-to-cart">
                                                    <a wire:click="removeFromSessionCart({{ $product->id }})"
                                                        class="btn axil-btn btn-bg-primary">
                                                        <span wire:loading.remove
                                                            wire:target="removeFromSessionCart({{ $product->id }})">Remove
                                                            from Cart</span>
                                                        <span wire:loading
                                                            wire:target="removeFromSessionCart({{ $product->id }})"
                                                            class="spinner-border" role="status"
                                                            aria-hidden="true"></span>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="add-to-cart">
                                                    <a wire:click="addToSessionCart({{ $product->id }})"
                                                        class="btn axil-btn btn-bg-primary">
                                                        <span wire:loading.remove
                                                            wire:target="addToSessionCart({{ $product->id }})">Add to
                                                            Cart</span>
                                                        <span wire:loading
                                                            wire:target="addToSessionCart({{ $product->id }})"
                                                            class="spinner-border" role="status"
                                                            aria-hidden="true"></span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="wishlist"><a wire:click="addToWishlist({{ $product->id }})"
                                                    class="btn axil-btn wishlist-btn"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <!-- End Product Action  -->

                                    </div>
                                @endif
                                <!-- End Product Action Wrapper  -->


                                @if (Auth::user())
                                    <div class="product-action-wrapper d-flex-center">
                                        @if ($product->hasCart(Auth::user()))
                                            <div class="pro-qty">
                                                <span wire:click="dec({{ $product->id }})" class="dec qtybtn">
                                                    <span wire:loading.remove
                                                        wire:target="dec({{ $product->id }})">-</span>
                                                    <span wire:loading wire:target="dec({{ $product->id }})"
                                                        class="spinner-grow spinner-grow" role="status"
                                                        aria-hidden="true"></span>
                                                </span>
                                                <input type="text"
                                                    value="{{ $this->getCartQuantity($product->id) }}">
                                                <span wire:click="inc({{ $product->id }})" class="dec qtybtn">
                                                    <span wire:loading.remove
                                                        wire:target="inc({{ $product->id }})">+</span>
                                                    <span wire:loading wire:target="inc({{ $product->id }})"
                                                        class="spinner-grow spinner-grow" role="status"
                                                        aria-hidden="true"></span>
                                                </span>
                                            </div>
                                        @endif
                                        <!-- End Quentity Action  -->

                                        <!-- Start Product Action  -->
                                        <ul class="product-action d-flex-center mb--0">
                                            @if ($product->hasCart(Auth::user()))
                                                <li class="add-to-cart">
                                                    <a wire:click="removeFromCart({{ $product->id }})"
                                                        class="btn axil-btn btn-bg-primary">
                                                        <span wire:loading.remove
                                                            wire:target="removeFromCart({{ $product->id }})">Remove
                                                            from Cart</span>
                                                        <span wire:loading
                                                            wire:target="removeFromCart({{ $product->id }})"
                                                            class="spinner-border" role="status"
                                                            aria-hidden="true"></span>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="add-to-cart">
                                                    <a wire:click="addToCart({{ $product->id }})"
                                                        class="btn axil-btn btn-bg-primary">
                                                        <span wire:loading.remove
                                                            wire:target="addToCart({{ $product->id }})">Add to
                                                            Cart</span>
                                                        <span wire:loading
                                                            wire:target="addToCart({{ $product->id }})"
                                                            class="spinner-border" role="status"
                                                            aria-hidden="true"></span>
                                                    </a>
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
                                        <!-- End Product Action  -->
                                    </div>
                                    <!-- End Product Action Wrapper  -->
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .single-product-thumb -->

        <div class="woocommerce-tabs wc-tabs-wrapper bg-vista-white">
            <div class="container">
                <ul class="nav tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="active" id="description-tab" data-bs-toggle="tab" href="#description"
                            role="tab" aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab"
                            aria-controls="reviews" aria-selected="false">Reviews</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">
                        <div class="product-desc-wrapper">
                            <div class="row">
                                <div class="col-lg-12 mb--30">
                                    <div class="single-desc">
                                        <h5 class="title">Description</h5>
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                </div>
                                <!-- End .col-lg-6 -->
                            </div>
                            <!-- End .row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="pro-des-features">
                                        <li class="single-features">
                                            <div class="icon">
                                                <img src="/web/assets/images/product/product-thumb/icon-3.png"
                                                    alt="icon">
                                            </div>
                                            Easy Returns
                                        </li>
                                        <li class="single-features">
                                            <div class="icon">
                                                <img src="/web/assets/images/product/product-thumb/icon-2.png"
                                                    alt="icon">
                                            </div>
                                            Quality Service
                                        </li>
                                        <li class="single-features">
                                            <div class="icon">
                                                <img src="/web/assets/images/product/product-thumb/icon-1.png"
                                                    alt="icon">
                                            </div>
                                            Original Product
                                        </li>
                                    </ul>
                                    <!-- End .pro-des-features -->
                                </div>
                            </div>
                            <!-- End .row -->
                        </div>
                        <!-- End .product-desc-wrapper -->
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="reviews-wrapper">
                            <div class="row">
                                <div class="col-lg-6 mb--40">
                                    <div class="axil-comment-area pro-desc-commnet-area">
                                        <h5 class="title">01 Review for this product</h5>
                                        <ul class="comment-list">
                                            <!-- Start Single Comment  -->
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <div class="single-comment">
                                                        <div class="comment-img">
                                                            <img src="./assets/images/blog/author-image-4.png"
                                                                alt="Author Images">
                                                        </div>
                                                        <div class="comment-inner">
                                                            <h6 class="commenter">
                                                                <a class="hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="Cameron Williamson">Eleanor
                                                                            Pena</span>
                                                                    </span>
                                                                </a>
                                                                <span class="commenter-rating ratiing-four-star">
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i
                                                                            class="fas fa-star empty-rating"></i></a>
                                                                </span>
                                                            </h6>
                                                            <div class="comment-text">
                                                                <p>“We’ve created a full-stack structure for our working
                                                                    workflow processes, were from the funny the century
                                                                    initial all the made, have spare to negatives. ”
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End Single Comment  -->

                                            <!-- Start Single Comment  -->
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <div class="single-comment">
                                                        <div class="comment-img">
                                                            <img src="./assets/images/blog/author-image-4.png"
                                                                alt="Author Images">
                                                        </div>
                                                        <div class="comment-inner">
                                                            <h6 class="commenter">
                                                                <a class="hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="Rahabi Khan">Courtney
                                                                            Henry</span>
                                                                    </span>
                                                                </a>
                                                                <span class="commenter-rating ratiing-four-star">
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                </span>
                                                            </h6>
                                                            <div class="comment-text">
                                                                <p>“We’ve created a full-stack structure for our working
                                                                    workflow processes, were from the funny the century
                                                                    initial all the made, have spare to negatives. ”</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End Single Comment  -->

                                            <!-- Start Single Comment  -->
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <div class="single-comment">
                                                        <div class="comment-img">
                                                            <img src="./assets/images/blog/author-image-5.png"
                                                                alt="Author Images">
                                                        </div>
                                                        <div class="comment-inner">
                                                            <h6 class="commenter">
                                                                <a class="hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="Rahabi Khan">Devon Lane</span>
                                                                    </span>
                                                                </a>
                                                                <span class="commenter-rating ratiing-four-star">
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                                </span>
                                                            </h6>
                                                            <div class="comment-text">
                                                                <p>“We’ve created a full-stack structure for our working
                                                                    workflow processes, were from the funny the century
                                                                    initial all the made, have spare to negatives. ”
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End Single Comment  -->
                                        </ul>
                                    </div>
                                    <!-- End .axil-commnet-area -->
                                </div>
                                <!-- End .col -->
                                <div class="col-lg-6 mb--40">
                                    <!-- Start Comment Respond  -->
                                    <div class="comment-respond pro-des-commend-respond mt--0">
                                        <h5 class="title mb--30">Add a Review</h5>
                                        <p>Your email address will not be published. Required fields are marked *</p>
                                        <div class="rating-wrapper d-flex-center mb--40">
                                            Your Rating <span class="require">*</span>
                                            <div class="reating-inner ml--20">
                                                <a href="#"><i class="fal fa-star"></i></a>
                                                <a href="#"><i class="fal fa-star"></i></a>
                                                <a href="#"><i class="fal fa-star"></i></a>
                                                <a href="#"><i class="fal fa-star"></i></a>
                                                <a href="#"><i class="fal fa-star"></i></a>
                                            </div>
                                        </div>

                                        <form action="#">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Other Notes (optional)</label>
                                                        <textarea name="message" placeholder="Your Comment"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Name <span class="require">*</span></label>
                                                        <input id="name" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Email <span class="require">*</span> </label>
                                                        <input id="email" type="email">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-submit">
                                                        <button type="submit" id="submit"
                                                            class="axil-btn btn-bg-primary w-auto">Submit
                                                            Comment</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Comment Respond  -->
                                </div>
                                <!-- End .col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- woocommerce-tabs -->

    </div>
    <!-- End Shop Area  -->

    <!-- Start Recently Viewed Product Area  -->
    <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> products</span>
                <h2 class="title">Related Products</h2>
            </div>
            <div wire:ignore class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">

                @foreach ($related_products as $related)
                    <div class="slick-single-layout">
                        <div class="axil-product product-style-one mb--30 border p-3">
                            <div class="thumbnail">
                                <a >
                                    <img src="/storage/products/{{ $related->image }}" alt="Product Images" style="height: 300px">
                                </a>
                                @if ($related->discount)
                                    <div class="label-block label-right">
                                        <div class="product-badget">{{ $related->discount }}% OFF</div>
                                    </div>
                                @endif
                                <div class="product-hover-action">

                                    @if (!Auth::user())
                                        <ul class="cart-action">
                                            <li class="wishlist"><a
                                                wire:click="addToWishlist({{ $related->id }})"><i
                                                    class="far fa-heart"></i></a></li>
                                        <li class="select-option">
                                            @if ($this->isInCart($related->id))
                                                <a class="btn"
                                                    wire:click="removeFromSessionCart({{ $related->id }})">
                                                    <span wire:loading.remove
                                                        wire:target="removeFromSessionCart({{ $related->id }})"><i
                                                            class="bi bi-cart"></i> Remove</span>
                                                    <span wire:loading
                                                        wire:target="removeFromSessionCart({{ $related->id }})"
                                                        class="spinner-border spinner-border-sm"
                                                        aria-hidden="true"></span>
                                                </a>
                                            @else
                                                <a class="btn"
                                                    wire:click="addToSessionCart({{ $related->id }})">
                                                    <span wire:loading.remove
                                                        wire:target="addToSessionCart({{ $related->id }})"><i
                                                            class="bi bi-cart"></i> Add</span>
                                                    <span wire:loading
                                                        wire:target="addToSessionCart({{ $related->id }})"
                                                        class="spinner-border spinner-border-sm"
                                                        aria-hidden="true"></span>
                                                </a>
                                            @endif
                                        </li>
                                        <li class="quickview"><a
                                                href="{{ route('product-detail', $related->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        </ul>
                                    @else
                                        <ul class="cart-action">
                                            <li class="wishlist">
                                                @if ($related->hasWish(Auth::user()))
                                                    <a wire:click="removeFromWishlist({{ $related->id }})"
                                                        class="btn">
                                                        <i wire:loading.remove
                                                            wire:target="removeFromWishlist({{ $related->id }})"
                                                            class="far fa-heart text-danger"></i>
                                                        <span wire:loading
                                                            wire:target="removeFromWishlist({{ $related->id }})"
                                                            class="spinner-border spinner-border-sm"
                                                            aria-hidden="true"></span>
                                                    </a>
                                                @else
                                                    <a wire:click="addToWishlist({{ $related->id }})"
                                                        class="btn">
                                                        <i wire:loading.remove
                                                            wire:target="addToWishlist({{ $related->id }})"
                                                            class="far fa-heart"></i>
                                                        <span wire:loading
                                                            wire:target="addToWishlist({{ $related->id }})"
                                                            class="spinner-border spinner-border-sm"
                                                            aria-hidden="true"></span>
                                                    </a>
                                                @endif
                                            </li>
                                            <li class="select-option">
                                                @if ($product->hasCart(Auth::user()))
                                                    <a class="btn"
                                                        wire:click="removeFromCart({{ $related->id }})">
                                                        <span wire:loading.remove
                                                            wire:target="removeFromCart({{ $related->id }})">Remove
                                                            from Cart</span>
                                                        <span wire:loading
                                                            wire:target="removeFromCart({{ $related->id }})"
                                                            class="spinner-border spinner-border-sm"
                                                            aria-hidden="true"></span>
                                                    </a>
                                                @else
                                                    <a class="btn" wire:click="addToCart({{ $related->id }})">
                                                        <span wire:loading.remove
                                                            wire:target="addToCart({{ $related->id }})">Add
                                                            to
                                                            Cart</span>
                                                        <span wire:loading
                                                            wire:target="addToCart({{ $related->id }})"
                                                            class="spinner-border spinner-border-sm"
                                                            aria-hidden="true"></span>
                                                    </a>
                                                @endif
                                            </li>
                                            <li class="quickview"><a href="{{ route("product-detail", $related->id) }}" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content">
                                @if ($product->discount)
                                    <div class="inner">
                                        <h5 class="title"><a href="{{ route("product-detail", $related->id) }}">{{ $related->name }}</a>
                                        </h5>
                                        <div class="product-price-variant">
                                            <span
                                                class="price current-price">${{ number_format($related->price - ($related->price * $product->discount) / 100) }}</span>
                                            <span class="price old-price">${{ number_format($related->price) }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="inner">
                                        <h5 class="title"><a href="single-product.html">{{ $related->name }}</a>
                                        </h5>
                                        <div class="product-price-variant">
                                            <span
                                                class="price current-price">${{ number_format($related->price) }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
    
            </div>
        </div>
    </div>
    <!-- End Recently Viewed Product Area  -->


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

    @push('scripts')

    <script src="/personal/personal.js"></script>
    @endpush
    {{-- @stack('scripts') --}}
</main>

