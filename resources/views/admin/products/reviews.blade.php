@extends('customer.layouts.shop')

@section('content')
<div class="container">
    <h1>Reviews for {{ $product->name }}</h1>

    @if(count($reviews) > 0)
    @foreach($reviews as $review)
    <div class="card mb-4">
        <div class="card-body">

            <p class="card-text">{{ $review->comment }}</p>
            <p>Rating: {{ $review->rate }}</p>
            @foreach(explode(',', $review->image) as $imagePath)
                <img src="{{ asset(trim($imagePath)) }}" alt="{{ $review->name }}" width="150" height="150">
            @endforeach
        </div>
    </div>
@endforeach
    @else
        <p>No reviews yet.</p>
    @endif
</div>
@endsection