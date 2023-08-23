@extends('layouts.admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('user') }}" class="btn btn-danger text-white" style="float:right;">Back</a>
                            <h4 class="card-title">Add User 
                            </h4> <br>

                            <form method="post" action="{{ route('user.store') }}" id="myForm">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="name" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="email" class="form-control" type="email">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="password" class="form-control" type="password">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10 form-group">
                                        <select name="role_as" class="form-control" id="">
                                            <option value="" disabled>Select Role</option>
                                            <option value="0">User</option>
                                            <option value="2">Employee</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add User">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    unit_name: {
                        required : true,
                    }, 
                },
                messages :{
                    unit_name: {
                        required : 'Please Enter A Unit',
                    },
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
        
    </script>


@endsection
