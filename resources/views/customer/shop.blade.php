<!-- customer.shop -->
@extends('customer.layouts.shop')

@section('content')
    <!-- Hero Area and other specific content go here -->

    <!-- Latest Products Start -->
    <section class="new-product-area section-padding30">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-tittle mb-70">
                        <h2>
                            @if(isset($query))
                                Search Results for: "{{ $query }}"
                            @else
                                Newest Products
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row product-btn justify-content-between mb-40">
                <!-- Add your dynamic content for products here -->
                @foreach($searchResults as $products)
                    @php
                        // Explode the 'image' string into an array
                        $images = explode(',', $products->image);
                    @endphp
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <!-- Add product details dynamically using the data from your database -->
                        <div class="single-popular-items mb-50" style="background-color: #f5f5f5; border-radius: 10px; padding: 20px;">
                            <!-- Product Image -->
                            <div class="single-product-img position-relative">
                                <a href="{{ route('customer.details', ['id' => $products->id]) }}">
                                    <img class="gallery-img big-img" src="{{ asset($images[0]) }}" alt="{{ $products->name }}" style="height: 300px; object-fit: cover;">
                                    <!-- Hoverable Add to Cart -->
                                    <div class="product-hover"></div>
                                </a>
                            </div>
                            <!-- Product Details -->
                            <div class="product-caption mt-3">
                                <h3 style="font-size: 20px; color: #333;">{{ $products->name }}</h3>
                                <p>₱ {{ $products->price }}</p>
                                <!-- Add to Cart button below the price -->
                                <form method="POST" action="{{ route('customer.addToCart', ['id' => $products->id]) }}">
                                    @csrf <!-- Add CSRF token field for security -->
                                    <button type="submit" class="btn btn-sm hero-btn d-inline-flex align-items-center justify-content-center" style="font-size: 13px; padding: 5px 15px; background-color: #333; border-radius: 5px; border: none;">
                                        <i class="fas fa-shopping-cart mr-1"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End dynamic content -->
            </div>
        </div>
    </section>
    <!-- Latest Products End -->

   <!-- Pagination Links -->
   <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                {{ $searchResults->links() }}
            </div>
        </div>
    </div>
</section>
    <!-- Add the following JavaScript code -->
    <script>
        document.getElementById('priceFilter').addEventListener('change', function () {
            document.getElementById('filterForm').submit();
        });
    </script>

    <!-- Add the following CSS to your styles -->
    <style>
        .single-product-img {
            position: relative;
            overflow: hidden;
        }

        .product-hover {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease-in-out;
        }

        .single-popular-items:hover .product-hover {
            opacity: 1;
        }

        .pagination {
            justify-content: center;
        }

        .pagination .page-item.active .page-link {
            background-color: red;
            border-color: red;
        }

        .pagination .page-link {
            color: red;
        }
    </style>
    <!-- Other sections go here -->
@endsection
