@extends('layouts.app')

@section('title', 'TM My Orders')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">My Orders</h4>
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
                                        <th>Status Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->tracking_no }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->payment_mode }}</td>
                                            <td>{{ $item->created_at->format('m/d/Y') }}</td>
                                            <td>{{ $item->status_message }}</td>
                                            <td><a href="{{ url('orders/' . $item->id) }}"
                                                    class="btn btn-primary btn-sm">View</a>
                                                @if ($item->status_message == 'in progress')
                                                    <form action="{{ url('orders/cancel/' . $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" name="order_status" value="cancelled" class="btn btn-danger btn-sm">Cancel</button>
                                                    </form>
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
