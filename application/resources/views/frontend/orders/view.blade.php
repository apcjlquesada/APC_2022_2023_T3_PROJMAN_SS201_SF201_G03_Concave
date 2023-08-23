@extends('layouts.app')

@section('title', 'TM My Order Details')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">

                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                            <a href="{{ route('user.orders') }}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Details</h5>
                                <hr>
                                <h6>Order ID: {{ $order->id }}</h6>
                                <h6>Tracking No.: {{ $order->tracking_no }}</h6>
                                <h6>Order Created: {{ $order->created_at->format('m/d/Y') }}</h6>
                                <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                                <h6 class="border p-2 text-success">
                                    Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Details</h5>
                                <hr>
                                <h6>Name: {{ $order->name }}</h6>
                                <h6>Email: {{ $order->email }}</h6>
                                <h6>Phone Number: {{ $order->phone }}</h6>
                                <h6>
                                    Full Address: {{ $order->address1 }}, {{ $order->address2 }},
                                    {{ $order->city }}, {{ $order->province }}
                                </h6>
                                <h6>Postal Code: {{ $order->zip_code }}</h6>

                            </div>
                        </div>
                        <br>
                        <h5>Order Items</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr class="text-center">
                                        <th width="8%">Item ID</th>
                                        <th width="5%">Unit</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th width="10%">Quantity</th>
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
                                            <td>
                                                @if ($item->product)
                                                    <img src="{{ asset($item->product->product_image) }}" width="50px"
                                                        alt="">
                                                @else
                                                    <img src="{{ asset('upload/no_image.jpg') }}" class="w-100"
                                                        alt="Img">
                                                @endif
                                            </td>
                                            <td>{{ $item->product->product_name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($item->price) }}</td>
                                            <td class="fw-bold"><span
                                                    style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($item->total_price) }}</td>
                                            @php
                                                $totalAmount += $item->total_price;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="fw-bold">Total Amount: </td>
                                        <td class="text-center fw-bold"><span
                                                style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                            {{ Str::currency($totalAmount) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
