@extends('layouts.products')

@section('content')

@if(isset($searchQuery) && $searchQuery)
    <div class="row justify-content-center"> <!-- Centering the content -->
        <div class="col-xl-8" style="margin-left: -10px;"> <!-- Adjusting the column width -->
            <div class="section-tittle mb-4 mt-3"> <!-- Added ml-3 and mt-3 for left margin and top margin -->
                <h3 style="font-size: 20px;">Search Results for: "{{ $searchQuery }}"</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 mb-4 position-relative">
                    <div class="card h-100"> <!-- Added h-100 class to ensure all cards have the same height -->
                        <div id="productCarousel{{$product->id}}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach (explode(',', $product->image) as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image) }}" class="d-block w-100" alt="Product Image">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#productCarousel{{$product->id}}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#productCarousel{{$product->id}}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <a href="{{ route('product.details', $product->id) }}" class="btn btn-sm btn-primary text-center" style="font-size: 12px; padding: 11px 20px;">View</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    @foreach($groupedProducts as $category => $products)
        <section class="new-product-area section-padding30">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-tittle mb-70">
                            <h3>{{ $category }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4 position-relative">
                            <div class="card h-100"> <!-- Added h-100 class to ensure all cards have the same height -->
                                <div id="productCarousel{{$product->id}}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach (explode(',', $product->image) as $index => $image)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ asset($image) }}" class="d-block w-100" alt="Product Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#productCarousel{{$product->id}}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#productCarousel{{$product->id}}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <a href="{{ route('product.details', $product->id) }}" class="btn btn-sm btn-primary text-center" style="font-size: 12px; padding: 11px 20px;">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
@endif

<!-- Latest Products End -->

<!-- Modal for product image gallery -->
<div id="productGalleryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div id="productImageCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Images will be loaded dynamically here -->
                    </div>
                    <a class="carousel-control-prev" href="#productImageCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productImageCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(".product-gallery").click(function(e) {
            e.preventDefault();
            var images = JSON.parse($(this).attr('data-images'));
            var carouselInner = $("#productImageCarousel .carousel-inner");
            carouselInner.empty();
            images.forEach(function(image, index) {
                var activeClass = index === 0 ? 'active' : '';
                carouselInner.append('<div class="carousel-item ' + activeClass + '"><img src="' + image + '" class="d-block w-100" alt="Product Image"></div>');
            });
            $("#productGalleryModal").modal('show');
        });
    });
</script>
@endsection
