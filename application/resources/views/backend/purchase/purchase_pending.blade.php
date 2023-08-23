@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Pending Purchases</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-info btn-rounded btn-fw" style="float:right"
                                href="{{ route('purchase.add') }}">Add Purchase</a> <br>
                            <h4 class="card-title">All Pending Purchases Data </h4>

                            <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th>Purchase No.</th>
                                        <th>Date</th>
                                        <th>Supplier</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th width="10%">Action</th>

                                </thead>


                                <tbody>
                                    @php
                                        $totalAmount = 0;
                                    @endphp
                                    @foreach ($allData as $key => $item)
                                        @php
                                            $totalAmount = App\Models\Purchase::where('purchase_no', $item->id)->sum('buying_price');
                                        @endphp
                                        <tr class="text-center">
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->purchase_no }} </td>
                                            <td> {{ $item->date }} </td>
                                            <td> {{ $item->purchase->supplier->supplier_name }} </td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($totalAmount) }} </td>
                                            @if ($item->status == '0')
                                                <td> <span class="btn btn-warning">Pending</span> </td>
                                            @elseif ($item->status == '1')
                                                <td> <span class="btn btn-success">Approved</span> </td>
                                            @endif
                                            <td>
                                                @if ($item->status == '0')
                                                    <a href="{{ route('purchase.approval', $item->id) }}"
                                                        class="btn btn-info sm" title="Approved"> <i
                                                            class="fas fa-check-circle"></i>
                                                    </a>
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
