<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area dark-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{ route("home") }}" class="text-dark">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item"><a href="{{ route("dashboard") }}" class="text-dark">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">Order</li>
                        </ul>
                        <h1 class="title">order > {{ $id }}</h1>
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
            <div class="mb-5">
                <p class="text-dark"><span style="font-weight: bold">Reference:</span> <span class="ms-3">{{ $transaction->reference }}</span></p>
                <p class="text-dark"><span style="font-weight: bold">Date:</span> <span class="ms-3">{{ $transaction->created_at }}</span></p>
                <p class="text-dark"><span style="font-weight: bold">Number of Items:</span> <span class="ms-3">{{ $quantity }}</span></p>
                <p class="text-dark"><span style="font-weight: bold">Total Amount:</span> <span class="ms-3">${{ $total }}</span></p>
            </div>
            <div class="product-table-heading">
                <h4 class="title">Items</h4>
            </div>
            <div class="table-responsive">
                <table class="table axil-product-table axil-wishlist-table">
                    <thead>
                        <tr>
                            <th scope="col" class="product-thumbnail">Product</th>
                            <th scope="col" class="product-title">name</th>
                            <th scope="col" class="product-price">quantity</th>
                            <th scope="col" class="product-price">Unit Price</th>
                            <th scope="col" class="product-price">Total Amount</th>
                            <th scope="col" class="">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="product-thumbnail"><a href="single-product.html"><img
                                            src="/storage/products/{{ $order->product->image }}"
                                            alt="Digital Product"></a></td>
                                <td class="product-title"><a href="single-product.html">{{ $order->product->name }}</a>
                                </td>
                                <td class="product-price"  data-title="Quantity">{{ $order->quantity }}</td>
                                <td class="product-price" data-title="Price"><span class="currency-symbol">$</span>
                                    @if ($order->product->discount)
                                        {{ number_format($order->product->price - ($order->product->price * $order->product->discount) / 100) }}
                                    @else
                                        {{ number_format($order->product->price) }}
                                    @endif
                                </td>
                                <td class="product-price"  data-title="Total">${{ $order->total }}</td>
                                <td class="" data-title="Date">{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Wishlist Area  -->
</main>
