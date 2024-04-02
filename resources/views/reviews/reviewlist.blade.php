@extends('customer.layouts.details')
@section('content')
@include('messages')
    <div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">My Reviewed Products</h1>
    <a href="{{ route('reviews.index') }}" class="btn btn-primary" enctype="multipart/form-data"> To Review</a>
</div>
    <table class="table table-hover" >
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
            <td>
                @foreach(explode(',', $item['review']->image) as $imagePath)
                <img src="{{ asset(trim($imagePath)) }}" alt="{{ $item['review']->name }}" width="150" height="150">
                @endforeach
            </td>
    </tr>
        @endforeach
        </tbody>
    </table>
@endsection

