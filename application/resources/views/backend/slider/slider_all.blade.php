@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Sliders</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-info btn-rounded btn-fw" style="float:right"
                                href="{{ route('slider.add') }}">Add Slider</a> <br>
                            <h4 class="card-title">All Sliders Data </h4>

                            <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="10%">Sl</th>
                                        <th>Slider Title</th>
                                        <th>Description</th>
                                        <th>Slider Image</th>
                                        <th>Status</th>
                                        <th width="20%">Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($sliders as $key => $item)
                                        <tr class="text-center">
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->slider_title }} </td>
                                            <td> {{ $item->slider_description }} </td>
                                            <td> <img src="{{ asset($item->slider_image) }}" style="width: 120px; height:120px;"> </td>
                                            @if ($item->status == '1')
                                                <td> <span class="btn btn-danger">Hidden</span> </td>
                                            @elseif ($item->status == '0')
                                                <td> <span class="btn btn-success">Visible</span> </td>
                                            @endif
                                            <td>
                                                <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-info sm"
                                                    title="Edit Data"> <i class="far fa-edit"></i>
                                                </a>

                                                <a href="{{ route('slider.delete', $item->id) }}" class="btn btn-danger sm"
                                                    title="Delete Data" id="delete"> <i class="far fa-trash-alt"></i>
                                                </a>

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
