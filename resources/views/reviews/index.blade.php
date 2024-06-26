@extends('customer.layouts.details')

@section('content')
@include('messages')

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">To Review</h1>
        <a href="{{ route('reviews.reviewlist') }}" class="btn btn-primary">Reviewed Products</a>
</div>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
            <th>Product</th>
            <th>Order</th>
            <th>Review</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
        @foreach ($order->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>Order #{{ $order->id }}</td>
                <td>
                @if ($order->status == 'completed')
                    <a href="{{ route('reviews.create', ['product' => $product->id, 'order' => $order->id]) }}"style="color: red;">Write a review</a>
                @else
                    <span>Write a review (available when order is completed)</span>
                @endif
                </td>
            </tr>
        @endforeach
    @endforeach
        </tbody>
    </table>
@endsection
