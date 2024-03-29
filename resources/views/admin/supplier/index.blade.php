@extends('admin.layouts.app')

@section('content')
@include('messages')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Supplier Dashboard</h1>
<a href="{{ route('supplier.create') }}" class="btn btn-primary">Create Supplier</a>
    </div>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>LOGO</th>
                <th>Supplier Name</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Transaction</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
            <tr>
                <td class="align-middle">
                    @foreach(explode(',', $supplier->image) as $imagePath)
                    <img src="{{ asset(trim($imagePath)) }}" alt="{{ $supplier->name }}" width="150" height="150">
                @endforeach
                </td>                
                <td class="align-middle">{{$supplier->supplier_name}}</td>
                <td class="align-middle"><a href="{{route('supplier.update', $supplier->id)}}">Update</a></td>
                <td class="align-middle"><a href="{{route('supplier.delete', $supplier->id)}}">Delete</a></td>
                <td class="align-middle"><a href="{{route('supplier_transaction.create', $supplier->id)}}">Transaction</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

