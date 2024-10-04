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
                            <li class="axil-breadcrumb-item"><a href="{{ route('dashboard') }}"
                                    class="text-dark">Home</a></li>
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


            <div class="card shadow border-0 p-2 mb-5">
                <div class="card-body">
                    <h6>Order >> {{ $transaction->reference }}</h6>
                    <ul style="list-style: none;">
                        <li>{{ $quantity }} Items</li>
                        <li>Placed on {{ $transaction->created_at }}</li>
                        <li>Total: $ {{ number_format($total) }}</li>
                    </ul>
                </div>
            </div>
            <div class="product-table-heading mt-4">
                <h5 class="title">Items in your order <span>
                        <a class="btn" style="font-size: 18px; color:  #DCC168;" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">view status >></a>
                    </span></h5>
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
                                            src="/products/{{ $order->product->image }}"
                                            alt="Digital Product"></a></td>
                                <td class="product-title"><a href="single-product.html">{{ $order->product->name }}</a>
                                </td>
                                <td class="product-price" data-title="Quantity">{{ $order->quantity }}</td>
                                <td class="product-price" data-title="Price"><span class="currency-symbol">$</span>
                                    @if ($order->product->discount)
                                        {{ number_format($order->product->price - ($order->product->price * $order->product->discount) / 100) }}
                                    @else
                                        {{ number_format($order->product->price) }}
                                    @endif
                                </td>
                                <td class="product-price" data-title="Total">${{ $order->total }}</td>
                                <td class="" data-title="Date">{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Wishlist Area  -->

    <!-- Modal -->
    <div class="modal modal-centered fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Package History</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body pb-5 pt-5">
                    <div>
                        <ul class="timeline">
                            <li class="timeline-item completed">
                                <i class="bi bi-check-circle-fill icon"></i>
                                <div>
                                    <h5>Order Placed</h5>
                                    <span>07-03-2024</span>
                                </div>
                            </li>
                            <li
                                class="timeline-item {{ $transaction->status === 1 || $transaction->status === 2 || $transaction->status === 3 || $transaction->status === 4 ? 'completed' : 'pending' }}">
                                @if (
                                    $transaction->status === 1 ||
                                        $transaction->status === 2 ||
                                        $transaction->status === 3 ||
                                        $transaction->status === 4)
                                    <i class="bi bi-check-circle-fill icon"></i>
                                @else
                                    <i class="bi bi-record-circle-fill icon"></i>
                                @endif
                                <div>
                                    <h5>Pending Confirmation</h5>
                                    <span>07-03-2024</span>
                                </div>
                            </li>
                            <li
                                class="timeline-item {{ $transaction->status === 2 || $transaction->status === 3 || $transaction->status === 4 ? 'completed' : 'pending' }}">
                                @if ($transaction->status === 2 || $transaction->status === 3 || $transaction->status === 4)
                                    <i class="bi bi-check-circle-fill icon"></i>
                                @else
                                    <i class="bi bi-record-circle-fill icon"></i>
                                @endif
                                <div>
                                    <h5>Waiting to be sent</h5>
                                    <span>07-03-2024</span>
                                </div>
                            </li>
                            <li
                                class="timeline-item {{ $transaction->status === 3 || $transaction->status === 4 ? 'completed' : 'pending' }}">
                                @if ($transaction->status === 3 || $transaction->status === 4)
                                    <i class="bi bi-check-circle-fill icon"></i>
                                @else
                                    <i class="bi bi-record-circle-fill icon"></i>
                                @endif
                                <div>
                                    <h5>Sent</h5>
                                    <span>08-03-2024</span>
                                </div>
                            </li>
                            {{-- <li class="timeline-item pending">
                                <i class="bi bi-record-circle-fill icon"></i>
                              <div>
                                <h5>Out for Delivery</h5>
                                <span>19-03-2024</span>
                              </div>
                            </li> --}}
                            <li
                                class="timeline-item-end {{ $transaction->status === 4 ? 'completed' : 'pending' }}">
                                @if ($transaction->status === 4)
                                    <i class="bi bi-record-circle-fill icon"></i>
                                @else
                                    <i class="bi bi-record-circle-fill icon"></i>
                                @endif
                                <div>
                                    <h5>Delivered</h5>
                                    <span>19-03-2024</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
