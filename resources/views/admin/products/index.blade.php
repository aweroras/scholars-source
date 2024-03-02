@extends('admin.layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Existing Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Images</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($product as $products)
            <tr>
                <td class="align-middle">{{$products->id}}</td>
                <td class="align-middle">
                    @if($products->image)
                        @foreach(explode(',', $products->image) as $imagePath)
                            <img src="{{ asset(trim($imagePath)) }}" alt="{{ $products->name }}" width="150" height="150">
                        @endforeach
                    @endif
                </td>
                <td class="align-middle">{{$products->name}}</td>
                <td class="align-middle">{{$products->description}}</td>
                <td class="align-middle">₱ {{$products->price}}</td>
                <td class="align-middle">{{$products->category}}</td>
                <td class="align-middle">{{$products->stock}}</td>
                <td class="align-middle">
                    <a href="{{ route('admin.products.edit', $products) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.products.delete', $products->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        @endforeach 
        </tbody>
    </table>
    {{ $product->links() }}
@endsection
