<!-- cart.blade.php -->

@extends('customer.layouts.cart') <!-- Change this to your layout file -->

@section('content')
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Cart List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================Cart Area =================-->
        <section class="cart_area section_padding">
            <div class="container">
                <div class="cart_inner">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Remove</th> <!-- New column for the Remove button -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cart as $productId => $item)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    @php
                                                        // Explode the 'image' string into an array
                                                        $images = explode(',', $item['image']);
                                                    @endphp
                                                    <img src="{{ asset($images[0]) }}" alt="{{ $item['name'] }}" />
                                                </div>
                                                <div class="media-body">
                                                    <p>{{ $item['name'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>₱{{ $item['price'] }}</h5>
                                        </td>
                                        <td class="align-middle">
                                            <form method="post" action="{{ route('customer.updateQuantity', ['key' => $productId]) }}" class="d-flex align-items-center justify-content-center">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="action" value="decrement" class="btn" style="padding: 0;">
                                                    <i class="ti-minus"></i>
                                                </button>
                                                <span class="mx-2">{{ $item['quantity'] }}</span>
                                                <button type="submit" name="action" value="increment" class="btn" style="padding: 0;">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <h5>₱{{ $item['quantity'] * $item['price'] }}</h5>
                                        </td>
                                        <td class="text-center">
                                            <form method="post" action="{{ route('customer.removeFromCart', ['key' => $productId]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn" style="padding: 0;">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Your cart is empty</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>Subtotal</h5>
                                    </td>
                                    <td>
                                        <h5>₱{{ $cartTotal }}</h5>
                                    </td>
                                    <td></td> <!-- Empty column for layout consistency -->
                                </tr>
                                <tr class="shipping_area">
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>Shipping</h5>
                                    </td>
                                    <td>
                                        <!-- Your shipping details go here -->
                                    </td>
                                    <td></td> <!-- Empty column for layout consistency -->
                                </tr>
                            </tbody>
                        </table>
                        <div class="checkout_btn_inner float-right">
                            <a class="btn_1" href="{{ route('customer.shop') }}">Continue Shopping</a>
                            <a class="btn_1 checkout_btn_1" href="#">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Cart Area =================-->
    </main>
@endsection
