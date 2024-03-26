@extends('customer.layouts.ap')

@section('content')
@include('messages')

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">My Reviews</h1>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Product</th>
                <th>Rate</th>
                <th>Comment</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->customer->name }}</td>  <td>{{ $review->product->name }}</td>   <td>{{ $review->rate }}</td>
                    <td>{{ $review->comment }}</td>
                    @if ($review->image)
                        <td><img src="{{ asset('storage/uploads/reviews/' . $review->image) }}" alt="Review Image" style="width: 50px; height: 50px;"></td>
                    @else
                        <td>No Image</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
