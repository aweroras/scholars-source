@extends('admin.layouts.app')

@section('content')
    <h1>Update Order Status</h1>

    <form method="POST" action="{{ route('admin.orders.updates', $order) }}">
        @csrf

        <label for="status">Status:</label>
        <input type="hidden" name="orderId" value="{{ $order->id }}">
        <select id="status" name="status">
            <option value="To Ship" {{ $order->status == 'To Ship' ? 'selected' : '' }}>To Ship</option>
            <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="To Deliver" {{ $order->status == 'To Deliver ' ? 'selected' : '' }}>To Deliver </option>
            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <button type="submit">Update Status</button>
    </form>
@endsection