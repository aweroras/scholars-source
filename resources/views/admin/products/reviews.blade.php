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
            @if($review->image)
                <img src="{{ $review->image }}" alt="Review image">
            @endif
        </div>
    </div>
@endforeach
    @else
        <p>No reviews yet.</p>
    @endif
</div>
@endsection