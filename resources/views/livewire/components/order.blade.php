<div class="axil-dashboard-order">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($transactions->count())
                @foreach ($transactions as $order)
                <tr>
                    <th scope="row">#{{ $order->reference }}</th>
                    <td>{{ $order->created_at }}</td>
                    <td>Processing</td>
                    <td>${{ $this->getTotal($order->id) }}</td>
                    <td><a href="{{ route("order", $order->reference) }}" class="axil-btn view-btn">View</a></td>
                </tr>
                @endforeach
                @else
                <div class="alert alert-info" role="alert">
                    No Order to Show Yet!
                </div>
                @endif              
            </tbody>
        </table>
    </div>
</div>