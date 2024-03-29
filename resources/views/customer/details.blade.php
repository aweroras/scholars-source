@extends('customer.layouts.details')

@section('content')
<div class="container d-flex align-items-center justify-content-center vh-100 mt-5">
    <div class="row">
        <div class="col-md-6">
            <div id="productCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @if ($product->image)
                        @php
                            $images = explode(',', $product->image);
                        @endphp
                        @foreach($images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <a href="{{ route('customer.details', ['id' => $product->id]) }}">
                                    <img src="{{ asset($image) }}" alt="{{ $product->name }}" class="img-fluid" style="height: 400px; object-fit: cover;">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <h2>{{ $product->name }}</h2>
            <p>₱{{ $product->price }}</p>
            <p>{{ $product->description }}</p>
            
            <!-- Adjusted width and styles for the quantity input and Add to Cart button -->
            <form method="post" action="{{ route('customer.addToCart', ['id' => $product->id]) }}" class="d-flex">
                @csrf
                
                <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control" style="width: 50px; margin-right: 20px;">
                <button type="submit" class="btn btn-sm hero-btn" style="font-size: 10px; padding: 5px 10px;">Add to Cart</button>
            </form>
        </div>
    </div>
</div>

<!-- Similar products section -->
<div class="container mt-5">
    <h3>Similar Products</h3>
    <div class="row">
        @foreach($similarProducts as $similarProduct)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('customer.details', ['id' => $similarProduct->id]) }}">
                        @if ($similarProduct->image)
                            @php
                                $similarImages = explode(',', $similarProduct->image);
                            @endphp
                            <img src="{{ asset($similarImages[0]) }}" alt="{{ $similarProduct->name }}" class="card-img-top">
                        @endif
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $similarProduct->name }}</h5>
                        <p class="card-text">₱{{ $similarProduct->price }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    #productCarousel {
        margin: 0 auto;
    }

    #productCarousel .carousel-inner {
        text-align: center;
    }

    #productCarousel .carousel-item img {
        max-width: 100%; /* Set maximum width to 100% */
        height: auto;
    }

    #productCarousel .carousel-item {
        height: 400px; /* Set a fixed height for the carousel items */
    }

    #productCarousel .carousel-control-prev,
    #productCarousel .carousel-control-next {
        color: #000;
        opacity: 0.8;
    }

    #productCarousel .carousel-control-prev-icon,
    #productCarousel .carousel-control-next-icon {
        background-color: transparent;
    }

    .mt-5 {
        margin-top: 5rem; /* Adjust margin-top as needed */
    }
</style>
@endsection
