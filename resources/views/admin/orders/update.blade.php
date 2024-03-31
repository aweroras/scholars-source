@extends('admin.layouts.app')

@section('content')
    <h1>Update Order Status</h1>

    <form method="POST" action="{{ route('admin.orders.updates', $order) }}">
        @csrf

        <label for="status">Status:</label>
        <input type="hidden" name="orderId" value="{{ $order->id }}">
        <select id="status" name="status">
            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <button type="submit">Update Status</button>
    </form>
@endsection