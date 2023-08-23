<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>TM Invoice #{{ $order->id }}, {{ $order->name }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="text-center">
        <h2>Thank you for ordering!</h2>
        <p>Thank you for shopping at Torrecamps Marketing!</p>
    </div>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    {{-- <img src="{{ asset('upload/tmlogo.png') }}" width="50px">  --}}
                    <h1 class="text-start" style="text-align:center;">Torrecamps Marketing</h1>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #{{ $order->id }}</span> <br>
                    <span>Date: {{ Illuminate\Support\Carbon::now()->format('m/d/Y') }}</span> <br>
                    <span>Postal Code : {{ $order->zip_code }}</span> <br>
                    <span>Address: #14 San Vicente Ferrer St., SAV-1, Sucat, Parañaque City, Metro Manila</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $order->id }}</td>

                <td>Full Name:</td>
                <td>{{ $order->name }}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>{{ $order->tracking_no }}</td>

                <td>Email Id:</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ $order->created_at->format('m/d/Y') }}</td>

                <td>Phone:</td>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>{{ $order->payment_mode }}</td>

                <td>Address:</td>
                <td>{{ $order->address1 }}, {{ $order->address2 }}, {{ $order->city }}, {{ $order->province }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>{{ $order->status_message }}</td>

                <td>Postal Code:</td>
                <td>{{ $order->zip_code }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Unit</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
            @endphp
            @foreach ($order->orderItems as $item)
                <tr class="text-center">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product->unit->unit_name }}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                        {{ Str::currency($item->price) }}</td>
                    <td class="fw-bold"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                        {{ Str::currency($item->total_price) }}</td>
                    @php
                        $totalAmount += $item->total_price;
                        $grandTotal = $totalAmount + $order->del_fee;
                        $vat = $totalAmount * 0.12;
                        $without_vat = $totalAmount - $totalAmount * 0.12;
                    @endphp
                </tr>
            @endforeach
            <tr>
                <td colspan="5" class="total-heading">Without VAT: </td>
                <td colspan="1" class="total-heading text-center"><span
                        style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($without_vat) }}
                </td>
            </tr>
            <tr>
                <td colspan="5" class="total-heading">VAT 12%: </td>
                <td colspan="1" class="total-heading text-center"><span
                        style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($vat) }} </td>
            </tr>
            <tr>
                <td colspan="5" class="total-heading">Delivery Fee: </td>
                <td colspan="1" class="total-heading text-center"><span
                        style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                    {{ Str::currency($order->del_fee) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="total-heading">Total Amount: </td>
                <td colspan="1" class="total-heading text-center"><span
                        style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($grandTotal) }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping at Torrecamps Marketing
    </p>

</body>

</html>
