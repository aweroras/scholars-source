@extends('user.layouts.template')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container">
        <div class="text-center mt-4">
            <h2>Your Cart</h2>
        </div>
        <!-- Table to display cart items -->
        <table class="table">
            <thead class="bg-secondary text-white">
                <tr>
                    <th>Item</th>
                    <th></th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Total</th>
                    <th></th> <!-- New column for the delete button -->
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $productId => $item)
                    <tr>
                        <td>
                            @php
                                // Explode the 'image' string into an array and get the first image path
                                $images = explode(',', $item['image']);
                                $firstImagePath = isset($images[0]) ? $images[0] : null;
                            @endphp
                            <img src="{{ asset($firstImagePath) }}" alt="{{ $item['name'] }}" style="max-width: 50px;">
                        </td>
                        <td>{{ $item['name'] }}</td>
                        <td class="text-center">₱ {{ $item['price'] }}</td>
                        <td class="align-middle text-center">
                            <form action="{{ route('user.updateQuantity', ['key' => $productId]) }}" method="post" class="d-flex align-items-center justify-content-center">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="quantity" value="{{ $item['quantity'] }}" />
                                <button type="submit" class="btn btn-link" name="action" value="decrement" style="color: black; padding: 0;"><i class="fas fa-minus"></i></button>
                                <span class="mx-2">{{ $item['quantity'] }}</span>
                                <button type="submit" class="btn btn-link" name="action" value="increment" style="color: black; padding: 0;"><i class="fas fa-plus"></i></button>
                            </form>
                        </td>
                        <td class="text-center">{{ $item['price'] * $item['quantity'] }}</td>
                        <td>
                            <form action="{{ route('user.removeFromCart', ['key' => $productId]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link" style="color: black; padding: 0;"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="mt-4 text-right">Total: ₱{{ $cartTotal }}</h4>
    </div>
@endsection
