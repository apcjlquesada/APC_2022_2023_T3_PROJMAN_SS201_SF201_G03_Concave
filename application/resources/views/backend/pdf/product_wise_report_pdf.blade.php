@extends('layouts.admin')
@section('admin')
    <div id="printMe" class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product Wise Stock Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                                <li class="breadcrumb-item active">Product Wise Stock Report</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

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
                                            <address>
                                                <strong>{{ $appSetting->company_name }}:</strong><br>
                                                {{ $appSetting->company_address }}<br>
                                                {{ $appSetting->company_email }}
                                            </address>
                                        </div>
                                        <div class="col-6 mt-4 text-end">
                                            <address>

                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">

                                        </div>

                                    </div>

                                </div>
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">

                                        </div>
                                        <div class="">
                                            <div class="table-responsive">

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center"><strong>Supplier </strong>
                                                            </td>
                                                            <td class="text-center"><strong>Category </strong>
                                                            </td>
                                                            <td class="text-center"><strong>Brand</strong>
                                                            </td>
                                                            <td class="text-center"><strong>Unit</strong>
                                                            </td>
                                                            <td class="text-center"><strong>Product Name </strong>
                                                            </td>
                                                            <td class="text-center"><strong>Stock </strong>
                                                            </td>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->

                                                            <tr class="text-center">
                                                                <td> {{ $product['supplier']['supplier_name'] }} </td>
                                                                <td> {{ $product['category']['category_name'] }} </td>
                                                                <td> {{ $product['brand']['brand_name'] }} </td>
                                                                <td> {{ $product['unit']['unit_name'] }} </td>
                                                                <td> {{ $product->product_name }} </td>
                                                                <td> {{ $product->quantity }} </td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            @php
                                                $date = new DateTime('now', new DateTimeZone('Asia/Manila'));
                                            @endphp
                                            <i>Printing Time : {{ $date->format('F j, Y, g:i a') }}</i>


                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->
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
        </div>
    </div>
@endsection
