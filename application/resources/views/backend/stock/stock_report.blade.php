@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Stocks</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-info btn-rounded btn-fw" style="float:right"
                                href="{{ route('stock.report.pdf') }}" target="_blank"> <i class="fa fa-print"></i> Stock
                                Print</a> <br>
                            <h4 class="card-title">All Stocks Data </h4>

                            <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th>Supplier</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Unit</th>
                                        <th>Product Name</th>
                                        <th>In</th>
                                        <th>Out</th>
                                        <th>Stock</th>
                                </thead>


                                <tbody>



                                    @foreach ($allData as $key => $item)
                                        @php
                                            $in = App\Models\Purchase::where('category_id', $item->category_id)
                                                ->where('product_id', $item->id)
                                                ->where('status', '1')
                                                ->sum('buying_qty');
                                            
                                            $out = $in - $item->quantity;
                                        @endphp
                                        <tr class="text-center">
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item['supplier']['supplier_name'] }} </td>
                                            <td> {{ $item['category']['category_name'] }} </td>
                                            <td> {{ $item['brand']['brand_name'] }} </td>
                                            <td> {{ $item['unit']['unit_name'] }} </td>
                                            <td> {{ $item->product_name }} </td>
                                            <td> <span class="btn btn-success"> {{ $in }} </span></td>
                                            <td> <span class="btn btn-danger"> {{ $out }} </span></td>
                                            <td>
                                                @if ($item->to_reorder > $item->quantity && $item->quantity != 0)
                                                    <span class="btn btn-warning">{{ $item->quantity }}</span>
                                                @elseif ($item->quantity == 0)
                                                    <span class="btn btn-danger">{{ $item->quantity }}</span>
                                                @else
                                                    <span class="btn btn-success">{{ $item->quantity }}</span>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
