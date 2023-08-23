@extends('layouts.admin')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Slider </h4>

                            <form method="post" action="{{ route('slider.update') }}" enctype="multipart/form-data"
                                id="myForm">
                                @csrf

                                <input type="hidden" name="id" value="{{ $slider->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Slider Title</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="slider_title" value="{{$slider->slider_title}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Slider
                                        Description</label>
                                    <div class="col-sm-10 form-group">
                                        <textarea name="slider_description" id="textarea" class="form-control" rows="3">{{$slider->slider_description}}</textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-select" aria-label="Default select example">
                                                <option value="0" {{ $slider->status == '0' ? 'selected':'' }}>Visible</option>
                                                <option value="1" {{ $slider->status == '1' ? 'selected':'' }}>Hidden</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Slider Image</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="slider_image" class="form-control" type="file" id="image">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10 form-group">
                                        <img id="showImage" width="200px" class="rounded avatar-lg"
                                            src="{{ asset($slider->slider_image) }}" alt="Card image cap">
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
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    slider_title: {
                        required: true,
                    },
                    slider_description: {
                        required: true,
                    },
                },
                messages: {
                    slider_title: {
                        required: 'Please Enter A Title',
                    },
                    slider_description: {
                        required: 'Please Enter A Description',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
