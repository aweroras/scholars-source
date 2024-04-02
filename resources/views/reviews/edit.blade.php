@extends('customer.layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Review</h1>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <div class="card-body">
                <h2 class="card-title">Product: {{ $product->name }}</h2>
                <h2>Order: #{{ $order->id }}</h2>
            </div>
        </div>
        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Rate</label>
                <input type="text" class="form-control" id="rate" name="rate" value="{{ $review->rate }}" required>
            </div>

            <div class="form-group">
                <label for="comment">Comment: </label>
                <input type="text" class="form-control" name="comment" value="{{$review->comment}}"required>
            </div>

            <div class="form-group">
                <label for="image">Images: </label>
                <input type="file" class="form-control-file" name="image" value="{{$review->image}}" required>
            </div>
            <input type="hidden" name="product" value="{{ $product->id }}">
            <input type="hidden" name="customer" value="{{ auth()->user()->customer->id }}">
            <input type="hidden" name="order" value="{{ $order->id }}">
            <button type="submit" class="btn btn-primary">Update Review</button>
        </form>
    </div>
@endsection
