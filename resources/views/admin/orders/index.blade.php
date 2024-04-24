@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Orders</h1>
    <table id="orderTable" class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Order ID</th>
                <th>Status</th>
                <th>Payment Method</th>
                <th>Courier</th>
                <th>Action</th>
                <th>Date Ordered</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="align-middle">{{ $order->id }}</td>                
                <td class="align-middle">{{ $order->status }}</td>
                <td class="align-middle">{{ $order->payment->payment_name}}</td>
                <td class="align-middle">{{ $order->courier->courier_name}}</td>
                <td class="align-middle"><a href="{{ route('admin.orders.update', $order) }}">Change Status</a></td>
                <td class="align-middle">{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include DataTables CSS and JavaScript -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('#orderTable').DataTable();
    });
</script>
@endsection
