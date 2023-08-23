@extends('layouts.app')

@section('title', 'TM My Orders')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">My Completed Orders</h4>
                        <hr>

                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tracking No.</th>
                                        <th>Name</th>
                                        <th>Payment Mode</th>
                                        <th>Date Ordered</th>
                                        <th>Return</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($order as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->tracking_no }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->payment_mode }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if ($item->return_order == 0)
                                                    <span class="badge badge-warning">No Request</span>
                                                @elseif($item->return_order == 1)
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif($item->return_order == 2)
                                                    <span class="badge badge-success">Success</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->return_order == 0)
                                                    <a href="{{ url('request/return/' . $item->id) }}"
                                                        class="btn btn-sm btn-danger" id="return">Return</a>
                                                @elseif($item->return_order == 1)
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif($item->return_order == 2)
                                                    <span class="badge badge-success">Success</span>
                                                @endif

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Orders Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
