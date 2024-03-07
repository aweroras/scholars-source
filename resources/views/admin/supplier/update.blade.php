@extends('admin.layouts.app')
  
@section('title', 'Add Supplier')
  
@section('content')
@include('messages')
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
            </div>
            <div class="card-body">
        <form action="{{ route('supplier.edit', $supplier->id) }}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <table class="table">
                <tbody>
                    <tr>
                        <td><label for="name">Supplier Name</label></td>
                        <td><input type="text" value="{{$supplier->supplier_name}}" name="name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label for="image">Images</label></td>
                        <td><input type="file" class="form-control-file" id="image" name="image" accept="image/*" required></td><br>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('supplier_images/' . $supplier->image) }}" alt="wala" style="width: 100; height: 100px;">
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</body>
    @endsection
