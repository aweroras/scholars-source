@extends('customer.layouts.cart')

@section('content')
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}
</style>

<h1>Order Details</h1>

<table id="orderTable" class="display">
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Customer</th>
      <th>Status</th>
      <th>Payment Method</th>
      <th>Courier</th>
      <th>Shipping Fee</th>
      <th>Total Amount</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($orders as $order)
    <tr>
      <td>{{ $order->id }}</td>
      <td>{{ $order->customer_id }}</td>
      <td>{{ $order->status }}</td>
      <td>{{ $order->payment_method }}</td>
      <td>{{ $order->courier}}</td>
      <td>{{ $order->shippingFee }}</td>
      <td>{{ $order->totalAmount}}</td>
      <td>{{ $order->created_at }}</td>
      <td>
      <a href="{{ route('reviews.create', ['order' => $order->id]) }}">Review</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#orderTable').DataTable();
});
</script>
@endpush