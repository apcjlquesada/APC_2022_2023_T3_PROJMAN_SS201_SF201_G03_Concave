@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Footer</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Footer Data </h4>

                            <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Company Address</th>
                                        <th>Company Phone No.</th>
                                        <th>Company Email</th>
                                        <th>Company Facebook</th>
                                        <th width="20%">Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($footer as $item)
                                        <tr class="text-center">
                                            <td> {{ $item->company_name }} </td>
                                            <td> {{ $item->company_address }} </td>
                                            <td> {{ $item->company_phone }} </td>
                                            <td> {{ $item->company_email }} </td>
                                            <td> {{ $item->company_facebook }} </td>
                                            <td>
                                                <a href="{{ route('footer.add', $item->id) }}" class="btn btn-info sm" title="Edit Data"> <i
                                                        class="far fa-edit"></i>
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
