@extends('admin.layouts.app')
  
@section('title', 'Edit Product')
  
@section('content')

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.update', ['product' => $product]) }}" method="post" enctype="multipart/form-data">
                    @csrf 
                    @method('put')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <input type="text" name="description" class="form-control" value="{{ $product->description }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" name="category" class="form-control" value="{{ $product->category }}">
                    </div>
                    <div class="form-group">
                        <label for="category">Stock</label>
                        <input type="text" name="stock" class="form-control" value="{{ $product->stock }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image[]" class="form-control-file" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

@endsection
