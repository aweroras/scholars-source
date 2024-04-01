@extends('admin.layouts.app')

@section('content')
    <h1>Orders</h1>
    <table id="supplierTable" class="table table-hover">
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
                <td class="align-middle">{{ $order->payment_method}}</td>
                <td class="align-middle">{{ $order->courier}}</td>
                <td class="align-middle"><a href="{{ route('admin.orders.update', $order) }}">Change Status</a></td>
                <td class="align-middle">{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection