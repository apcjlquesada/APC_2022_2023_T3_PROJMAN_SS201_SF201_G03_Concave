@extends('layouts.app')

@section('title', 'TM Profile')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>User Profile

                        <a href="{{ route('change.password') }}" class="btn btn-warning float-end">Change Password</a>

                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                    <div class="col-md-10">
                        <div class="card shadow">
                            <div class="card-header bg-primary">
                                <h4 class="mb-0 text-white">User Details</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Email</label>
                                                <input type="email" name="email" readonly value="{{ Auth::user()->email }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Phone</label>
                                                <input type="text" name="phone" value="{{ Auth::user()->userDetail->phone ?? '' }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Address Line 1</label>
                                                <input type="text" name="address1" value="{{ Auth::user()->userDetail->address1 ?? '' }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Address Line 2</label>
                                                <input type="text" name="address2" value="{{ Auth::user()->userDetail->address2 ?? '' }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">City</label>
                                                <input type="text" name="city" value="{{ Auth::user()->userDetail->city ?? '' }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Province</label>
                                                <input type="text" name="province" value="{{ Auth::user()->userDetail->province ?? '' }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Postal Code</label>
                                                <input type="text" name="zip_code" value="{{ Auth::user()->userDetail->zip_code ?? '' }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Save Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection