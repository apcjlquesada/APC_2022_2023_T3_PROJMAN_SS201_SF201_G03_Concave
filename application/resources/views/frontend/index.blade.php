@extends('layouts.app')
@section('title', 'eTorrcamps Home')

@section('content')

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

        <div class="carousel-inner">

            @foreach ($sliders as $key => $item)
                <div class="carousel-item {{ $key == '0' ? 'active':'' }}">
                    @if ($item->slider_image)
                        <img src="{{ asset($item->slider_image) }}" class="d-block w-100" style="width:1200px; height:400px;" alt="...">
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $item->slider_title }}</h5>
                        <p>{{ $item->slider_description }}</p>
                    </div>
                </div>
            @endforeach
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    @endsection
