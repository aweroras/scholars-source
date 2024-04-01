@extends('layouts.products')

@section('content')
    <div class="container mt-5" style="height: 100vh; overflow-y: auto;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="background-color: #f5f5f5; border-radius: 10px; padding: 20px;">
                    <div class="row">
                        <div class="col-md-5">
                            <div id="productCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach (explode(',', $product->image) as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image) }}" class="d-block w-100" alt="Product Image">
                                        </div>
                                    @endforeach
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
                        <div class="col-md-7 align-self-center">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">Price: ₱{{ $product->price }}</p>
                                <a href="{{ Auth::check() ? route('cart.add', $product->id) : route('login') }}" class="btn btn-sm btn-primary" style="padding: 5px 10px; font-size: 12px; border-radius: 4px;">
                                @if(Auth::check())
                                    <i class="fas fa-shopping-cart mr-1"></i> Add to Cart
                                @else
                                    <i class="fas fa-shopping-cart mr-1"></i> Add to Cart
                                @endif
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
