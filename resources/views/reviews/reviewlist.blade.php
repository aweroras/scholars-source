@extends('customer.layouts.details')

@section('content')
@include('messages')

    <div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">My Reviewed Products</h1>
    <a href="{{ route('reviews.index') }}" class="btn btn-primary">To Review</a>
</div>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
            <th>Product</th>
            <th>Comment</th>
            <th>Rate</th>
            <th>Image</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($reviewedProducts as $item)
    <tr>
        <td>{{ $item['product']->name }}</td>
        <td>{{ $item['review']->comment }}</td>
        <td>{{ $item['review']->rate }}</td>
        <td><img src="{{ asset($item['review']->image) }}" alt="Review Image" style="width: 50px; height: 50px;"></td>
    </tr>
@endforeach
        </tbody>
    </table>
@endsection
