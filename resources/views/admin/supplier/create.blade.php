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
        <form action="{{ route('supplier.store') }}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('post')
            <table class="table">
                <tbody>
                    <tr>
                        <td><label for="name">Supplier Name</label></td>
                        <td><input type="text" name="name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label for="image">Images</label></td>
                        <td><input type="file" class="form-control-file" id="image" name="image" accept="image/*" required></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</body>
    @endsection
