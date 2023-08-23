@extends('layouts.app')

@section('title')
    TM {{ $product->product_name }}
@endsection

@section('content')
    <div>
        <livewire:frontend.product.view :category="$category" :product="$product" />
    </div>
@endsection
