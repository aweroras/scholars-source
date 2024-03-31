@extends('admin.layouts.app')

@section('content')
    <h1>Orders</h1>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('admin.orders.update', $order) }}">Update Status</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection