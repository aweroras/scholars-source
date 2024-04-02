@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1>Payment Methods</h1>
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.payment_method.create') }}" class="btn btn-primary mr-2">Add New Payment Method</a>
            <form action="{{ route('admin.payment_method.restoreAll') }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('Are you sure you want to restore all soft deleted payment methods?')" class="btn btn-success mr-2">Restore All</button>
            </form>
            
        </div>
    </div>
    <table id="paymentMethodTable" class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Images</th>
                <th>Payment Name</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentMethods as $paymentMethod)
            <tr>
                <td class="align-middle">
                    @foreach(explode(',', $paymentMethod->image) as $imagePath)
                    <img src="{{ asset(trim($imagePath)) }}" alt="{{ $paymentMethod->name }}" width="150" height="150">
                    @endforeach
                </td>                
                <td class="align-middle">{{$paymentMethod->payment_name}}</td>
                <td class="align-middle"><a href="{{route('admin.payment_method.update', $paymentMethod->id)}}">Update</a></td>
                <td class="align-middle">
                    <form action="{{ route('admin.payment_method.delete', $paymentMethod->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this payment method?')" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include DataTables CSS and JavaScript -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('#paymentMethodTable').DataTable();
    });
</script>
@endsection
