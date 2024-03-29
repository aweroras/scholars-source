@extends('admin.layouts.transac')

@section('content')
    @include('messages')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Supplier Transaction</h1>
    </div>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Images</th>
                <th>Supplier Name</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>
                        @foreach(explode(',', $supplier->image) as $imagePath)
                            <img src="{{ asset(trim($imagePath)) }}" alt="{{ $supplier->name }}" width="150" height="150">
                        @endforeach
                    </td>
                    <td class="align-middle">{{$supplier->supplier_name}}</td>
                    <td class="align-middle">{{$supplier->name}}</td>
                    <td class="align-middle">{{$supplier->quantity}}</td>
                    <td class="align-middle"><a href="{{route('supplier_transaction.edit', $supplier->id)}}">Update</a></td>
                    <td class="align-middle">
                        <a href="{{ route('supplier_transaction.delete', $supplier->id) }}" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $suppliers->links() }}
    </div>
@endsection
