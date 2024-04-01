@extends('customer.layouts.app')
  
@section('title', 'Add Review')
  
@section('content')
@include('messages')

<body>
<div class="container mt-4">
    <div class="container">
    <h1>Add Review</h1>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <div class="card-body">
                <h2 class="card-title">Product: {{ $product->name }}</h2>
                <h2>Order: #{{ $order->id }}</h2>
            </div>
        </div>
        <form action="{{ route('reviews.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
              @method('post')
            <div class="form-group">
                <label for="rate">Rate: </label>
                <input type="text" class="form-control" name="rate" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment: </label>
                <input type="text" class="form-control" name="comment" required>
            </div>
            <div class="form-group">
                <label for="image">Images: </label>
                <input type="file" class="form-control-file" name="image" required>
            </div>
            <input type="hidden" name="product" value="{{ $product->id }}">
            <input type="hidden" name="customer" value="{{ auth()->user()->customer->id }}">
            <input type="hidden" name="order" value="{{ $order->id }}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</body>
@endsection
