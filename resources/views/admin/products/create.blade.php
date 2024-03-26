@extends('admin.layouts.app')
  
@section('title', 'Add Product')
  
@section('content')
@include('messages')
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
            </div>
            <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('post')
            <table class="table">
                <tbody>
                    <tr>
                        <td><label for="name">Product Name</label></td>
                        <td><input type="text" name="name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label for="price">Description</label></td>
                        <td><input type="text" name="description" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label for="price">Price</label></td>
                        <td><input type="text" name="price" class="form-control"></td>
                    </tr>
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
                    <tr>
                        <td><label for="image">Images</label></td>
                        <td><input type="file" name="image[]" class="form-control-file" multiple></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</body>

    @endsection
