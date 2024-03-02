@extends('user.layouts.product')

@section('content')
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <div id="imageSlider" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                $images = explode(',', $product->image);
                            @endphp
                            @foreach($images as $index => $image)
                                <div class="carousel-item @if($index === 0) active @endif">
                                    <img src="{{ asset($image) }}" class="d-block w-100" alt="Product Image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">₱{{ $product->price }}</h1>
                    <div class="fs-5 mb-5">
                        <span>{{ $product->name }}</span>
                    </div>
                    <p class="lead">Disclaimer: Photos May Differ From Actual Appearance Of Products.</p>
                    <!-- Add to cart form -->
                    <form action="{{ route('user.addToCart', ['id' => $product->id]) }}" method="post">
                        @csrf
                        @method('POST') <!-- Add this line to specify the method -->
                        <div class="d-flex">
                            <input class="form-control text-center me-3" name="quantity" type="number" value="1" style="max-width: 3rem" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Related products section -->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            @php
                                // Explode the 'image' string into an array and get the first image path
                                $images = explode(',', $relatedProduct->image);
                                $firstImagePath = isset($images[0]) ? $images[0] : null;
                            @endphp
                            <img class="card-img-top" src="{{ asset($firstImagePath) }}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $relatedProduct->name }}</h5>
                                    <!-- Product price-->
                                    ₱{{ $relatedProduct->price }}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('user.product', ['id' => $relatedProduct->id]) }}">View details</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
