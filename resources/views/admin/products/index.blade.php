@extends('admin.layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="mb-0">Existing Products</h1>
        <div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
            @if($softDeletedCount > 0)
                <form action="{{ route('admin.products.restoreAll') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Restore All</button>
                </form>
            @endif
        </div>
    </div>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table id="productTable" class="table table-hover" style="width: 100%;">
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
        @foreach($products as $product)
            <tr>
                <td class="align-middle">{{$product->id}}</td>
                <td class="align-middle">
                    @if($product->image)
                        @foreach(explode(',', $product->image) as $imagePath)
                            <img src="{{ asset(trim($imagePath)) }}" alt="{{ $product->name }}" width="150" height="150">
                        @endforeach
                    @endif
                </td>
                <td class="align-middle">{{$product->name}}</td>
                <td class="align-middle">{{$product->description}}</td>
                <td class="align-middle">₱ {{$product->price}}</td>
                <td class="align-middle">{{$product->category}}</td>
                <td class="align-middle" style="text-align: center;">{{$product->stock}}</td>
                <td class="align-middle">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.products.delete', $product->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        @endforeach 
        </tbody>
    </table>

    <!-- DataTables Initialization Script -->
    <script>
        $(document).ready(function () {
            $('#productTable').DataTable();
        });
    </script>
@endsection
