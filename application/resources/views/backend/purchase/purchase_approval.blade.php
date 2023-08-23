@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Approve Purchase</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Purchase No.: #{{ $purchase->purchase_no }} -
                                {{ date('M' . ' ' . 'd' . ', ' . 'Y', strtotime($purchase->date)) }}</h4>
                            <a class="btn btn-info btn-rounded btn-fw" style="float:right"
                                href="{{ route('purchase.pending') }}"><i class="fa fa-list"></i> Pending Purchase</a> <br>


                            <table class="table table-dark" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>Supplier Info</p>
                                        </td>
                                        <td>
                                            <p>Name:
                                                <strong>{{ $purchase['purchase']['supplier']['supplier_name'] }}</strong>
                                            </p>
                                        </td>
                                        <td>
                                            <p>Email:
                                                <strong>{{ $purchase['purchase']['supplier']['supplier_email'] }}</strong>
                                            </p>
                                        </td>
                                        <td>
                                            <p>Contact No.:
                                                <strong>{{ $purchase['purchase']['supplier']['supplier_phone'] }}</strong>
                                            </p>
                                        </td>
                                        <td>
                                            <p>Address:
                                                <strong>{{ $purchase['purchase']['supplier']['supplier_address1'] }},
                                                    {{ $purchase['purchase']['supplier']['supplier_address2'] }},
                                                    {{ $purchase['purchase']['supplier']['supplier_city'] }},
                                                    {{ $purchase['purchase']['supplier']['supplier_province'] }},
                                                    {{ $purchase['purchase']['supplier']['supplier_zipcode'] }},
                                                </strong>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <form method="post" action="{{ route('purchase.approve', $purchase->id) }}">
                                @csrf

                                <table class="table table-dark" width="100%" border="1">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Sl</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Product</th>
                                            <th>Current Stock</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>

                                    @php
                                        $totalAmount = '0';
                                    @endphp

                                    <tbody>
                                        @foreach ($purchase['purchase_details'] as $key => $details)
                                            @php
                                                $totalAmount += $details->buying_price;
                                            @endphp
                                            <tr class="text-center">

                                                <input type="hidden" name="supplier_id[]"
                                                    value="{{ $details->supplier_id }}">
                                                <input type="hidden" name="category_id[]"
                                                    value="{{ $details->category_id }}">
                                                <input type="hidden" name="product_id[]"
                                                    value="{{ $details->product_id }}">
                                                <input type="hidden" name="brand_id[]" value="{{ $details->brand_id }}">
                                                <input type="hidden" name="buying_qty[{{ $details->id }}]"
                                                    value="{{ $details->buying_qty }}">

                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $details['category']['category_name'] }}</td>
                                                <td>{{ $details['brand']['brand_name'] }}</td>
                                                <td>{{ $details['product']['product_name'] }}</td>
                                                <td>{{ $details['product']['quantity'] }}</td>
                                                <td>{{ $details->buying_qty }}</td>
                                                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                    {{ Str::currency($details->unit_price) }}</td>
                                                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                    {{ Str::currency($details->buying_price) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="7">Total Amount</td>
                                            <td class="text-center"><span
                                                    style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($totalAmount) }}</td>
                                        </tr>
                                    </tbody>

                                </table> <br>
                                @if ($purchase->status != '1')
                                    <button type="submit" class="btn btn-info">Approve Purchase</button>
                                @endif
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
