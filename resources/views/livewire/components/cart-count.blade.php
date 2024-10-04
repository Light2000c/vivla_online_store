 <div>
     @if (Auth::user())
         @if ($display === 'count')
             {{ $cartCount->sum('quantity') }}
         @elseif($display === 'total')
             @if (Auth::user())
                 <span class="subtotal-amount">${{ number_format($this->getTotal()) }}</span>
             @endif
         @else
         @if($cartCount->count())
             @foreach ($cartCount as $cart)
                 <li class="cart-item">
                     <div class="item-img">
                         <a href="{{ route("product-detail", $cart->product) }}"><img src="/products/{{ $cart->product->image }}"
                                 alt="Commodo Blown Lamp"></a>
                         <button wire:click="delete({{ $cart->id }})" class="close-btn">
                             <i wire:loading.remove wire:target="delete({{ $cart->id }})" class="fas fa-times"></i>
                             <span wire:loading wire:target="delete({{ $cart->id }})"
                                 class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                         </button>
                     </div>
                     <div class="item-content">
                         {{-- <div class="product-rating">
                        <span class="icon">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </span>
                        <span class="rating-number">(64)</span>
                    </div> --}}
                         <h3 class="item-title"><a href="{{ route("product-detail", $cart->product) }}">{{ $cart->product->name }}</a>
                         </h3>
                         <div class="item-price"><span class="currency-symbol">$</span>
                             @if ($cart->product->discount)
                                 {{ number_format($cart->product->price - ($cart->product->price * $cart->product->discount) / 100) }}
                             @else
                                 {{ number_format($cart->product->price) }}
                             @endif
                         </div>

                         <div class="pro-qty item-quantity">
                             <span wire:click="dec({{ $cart->id }})" class="dec qtybtn">
                                 <span wire:loading.remove wire:target="dec({{ $cart->id }})">-</span>
                                 <span wire:loading wire:target="dec({{ $cart->id }})"
                                     class="spinner-grow spinner-grow" role="status" aria-hidden="true"></span>
                             </span>
                             <input wire:change="update({{ $cart->id }}, $event.target.value)" type="number"
                                 class="quantity-input" value="{{ $cart->quantity }}">
                             <span wire:click="inc({{ $cart->id }})" class="inc qtybtn">
                                 <span wire:loading.remove wire:target="inc({{ $cart->id }})">+</span>
                                 <span wire:loading wire:target="inc({{ $cart->id }})"
                                     class="spinner-grow spinner-grow" role="status" aria-hidden="true"></span>
                             </span>
                         </div>
                     </div>
                 </li>
             @endforeach
             @else
             <div class="alert alert-secondary" role="alert">
                 No Cart To Show Yet! <a href="{{ route("products") }}" class="ms-3 text-primary">Go to Shop >></a>
               </div>
             @endif
         @endif
     @else
         @if ($display === 'count')
             {{ $cartCount }}
         @endif
     @endif
 </div>
