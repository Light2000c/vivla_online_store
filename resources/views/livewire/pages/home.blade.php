<main class="main-wrapper">

    <!-- Start Categorie Area  -->
    <div class="axil-categorie-area pt--30 bg-color-white">
        <div class="container">
            <div class="categrie-product-activation-2 categorie-product-two slick-layout-wrapper--15">
                @foreach ($categories as $category)
                    <div class="slick-single-layout slick-slide">
                        <div class="categrie-product-2">
                            <a href="#">
                                {{-- <img class="img-fluid" src="/web/assets/images/product/categories/furni-1.png" alt="product categorie"> --}}
                                <h6 class="cat-title text-nowrap">{{ $category->name }}</h6>
                            </a>
                        </div>
                    </div>
                @endforeach
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout slick-slide">
                    <div class="categrie-product-2">
                        <a href="#">
                            <img class="img-fluid" src="/web/assets/images/product/categories/furni-2.png"
                                alt="product categorie">
                            <h6 class="cat-title">Desk Table</h6>
                        </a>
                    </div>
                    <!-- End .categrie-product -->
                </div>
                <!-- End .slick-single-layout -->
            </div>
        </div>
    </div>
    <!-- End Categorie Area  -->

    <!-- Start Slider Area -->
    <div class="axil-main-slider-area main-slider-style-5">
        <div class="container">
            <div class="slider-box-wrap">
                <div class="slider-activation-two axil-slick-dots">
                    <div class="single-slide slick-slide">
                        <div class="main-slider-content">
                            <span class="subtitle"><i class="fas fa-fire"></i> Hot Deal In This Week</span>
                            <h1 class="title">Neon Stylish Sofa Chair</h1>
                            <div class="shop-btn">
                                <a href="shop.html" class="axil-btn btn-bg-white"><i class="fal fa-shopping-cart"></i>
                                    Shop Now</a>
                            </div>
                        </div>
                        <div class="main-slider-thumb">
                            <img src="/web/assets/images/product/product-47.png" alt="Product">
                        </div>
                    </div>
                    <div class="single-slide slick-slide">
                        <div class="main-slider-content">
                            <span class="subtitle"><i class="fas fa-fire"></i> Hot Deal In This Week</span>
                            <h1 class="title">Sofa Chair with Lamp</h1>
                            <div class="shop-btn">
                                <a href="shop.html" class="axil-btn btn-bg-white"><i class="fal fa-shopping-cart"></i>
                                    Shop Now</a>
                            </div>
                        </div>
                        <div class="main-slider-thumb">
                            <img src="/web/assets/images/product/product-48.png" alt="Product">
                        </div>
                    </div>
                    <div class="single-slide slick-slide">
                        <div class="main-slider-content">
                            <span class="subtitle"><i class="fas fa-fire"></i> Hot Deal In This Week</span>
                            <h1 class="title">Neon Stylish Sofa Chair</h1>
                            <div class="shop-btn">
                                <a href="shop.html" class="axil-btn btn-bg-white"><i class="fal fa-shopping-cart"></i>
                                    Shop Now</a>
                            </div>
                        </div>
                        <div class="main-slider-thumb">
                            <img src="/web/assets/images/product/product-47.png" alt="Product">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Area -->

    <!-- Start Best Sellers Product Area  -->
    <div class="axil-best-seller-product-area bg-color-white axil-section-gap pb--0">
        <div class="container">
            <div class="product-area pb--50">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> This
                        Week’s</span>
                    <h2 class="title">New Arrivals</h2>
                </div>
                <div
                    class="new-arrivals-product-activation-2 slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide product-slide-mobile">
                    @foreach ($new_products->slice(2) as $new)
                        <div class="slick-single-layout h-100">
                            <div class="axil-product product-style-six">
                                <div class="thumbnail">
                                    <a href="single-product-7.html">
                                        <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500"
                                            src="/storage/products/{{ $new->image }}" alt="Product Images"
                                            style="height: 300px">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <div class="product-price-variant" style="background-color: #d8ba56;">
                                            @if ($new->discount)
                                                <span
                                                    class="price curreent-price">${{ number_format($new->price - ($new->price * $new->discount) / 100) }}</span>
                                            @else
                                                <span
                                                    class="price curreent-price">${{ number_format($new->price) }}</span>
                                            @endif
                                        </div>
                                        <h5 class="title text-start"><a href="single-product-7.html">{{ $new->name }}
                                                <span class="verified-icon"><i
                                                        class="fas fa-badge-check"></i></span></a></h5>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="select-option"><a href="single-product-7.html">Buy
                                                        Product</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End .slick-single-layout -->


                </div>
            </div>
        </div>
    </div>
    <!-- End  Best Sellers Product Area  -->


    <!-- Poster Countdown Area  -->
    <div class="axil-poster-countdown">
        <div class="container">
            <div class="poster-countdown-wrap bg-lighter">
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="poster-countdown-content">
                            <div class="section-title-wrapper">
                                <span class="title-highlighter highlighter-secondary"> <i
                                        class="far fa-shopping-basket"></i> Don’t Miss!!</span>
                                <h2 class="title">Let's Shopping Today</h2>
                            </div>
                            <div class="poster-countdown countdown mb--40"></div>
                            <a href="#" class="axil-btn btn-bg-primary">Check it Out!</a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="poster-countdown-thumbnail">
                            <img src="/web/assets/images/product/poster/poster-05.png" alt="Poster Product">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Poster Countdown Area  -->

    <!-- Start New Arrivals Product Area  -->
    <div class="axil-new-arrivals-product-area fullwidth-container bg-color-white axil-section-gap pb--0">
        <div class="container ml--xxl-0">
            <div class="product-area pb--50">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> This
                        Week’s</span>
                    <h2 class="title">Best Selling</h2>
                </div>
                <div wire:ignore
                    class="new-arrivals-product-activation slick-layout-wrapper--15 axil-slick-arrow  arrow-top-slide">
                    @foreach ($new_products as $new)
                        <div  class="slick-single-layout">
                            <div  class="axil-product product-style-four">
                                <div class="thumbnail border p-2">
                                    <a href="single-product.html">
                                        <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500"
                                            src="/storage/products/{{ $new->image }}" alt="Product Images"
                                            style="height: 330px;">
                                    </a>
                                    @if ($new->discount)
                                        <div class="label-block label-right">
                                            <div class="product-badget">{{ $new->discount }}% OFF</div>
                                        </div>
                                    @endif

                                    {{-- beginning of hover content --}}
                                    {{-- <div class="product-hover-action">

                                        @if (!Auth::user())
                                            <ul class="cart-action">
                                                <li class="select-option">
                                                    @if ($this->isInCart($new->id))
                                                        <a class="btn"
                                                            wire:click="removeFromSessionCart({{ $new->id }})">
                                                            <span wire:loading.remove
                                                                wire:target="removeFromSessionCart({{ $new->id }})"><i
                                                                    class="bi bi-cart"></i> Remove</span>
                                                            <span wire:loading
                                                                wire:target="removeFromSessionCart({{ $new->id }})"
                                                                class="spinner-border spinner-border-sm"
                                                                aria-hidden="true"></span>
                                                        </a>
                                                    @else
                                                        <a class="btn"
                                                            wire:click="addToSessionCart({{ $new->id }})">
                                                            <span wire:loading.remove
                                                                wire:target="addToSessionCart({{ $new->id }})"><i
                                                                    class="bi bi-cart"></i> Add</span>
                                                            <span wire:loading
                                                                wire:target="addToSessionCart({{ $new->id }})"
                                                                class="spinner-border spinner-border-sm"
                                                                aria-hidden="true"></span>
                                                        </a>
                                                    @endif
                                                </li>
                                            </ul>
                                        @else
                                            <ul class="cart-action">
                                                <li class="select-option">
                                                    @if ($new->hasCart(Auth::user()))
                                                        <a class="btn"
                                                            wire:click="removeFromCart({{ $new->id }})">
                                                            <span wire:loading.remove
                                                                wire:target="removeFromCart({{ $new->id }})">
                                                                <i class="bi bi-cart"></i> Remove</span>
                                                            <span wire:loading
                                                                wire:target="removeFromCart({{ $new->id }})"
                                                                class="spinner-border spinner-border-sm"
                                                                aria-hidden="true"></span>
                                                        </a>
                                                    @else
                                                        <a class="btn"
                                                            wire:click="addToCart({{ $new->id }})">
                                                            <span wire:loading.remove
                                                                wire:target="addToCart({{ $new->id }})">
                                                                <i class="bi bi-cart"></i> Add</span>
                                                            <span wire:loading
                                                                wire:target="addToCart({{ $new->id }})"
                                                                class="spinner-border spinner-border-sm"
                                                                aria-hidden="true"></span>
                                                        </a>
                                                    @endif
                                                </li>
                                            </ul>
                                        @endif
                                    </div> --}}
                                    {{-- beginning of hover content --}}
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <h5 class="title"><a href="s">{{ $new->name }}</a></h5>
                                        @if ($new->discount)
                                            <div class="product-price-variant">
                                                <span
                                                    class="price curreent-price">${{ $new->price - ($new->price * $new->discount) / 100 }}</span>
                                                <span class="price old-price">${{ $new->price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price-variant">
                                                <span class="price current-price">${{ $new->price }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End New Arrivals Product Area  -->


    <!-- Start Why Choose Area  -->
    <div class="how-to-sell-area axil-section-gap">
        <div class="container">
            <div class="product-area pb--50">
                <div class="section-title-wrapper section-title-center">
                    <h2 class="title">How to buy</h2>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 row--20">
                    <div class="col">
                        <div class="service-box how-to-sell">
                            <div class="icon">
                                <i class="bi bi-handbag-fill" style="font-size: 30px;color: #DCC168;"></i>
                            </div>
                            <h6 class="title">Browse Products</h6>
                            <p> Explore categories or use the search bar to find items of interest.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="service-box how-to-sell">
                            <div class="icon">
                                <i class="bi bi-cart4" style="font-size: 30px;color: #DCC168;"></i>
                            </div>
                            <h6 class="title">Add to Cart</h6>
                            <p>Select desired items and add them to your shopping cart.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="service-box how-to-sell">
                            <div class="icon">
                                <i class="bi bi-bag-check" style="font-size: 30px;color: #DCC168;"></i>
                            </div>
                            <h6 class="title">Checkout</h6>
                            <p>Review your cart, enter shipping details, and choose a payment method.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="service-box how-to-sell">
                            <div class="icon">
                                <i class="bi bi-check-square-fill" style="font-size: 30px;color: #DCC168;"></i>
                            </div>
                            <h6 class="title">Confirm Order</h6>
                            <p>Complete the purchase by confirming the order and receiving a receipt or confirmation email.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Area  -->

    <!-- Start Most Sold Product Area  -->
    <div class="axil-most-sold-product axil-section-gap pb--0">
        <div class="container">
            <div class="product-area pb--50">
                <div class="section-title-wrapper section-title-center">
                    <span class="title-highlighter highlighter-primary"><i class="fas fa-star"></i> Most Sold</span>
                    <h2 class="title">Most Sold Last 7 Days</h2>
                </div>
                <div class="row row-cols-xl-3 row-cols-md-2 row-cols-1 row--15">
                    @foreach ($new_products->slice(2, 9) as $new)
                        <div class="col">
                            <div class="axil-product-list product-list-style-2">
                                <div class="thumbnail">
                                    <a href="single-product-7.html">
                                        <img data-sal="zoom-in" data-sal-delay="100" data-sal-duration="1500"
                                            src="/storage/products/{{ $new->image }}" alt="NFT">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h6 class="product-title"><a href="single-product-7.html">{{ $new->name }} <span
                                                class="verified-icon"><i class="fas fa-badge-check"></i></span></a>
                                    </h6>
                                    <div class="product-price-variant">
                                        @if ($new->discount)
                                            <span
                                                class="price curreent-price">${{ number_format($new->price - ($new->price * $new->discount) / 100) }}</span>
                                        @else
                                            <span
                                                class="price curreent-price">${{ number_format($new->price) }}</span>
                                        @endif
                                    </div>
                                    <div class="product-cart">
                                        <a href="single-product-7.html" class="cart-btn">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center mt--20 mt_sm--0">
                        <a href="shop.html" class="axil-btn btn-bg-lighter btn-load-more">View All Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Sold Product Area  -->

    <!-- Start Axil Newsletter Area  -->
    <div class="axil-newsletter-area axil-section-gap pt--0">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--12">
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
