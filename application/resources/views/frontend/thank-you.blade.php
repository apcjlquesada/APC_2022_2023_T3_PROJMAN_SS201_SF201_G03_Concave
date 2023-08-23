@extends('layouts.app')

@section('title', 'Thank You for Shopping!')

@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="p-4 shadow bg-white">
                    <img src="{{ asset('upload/tmlogo.png') }}" width="300px" alt="">
                    <h2 style="font-weight: bold">Thank You for Shopping at Torrecamps!</h2>
                    <a href="{{ route('categories') }}" class="btn btn-primary">Shop Now!</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
