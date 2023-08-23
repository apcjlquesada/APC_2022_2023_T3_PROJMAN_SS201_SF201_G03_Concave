@extends('layouts.admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Supplier </h4>

                            <form method="post" action="{{ route('supplier.update') }}" id="myForm">
                                @csrf

                                <input type="hidden" name="id" value="{{ $supplier->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="supplier_name" value="{{ $supplier->supplier_name }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Mobile No.</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="supplier_phone" value="{{ $supplier->supplier_phone }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Email</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="supplier_email" value="{{ $supplier->supplier_email }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address Line 1</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="supplier_address1" value="{{ $supplier->supplier_address1 }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address Line 2</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="supplier_address2" value="{{ $supplier->supplier_address2 }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="supplier_city" value="{{ $supplier->supplier_city }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Province</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="supplier_province" value="{{ $supplier->supplier_province }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Postal Code</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="supplier_zipcode" value="{{ $supplier->supplier_zipcode }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update">
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
                    supplier_name: {
                        required : true,
                    }, 
                    supplier_phone: {
                        required : true,
                    }, 
                    supplier_email: {
                        required : true,
                    }, 
                    supplier_address1: {
                        required : true,
                    }, 
                    supplier_city: {
                        required : true,
                    }, 
                    supplier_province: {
                        required : true,
                    }, 
                    supplier_zipcode: {
                        required : true,
                    }, 
                },
                messages :{
                    supplier_name: {
                        required : 'Please Enter Supplier Name',
                    },
                    supplier_phone: {
                        required : 'Please Enter Supplier Mobile No.',
                    },
                    supplier_email: {
                        required : 'Please Enter Supplier Email',
                    },
                    supplier_address1: {
                        required : 'Please Enter Supplier Address Line 1',
                    },
                    supplier_city: {
                        required : 'Please Enter Supplier City',
                    },
                    supplier_province: {
                        required : 'Please Enter Supplier Province',
                    },
                    supplier_zipcode: {
                        required : 'Please Enter Supplier Postal Code',
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
