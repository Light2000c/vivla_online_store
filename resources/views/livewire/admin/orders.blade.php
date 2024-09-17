<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Orders</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header ">
                        <h3>Order Table</h3>
                    </div>

                    {{-- <div class="align-self-end search-form m-3">
                        <input wire:model.live.debounce.150ms="search" type="text" placeholder="Search here...">
                    </div> --}}
                    <div class="m-4">
                        <p class="text-dark"><span style="font-weight: bold">Reference:</span> <span class="ms-3">{{ $transaction->reference }}</span></p>
                        <p class="text-dark"><span style="font-weight: bold">Date:</span> <span class="ms-3">{{ $transaction->created_at }}</span></p>
                        <p class="text-dark"><span style="font-weight: bold">Number of Items:</span> <span class="ms-3">{{ $quantity }}</span></p>
                        <p class="text-dark"><span style="font-weight: bold">Total Amount:</span> <span class="ms-3">${{ $total }}</span></p>
                    </div>

                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col"></th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders)
                                @foreach($orders as $order)
                                <tr class="border-bottom-secondary">
                                    <th> <input class="form-check-input" id="flexCheckDefault" type="checkbox"
                                            value=""></th>
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td> <img class="img-30 me-2" src="/storage/products/{{ $order->product->image }}" alt="profile">
                                    </td>
                                    <td>{{ $order->product->price }}</td>
                                    <td>{{ $total }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <div>
                                            <div class="">
                                                <button class="btn btn-danger btn-sm" type="submit"><i
                                                        class="bi bi-trash3-fill"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                <div class="alert alert-info" role="alert">
                                    No Product to Show Yet!
                                </div>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
