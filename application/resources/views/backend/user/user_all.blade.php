@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Users</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-info btn-rounded btn-fw" style="float:right"
                                href="{{ route('user.add') }}">Add User</a> <br>
                            <h4 class="card-title">All Users Data </h4>

                            <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="10%">ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>is Verified?</th>
                                        <th width="20%">Action</th>

                                </thead>

                                <tbody>
                                    @forelse ($users as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->role_as == '1')
                                                    <a href="{{ route('user.edit.user', $item->id) }}"><span
                                                            class="btn btn-success">Admin</span></a>
                                                @elseif ($item->role_as == '2')
                                                    <a href="{{ route('user.edit.user', $item->id) }}"><span
                                                            class="btn btn-warning">Employee</span></a>
                                                @else
                                                    <a href="{{ route('user.edit', $item->id) }}"><span
                                                            class="btn btn-primary">User</span></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->email_verified_at != null)
                                                    <span class="btn btn-success">Yes</span>
                                                @else
                                                    <span class="btn btn-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('user.delete', $item->id) }}" class="btn btn-danger sm"
                                                    title="Delete Data" id="delete"> <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No Users Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
