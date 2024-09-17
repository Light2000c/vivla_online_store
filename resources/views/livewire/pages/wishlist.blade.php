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
                            <li class="axil-breadcrumb-item active" aria-current="page">Wishlist</li>
                        </ul>
                        <h1 class="title">All Wishes</h1>
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


    <!-- Start Wishlist Area  -->
    <div class="axil-wishlist-area axil-section-gap">
        <div class="container">
            <div class="product-table-heading">
                <h4 class="title">My Wish List on eTrade</h4>
            </div>
            <div class="table-responsive">
                <table class="table axil-product-table axil-wishlist-table">
                    <thead>
                        <tr>
                            <th scope="col" class="product-remove"></th>
                            <th scope="col" class="product-thumbnail">Product</th>
                            <th scope="col" class="product-title"></th>
                            <th scope="col" class="product-price">Unit Price</th>
                            <th scope="col" class="product-stock-status">Stock Status</th>
                            <th scope="col" class="product-add-cart"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($wishlists->count())
                        @foreach ($wishlists as $wishes)
                            <tr>
                                <td class="product-remove">
                                    <a wire:click="delete({{ $wishes->id }})" class="remove-wishlist">
                                        <i wire:loading.remove wire:target="delete({{ $wishes->id }})"
                                            class="fal fa-times"></i>
                                        <span wire:loading wire:target="delete({{ $wishes->id }})"
                                            class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span></a>
                                    </a>
                                </td>
                                <td class="product-thumbnail"><a href="single-product.html"><img
                                            src="/storage/products/{{ $wishes->product->image }}"
                                            alt="Digital Product"></a></td>
                                <td class="product-title"><a href="single-product.html">{{ $wishes->product->name }}</a>
                                </td>
                                <td class="product-price" data-title="Price"><span class="currency-symbol">$</span>
                                    @if ($wishes->product->discount)
                                        {{ number_format($wishes->product->price - ($wishes->product->price * $wishes->product->discount) / 100) }}
                                    @else
                                        {{ number_format($wishes->product->price) }}
                                    @endif
                                </td>
                                <td class="product-stock-status" data-title="Status">In Stock</td>
                                @if ($wishes->product->hasCart(Auth::user()))
                                    <td class="product-add-cart">
                                        <a wire:click="removeFromCart({{ $wishes->product->id }})"
                                            class="btn axil-btn btn-outline">
                                            <span wire:loading.remove
                                                wire:target="removeFromCart({{ $wishes->product->id }})">Remove from
                                                Cart</span>
                                            <span wire:loading wire:target="removeFromCart({{ $wishes->product->id }})"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span></a>
                                    </td>
                                @else
                                    <td class="product-add-cart">
                                        <a wire:click="addToCart({{ $wishes->product->id }})"
                                            class="btn axil-btn btn-outline">
                                            <span wire:loading.remove
                                                wire:target="addToCart({{ $wishes->product->id }})">Add to Cart</span>
                                            <span wire:loading wire:target="addToCart({{ $wishes->product->id }})"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @else
                        <div class="alert alert-secondary" role="alert">
                            No Favourites To Show Yet! <a href="{{ route("products") }}" class="ms-3 text-primary">Go to Shop >></a>
                          </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Wishlist Area  -->
</main>
