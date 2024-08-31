<main class="main-wrapper">

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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Wishlist Area  -->
</main>
