<!-- customer.shop -->
@extends('customer.layouts.shop')

@section('content')
    <!-- Hero Area and other specific content go here -->

    

    <!-- Latest Products Start -->
    <section class="popular-items latest-padding">
        <div class="container">
            <div class="row product-btn justify-content-between mb-40">
                <!-- Add your dynamic content for products here -->
                @foreach($product as $products)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <!-- Add product details dynamically using the data from your database -->
                        <div class="single-popular-items mb-50 text-center position-relative">
                            <!-- Single Product Image -->
                            @php
                                // Explode the 'image' string into an array
                                $images = explode(',', $products->image);
                            @endphp
                            
                            <div class="single-product-img position-relative">
                                <a href="{{ route('customer.details', ['id' => $products->id]) }}">
                                    <img class="gallery-img big-img" src="{{ asset($images[0]) }}" alt="{{ $products->name }}" style="height: 300px; object-fit: cover;">
                                    <!-- Hoverable Add to Cart -->
                                    <div class="product-hover"></div>
                                </a>
                            </div>

                            <!-- Other product details -->
                            <div class="favorit-items"></div>
                            <div class="product-caption">
                                <h3 style="font-size: 20px;">{{ $products->name }}</h3>
                                <span>₱{{ $products->price }}</span>
                                <!-- Add to Cart button under the price -->
                            </div>
                            <button type="submit" class="btn btn-sm hero-btn" style="font-size: 13px; padding: 15px 20px;">Add to Cart</button>
                        </div>
                    </div>
                @endforeach
                <!-- End dynamic content -->
            </div>
        </div>
    </section>
    <!-- Latest Products End -->

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

        .add-to-cart-btn {
            display: block; /* Ensure the button is on a new line */
            margin-top: 10px; /* Add some space between price and button */
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #333;
            border-radius: 5px;
        }
    </style>
    <!-- Other sections go here -->
@endsection
