@extends('admin.layouts.app')

@section('content')
@include('messages')

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Reviews Dashboard</h1>
<a href="{{ route('reviews.create') }}" class="btn btn-primary">Add Review</a>
    </div>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Customer</th>
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
                    @if ($review->img_path)
                        <td><img src="{{ asset('storage/uploads/reviews/' . $review->img_path) }}" alt="Review Image" style="width: 50px; height: 50px;"></td>
                    @else
                        <td>No Image</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
