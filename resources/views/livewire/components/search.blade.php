<div class="header-search-wrap">
    <div class="card-header">
        <form action="#">
            <div class="input-group">
                <input wire:model.live.debounce.150ms="keyword" type="search" class="form-control" name="prod-search"
                    id="prod-search" placeholder="Write Something....">
                <button type="submit" class="axil-btn btn-bg-primary"><i class="far fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="search-result-header">
            <h6 class="title">{{ count($search_results) }} Result Found</h6>
            <a href="{{ route("products") }}" class="view-all">View All</a>
        </div>
        <div class="psearch-results">
            @foreach ($search_results as $result)
                <div class="axil-product-list">
                    <div class="thumbnail">
                        <a href="single-product.html">
                            <img src="/storage/products/{{$result->image}}" alt="Yantiti Leather Bags" style="width: 100px; height: 100px;">
                        </a>
                    </div>
                    <div class="product-content">
                        {{-- <div class="product-rating">
                        <span class="rating-icon">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fal fa-star"></i>
                        </span>
                        <span class="rating-number"><span>100+</span> Reviews</span>
                    </div> --}}
                        <h6 class="product-title"><a href="single-product.html">{{ $result->name }}</a></h6>
                        @if ($result->discount)
                            <div class="product-price-variant">
                                <span class="price current-price">${{ $result->price - ($result->price * $result->discount / 100 ) }}</span>
                                <span class="price old-price">${{ $result->price }}</span>
                            </div>
                        @else
                            <div class="product-price-variant">
                                <span class="price old-price">${{ $result->price }}</span>
                            </div>
                        @endif
                        <div class="product-cart">
                            <a href="{{ route("product-detail", $result->id) }}" class="cart-btn"><i class="far fa-eye"></i></a>
                            {{-- <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="axil-product-list">
                <div class="thumbnail">
                    <a href="single-product.html">
                        <img src="/web/assets/images/product/electric/product-09.png" alt="Yantiti Leather Bags">
                    </a>
                </div>
                <div class="product-content">
                    <div class="product-rating">
                        <span class="rating-icon">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fal fa-star"></i>
                        </span>
                        <span class="rating-number"><span>100+</span> Reviews</span>
                    </div>
                    <h6 class="product-title"><a href="single-product.html">Media Remote</a></h6>
                    <div class="product-price-variant">
                        <span class="price current-price">$29.99</span>
                        <span class="price old-price">$49.99</span>
                    </div>
                    <div class="product-cart">
                        <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                        <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
