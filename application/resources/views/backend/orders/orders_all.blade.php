@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Orders</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Orders Data </h4>

                            <form action="{{ route('filter.order') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Start Date:</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">End Date:</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                    <div class="col-md-1 pt-4">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form> <br>

                            <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="10%">Order ID</th>
                                        <th>Tracking No.</th>
                                        <th>Name</th>
                                        <th>Payment Mode</th>
                                        <th>Ordered Date</th>
                                        <th>Amount</th>
                                        <th>Status Message</th>
                                        <th width="20%">Action</th>

                                </thead>

                                <tbody>



                                    @forelse ($orders as $item)
                                        @php
                                            $orderItem = App\Models\OrderItem::where('order_id', $item->id)->sum('total_price');
                                        @endphp
                                        <tr class="text-center">
                                            <td> {{ $item->id }} </td>
                                            <td> {{ $item->tracking_no }} </td>
                                            <td> {{ $item->name }} </td>
                                            <td> {{ $item->payment_mode }} </td>
                                            <td> {{ $item->created_at->format('m/d/Y') }} </td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($orderItem) }} </td>
                                            <td> {{ $item->status_message }} </td>
                                            <td><a href="{{ url('admin/orders/' . $item->id) }}"
                                                    class="btn btn-primary btn-sm">View</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">No Orders Available</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
