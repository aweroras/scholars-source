@extends('admin.layouts.app')
  
@section('title', 'Edit Product')
@include('messages')
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
                    <tr>
                     <td><label for="category">Category</label></td>
                     <td>
                        <select name="category" id="category" class="form-control">
                        <option value="">Select a Category</option>
                        <option value="writing implements">Writing Implements</option>
                        <option value="paper products">Paper Products</option>
                        <option value="binders and folders">Binders and Folders</option>
                        <option value="note-taking and organization tools">Note-taking and Organization Tools</option>
                        <option value="adhesives and fasteners">Adhesives and Fasteners</option>
                        <option value="art supplies">Art Supplies</option>
                        <option value="stationery">Stationery</option>
                        </select>
                    </td>
                    </tr>
                    <div class="form-group">
                        <label for="category">Stock</label>
                        <input type="text" name="stock" class="form-control" value="{{ $product->stock }}" readonly>
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
