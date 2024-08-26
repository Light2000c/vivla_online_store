<div>
    @if ($display == 'count')
        {{ $cartCount->count() }}
    @else
        @foreach ($cartCount as $cart)
            <li class="cart-item">
                <div class="item-img">
                    <a href="single-product.html"><img src="/web/assets/images/product/electric/product-01.png"
                            alt="Commodo Blown Lamp"></a>
                    <button class="close-btn"><i class="fas fa-times"></i></button>
                </div>
                <div class="item-content">
                    <div class="product-rating">
                        <span class="icon">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </span>
                        <span class="rating-number">(64)</span>
                    </div>
                    <h3 class="item-title"><a href="single-product-3.html">Wireless PS Handler</a>
                    </h3>
                    <div class="item-price"><span class="currency-symbol">$</span>155.00</div>
                    <div class="pro-qty item-quantity">
                        <input type="number" class="quantity-input" value="15">
                    </div>
                </div>
            </li>
        @endforeach
    @endif
</div>
