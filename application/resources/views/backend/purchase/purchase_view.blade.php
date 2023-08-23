@extends('layouts.admin')
@section('admin')
    <div id="printMe" class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Purchase Order</h4>

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

                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">

                                        <h3>
                                            <img src="{{ asset('upload/tmlogo.png') }}" alt="logo" height="24" />
                                            {{ $appSetting->company_name }}
                                        </h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-6 mt-4">
                                            <strong>
                                                <h4 class="fw-bold">From:</h4>
                                            </strong>
                                            <address>
                                                <strong>{{ $appSetting->company_name }}:</strong><br>
                                                {{ $appSetting->company_phone }}<br>
                                                {{ $appSetting->company_address }}<br>
                                                {{ $appSetting->company_email }}
                                            </address>
                                        </div>
                                        <div class="col-6 mt-4">
                                            <strong>
                                                <h4 class="fw-bold">Supplier:</h4>
                                            </strong>
                                            <address>
                                                <strong>{{ $purchase['purchase']['supplier']['supplier_name'] }}:</strong><br>
                                                {{ $purchase['purchase']['supplier']['supplier_phone'] }}<br>
                                                {{ $purchase['purchase']['supplier']['supplier_address1'] }},
                                                {{ $purchase['purchase']['supplier']['supplier_address2'] }},
                                                {{ $purchase['purchase']['supplier']['supplier_city'] }},
                                                {{ $purchase['purchase']['supplier']['supplier_province'] }},
                                                {{ $purchase['purchase']['supplier']['supplier_zipcode'] }}<br>
                                                {{ $purchase['purchase']['supplier']['supplier_email'] }}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <table class="table table-striped" width="100%" border="1">
                                <thead>
                                    <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Brand</th>
                                        <th>Product</th>
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

                                            <input type="hidden" name="date" value="{{ $details->date }}">
                                            <input type="hidden" name="supplier_id[]" value="{{ $details->supplier_id }}">
                                            <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                                            <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                                            <input type="hidden" name="brand_id[]" value="{{ $details->brand_id }}">
                                            <input type="hidden" name="buying_qty[{{ $details->id }}]"
                                                value="{{ $details->buying_qty }}">

                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $details['brand']['brand_name'] }}</td>
                                            <td>{{ $details['product']['product_name'] }}</td>
                                            <td>{{ $details->buying_qty }}</td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($details->unit_price) }}</td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($details->buying_price) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">Total Amount</td>
                                        <td class="text-center"><span
                                                style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                            {{ Str::currency($totalAmount) }}</td>
                                    </tr>
                                </tbody>

                            </table> <br>


                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
    <div class="d-print-none">
        <div class="float-end">
            <button onclick="printDiv('printMe')" class="btn btn-success waves-effect waves-light"><i
                    class="fa fa-print"></i></button>
                    <a href="{{ route('purchase.reorder', $purchase->id) }}">Re Order</a>
        </div>
    </div>
@endsection
