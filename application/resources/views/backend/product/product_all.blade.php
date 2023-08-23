@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Products</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-info btn-rounded btn-fw" style="float:right" href="{{ route('product.add') }}">Add Product</a> <br>
                            <h4 class="card-title">All Products Data </h4>

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
                                        <th>Selling Price</th>
                                        <th>Product Slug</th>
                                        <th>Product Image</th>
                                        <th width="10%">Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($products as $key => $item)
                                        <tr class="text-center">
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item['supplier']['supplier_name'] }} </td>
                                            <td> {{ $item['category']['category_name'] }} </td>
                                            <td> {{ $item['brand']['brand_name'] }} </td>
                                            <td> {{ $item['unit']['unit_name'] }} </td>
                                            <td> {{ $item->product_name }} </td>
                                            <td> <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($item->selling_price) }} </td>
                                            <td> {{ $item->product_slug }} </td>
                                            <td> <img src="{{ asset($item->product_image) }}" style="width: 120px; height:120px;"> </td>
                                            <td>
                                                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info sm" title="Edit Data"> <i
                                                        class="far fa-edit"></i>
                                                </a>

                                                <a href="{{ route('product.delete', $item->id) }}" class="btn btn-danger sm" title="Delete Data"
                                                    id="delete"> <i class="far fa-trash-alt"></i> </a>

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
