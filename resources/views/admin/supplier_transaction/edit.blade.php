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
        <form action="{{route('supplier_transaction.update', $supplierTransaction->id)}}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <table class="table">
                <tbody>
                    <tr>
                        <td><label for="name">Supplier Name</label></td>
                        <td>
                        <select class="form-control" id="product" name="supplier">
                            <option value="{{$supplierTransaction->supplier_id}}">{{$supplierTransaction->supplier_name}}</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    </tr>                    
                    <tr>
                        <td><label for="name">Supplier Name</label></td>
                        <td>
                        <select class="form-control" id="product" name="product">
                            <option value="{{$supplierTransaction->product_id}}">{{$supplierTransaction->name}}</option>
                            @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                          </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="name">Quantity</label></td>
                        <td><input type="text" name="quantity" class="form-control" value="{{$supplierTransaction->quantity}}"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</body>
    @endsection
