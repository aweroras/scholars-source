@extends('customer.layouts.app')

@section('content')
    <!-- New Product Start -->
    <section class="new-product-area section-padding30">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-tittle mb-70">
                        <h2>New Arrivals to</h2>
                    </div>
                </div>

                @foreach($product as $products)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="single-new-pro mb-30 text-center">
                            @php
                                // Explode the 'image' string into an array
                                $images = explode(',', $products->image);
                            @endphp

                            @if(count($images) > 1)
                                <div id="carousel{{ $products->id }}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($images as $index => $image)
                                            <div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
                                                <img class="d-block w-100" src="{{ asset($image) }}" alt="Image {{ $index + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel{{ $products->id }}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel{{ $products->id }}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            @else
                                <img class="card-img-top" src="{{ asset($images[0]) }}" alt="..." />
                            @endif

                            <div class="product-caption">
                                <h3>{{ $products->name }}</h3>
                                <span>₱{{ $products->price }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- New Product End -->
@endsection
