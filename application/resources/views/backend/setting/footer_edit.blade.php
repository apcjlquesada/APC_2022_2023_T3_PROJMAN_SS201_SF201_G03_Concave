@extends('layouts.admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Unit </h4>

                            <form method="post" action="{{ route('footer.store') }}" id="myForm">
                                @csrf

                                <input type="hidden" name="id" value="{{ $footers->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Company Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="company_name" value="{{$footers->company_name}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Company Description</label>
                                    <div class="col-sm-10 form-group">
                                        <textarea name="company_description" class="form-control" rows="4">{{$footers->company_description}}</textarea>
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Company Address</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="company_address" value="{{$footers->company_address}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Company Phone No.</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="company_phone" value="{{$footers->company_phone}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Company Email</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="company_email" value="{{$footers->company_email}}" class="form-control" type="email">
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Company Facebook URL</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="company_facebook" value="{{$footers->company_facebook}}" class="form-control" type="text">
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
