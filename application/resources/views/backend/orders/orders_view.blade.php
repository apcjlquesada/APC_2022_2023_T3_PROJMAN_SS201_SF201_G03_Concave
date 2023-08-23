@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Order Details</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="shadow bg-white p-3">

                <h4 class="text-primary">
                    <i class="fa fa-shopping-cart text-dark"></i> Order Details
                    <a href="{{ route('orders') }}" class="btn btn-danger btn-sm float-end mx-1">Back</a>
                    <a href="{{ url('admin/invoice/' . $order->id . '/generate') }}"
                        class="btn btn-primary btn-sm float-end mx-1">Download Invoice</a>
                    <a href="{{ url('admin/invoice/' . $order->id) }}" target="_blank"
                        class="btn btn-warning btn-sm float-end mx-1">View Invoice</a>
                    <a href="{{ url('admin/invoice/' . $order->id . '/mail') }}"
                        class="btn btn-info btn-sm float-end mx-1">Send
                        Invoice</a>
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
                                            <img src="{{ asset('upload/no_image.jpg') }}" class="w-100" alt="Img">
                                        @endif
                                    </td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                        {{ Str::currency($item->price) }}</td>
                                    <td class="fw-bold"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                        {{ Str::currency($item->total_price) }}</td>

                                    @php
                                        $totalAmount += $item->total_price;
                                    @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" class="fw-bold">Total Amount: </td>
                                <td class="text-center fw-bold"><span
                                        style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($totalAmount) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow mt-3">
                <div class="card-body">
                    <h4>Order Process</h4>
                    <hr>

                    <div class="row">

                    </div>


                    <div class="row">
                        @if ($order->status_message == 'cancelled')
                            <div class="col-md-5" style="display:none">
                                <form action="{{ url('admin/orders/' . $order->id) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <label for="">Update Status</label>
                                    <div class="input-group">
                                        <select name="order_status" class="form-select" id="">
                                            <option value="" disabled>Select Order Status</option>
                                            <option value="in progress"
                                                {{ Request::get('order_status') == 'in progress' ? 'selected' : '' }}>In
                                                Progress
                                            </option>
                                            <option value="out for delivery"
                                                {{ Request::get('order_status') == 'out for delivery' ? 'selected' : '' }}>
                                                Out for
                                                Delivery</option>
                                            <option value="completed"
                                                {{ Request::get('order_status') == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="cancelled"
                                                {{ Request::get('order_status') == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary text-white">Update</button>
                                    </div>

                                </form>
                            </div>
                        @elseif ($order->status_message == 'completed')
                            <div class="col-md-5" style="display:none">
                                <form action="{{ url('admin/orders/' . $order->id) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <label for="">Update Status</label>
                                    <div class="input-group">
                                        <select name="order_status" class="form-select" id="">
                                            <option value="" disabled>Select Order Status</option>
                                            <option value="in progress"
                                                {{ Request::get('order_status') == 'in progress' ? 'selected' : '' }}>In
                                                Progress
                                            </option>
                                            <option value="out for delivery"
                                                {{ Request::get('order_status') == 'out for delivery' ? 'selected' : '' }}>
                                                Out for
                                                Delivery</option>
                                            <option value="completed"
                                                {{ Request::get('order_status') == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="cancelled"
                                                {{ Request::get('order_status') == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary text-white">Update</button>
                                    </div>

                                </form>
                            </div>
                        @else
                            <div class="col-md-5">

                                <form action="{{ url('admin/orders/' . $order->id) }}" method="post">
                                    @csrf
                                    @method('PUT')


                                    <div class="col-md-5">
                                        <label for="">Delivery Fee</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $order->del_fee ?? '' }}"
                                                name="del_fee">
                                        </div>
                                    </div>




                                    <label for="">Update Status</label>
                                    <div class="input-group">
                                        <select name="order_status" class="form-select" id="">
                                            <option value="" disabled>Select Order Status</option>
                                            <option value="in progress"
                                                {{ Request::get('order_status') == 'in progress' ? 'selected' : '' }}>In
                                                Progress
                                            </option>
                                            <option value="out for delivery"
                                                {{ Request::get('order_status') == 'out for delivery' ? 'selected' : '' }}>
                                                Out for
                                                Delivery</option>
                                            <option value="completed"
                                                {{ Request::get('order_status') == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="cancelled"
                                                {{ Request::get('order_status') == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary text-white">Update</button>
                                    </div>

                                </form>
                            </div>
                        @endif

                        <div class="col-md-7">
                            <br>
                            <h4 class="mt-3">Order Status:
                                @if ($order->status_message == 'cancelled')
                                    <span class="text-uppercase text-danger">{{ $order->status_message }}</span>
                                @else
                                    <span class="text-uppercase text-success">{{ $order->status_message }}</span>
                                @endif
                            </h4>
                            <br>
                            @if ($order->del_fee != null)
                                <h4>Delivery Fee:
                                    <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span><span
                                        class="text-uppercase text-success"> {{ Str::currency($order->del_fee) }}</span>
                                </h4>
                            @else
                                <h4>Delivery Fee:
                                    <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span><span
                                        class="text-uppercase text-success"> 0</span>
                                </h4>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection
