@extends('user.layouts.app')

@section('content')
<div class="container mt-5">
    <h1>{{ $product->name }}</h1>
    <p>Product ID: {{ $product->id }}</p>
    <p>Price: ₱ {{ $product->price }}</p>
    <p>Category: {{ $product->category }}</p>
    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="300" height="300">
    
</div>
@endsection
