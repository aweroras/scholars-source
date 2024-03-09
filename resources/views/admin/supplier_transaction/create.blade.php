@extends('admin.layouts.app')
  
@section('title', 'Supply Transaction')
  
@section('content')
@include('messages')
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
            </div>
            <div class="card-body">
        <form action="{{route('supplier_transaction.store')}}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('post')
            <table class="table">
                <tbody>
                    <tr>
                        <td><label for="name">Supplier Name</label></td>
                        <td><input type="text" name="supplier_name" class="form-control" value="{{$supplier->supplier_name}}" disabled></td>
                        <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
                    </tr>                    
                    <tr>
                        <td><label for="name">Products</label></td>
                        <td>
                        <select class="form-control" id="product" name="product">
                            <option value="" disabled selected>Select a product</option>
                            @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                          </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="name">Quantity</label></td>
                        <td><input type="text" name="quantity" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</body>
    @endsection
