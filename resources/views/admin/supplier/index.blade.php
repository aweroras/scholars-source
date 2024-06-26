@extends('admin.layouts.app')

@section('content')
@include('messages')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="mb-0">Suppliers</h1>
    <div>
        <a href="{{ route('supplier.create') }}" class="btn btn-primary mr-2">Create Supplier</a>
        @if($softDeletedCount > 0)
            <form action="{{ route('supplier.restoreAll') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Restore All</button>
            </form>
        @endif
    </div>
</div>
<table id="supplierTable" class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>Images</th>
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
            <td class="align-middle">
                <a href="{{ route('supplier.delete', $supplier->id) }}" onclick="return confirm('Are you sure you want to delete this supplier?')">Delete</a>
            </td>
            <td class="align-middle"><a href="{{route('supplier_transaction.create', $supplier->id)}}">Transaction</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- DataTables Initialization Script -->
<script>
    $(document).ready(function () {
        $('#supplierTable').DataTable();
    });
</script>
@endsection
