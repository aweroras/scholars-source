@extends('user.layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Search Results for '{{ $query }}'</h2>

        @if($products->isEmpty())
            <p>No results found.</p>
        @else
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Wrap the image with an anchor tag -->
                            <a href="{{ route('user.product', ['id' => $product->id]) }}">
                                @php
                                    // Explode the 'image' string into an array and get the first image path
                                    $images = explode(',', $product->image);
                                    $firstImagePath = isset($images[0]) ? $images[0] : null;
                                @endphp
                                <img class="card-img-top" src="{{ asset($firstImagePath) }}" alt="..." />
                            </a>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    <h6 style="font-weight: normal;">Price: ₱{{ $product->price }}</h6>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('user.addToCart', ['id' => $product->id]) }}">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
