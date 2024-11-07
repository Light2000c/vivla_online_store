<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    .headers h6 {
        font-size: 20px;
    }

    .headers li {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .headers span {
        margin-left: 6px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }


    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }


    table {
        border: 1px solid black;
    }
</style>

<body>

    <div class="container">
        <div class="modal-body">
            <div class="headers">
                <h6>Order >> {{ $transaction->reference }}</h6>
                <ul style="list-style: none;">
                    <li>Items: <span>{{ $quantity }}</span> </li>
                    <li>Placed on <span>{{ $transaction->created_at }}</span></li>
                    <li>Tax <span>${{ number_format($tax, 2) }}</span></li>
                    <li>Shipping <span>${{ number_format($shipping->price, 2) ?? 0 }}</span></li>
                    <li>SubTotal: <span>${{ number_format($total, 2) }}</span></li>
                    <li>Total: <span>${{ number_format($total + $shipping->price + $tax, 2) }}</span></li>
                </ul>
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table table-bordered axil-product-table axil-wishlist-table">
                        <thead>
                            <tr>
                                <th scope="col" class="product-thumbnail">Id</th>
                                <th scope="col" class="product-title">name</th>
                                <th scope="col" class="product-sie">size</th>
                                <th scope="col" class="product-price">quantity</th>
                                <th scope="col" class="product-price">Unit Price</th>
                                <th scope="col" class="product-price">Total</th>
                                <th scope="col" class="">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td scope="col">{{ $order->product->id }}</td>
                                    <td class="product-title">{{ $order->product->name }}
                                    </td>
                                    <td class="product-price" data-title="size">
                                        {{ $order->productSize ? $order->productSize->size->name : null }}</td>
                                    <td class="product-price" data-title="Quantity">{{ $order->quantity }}</td>
                                    <td class="product-price" data-title="Price"><span class="currency-symbol">$</span>
                                        @if ($order->product->discount)
                                            {{ number_format($order->product->price - ($order->product->price * $order->product->discount) / 100, 2) }}
                                        @else
                                            {{ number_format($order->product->price, 2) }}
                                        @endif
                                    </td>
                                    <td class="product-price" data-title="Total">${{ number_format($order->total, 2) }}</td>
                                    <td class="" data-title="Date">{{ $order->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <p>Generated: {{ $date }}</p>
            </div>
        </div>
    </div>
</body>

</html>
