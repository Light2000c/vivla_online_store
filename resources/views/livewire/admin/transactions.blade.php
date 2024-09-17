<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Transactions</h3>
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
                        <h3>Transaction Table</h3>
                    </div>

                    <div class="align-self-end search-form m-3">
                        <input wire:model.live.debounce.150ms="search" type="text" placeholder="Search here...">
                    </div>
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <thead>
                                    <tr>
                                        <th scope="col">Order</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                            </thead>
                            <tbody>
                                @if ($transactions->count())
                                    @foreach ($transactions as $order)
                                        <tr>
                                            <th scope="row">#{{ $order->reference }}</th>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->user->name }}</th>
                                            <td>Processing</td>
                                            <td>${{ $this->getTotal($order->id) }}</td>
                                            <td>
                                                <a href="{{ route('admin-order', $order->reference) }}"
                                                    class="btn btn-outline-primary btn-sm" type="submit">view</a>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                    <div class="alert alert-info" role="alert">
                                        No Transaction to Show Yet!
                                    </div>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="m-2">
                        {{ $transactions->withQueryString()->links() }}
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
