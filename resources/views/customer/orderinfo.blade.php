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

.filter-form {
  display: inline-flex;
  align-items: center;
  margin-bottom: 20px;
  height: 10px;
}

.filter-form label {
  margin-right: 20px;
}

.filter-form select {
  margin-right: 20px;
  padding: 1px; /* Adjusted padding */
}

.filter-form button {
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-left: 20px; /* Add margin to the left */
}

.filter-form button:hover {
  background-color: #0056b3;
}
</style>

<h1 style="display: inline-block;">Order Details</h1>

<!-- Form for filtering orders by status -->
<form method="GET" action="{{ route('customer.orderinfo') }}" class="filter-form">
  <select name="status" id="status">
    <option value="Order Placed">Order Placed</option>
    <option value="To Ship">To Ship</option>
    <option value="Shipped">Shipped</option>
    <option value="To Deliver">To Deliver</option>
    <option value="Completed">Completed</option>
  </select>
  <button button type="submit" class="btn btn-sm hero-btn d-inline-flex align-items-center justify-content-center" style="font-size: 13px; padding: 10px 15px; background-color: #333; border-radius: 5px; border: none;">Apply Filter</button>
</form>

<table id="orderTable" class="display">
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Status</th> 
      <th>Payment Method</th>
      <th>Courier</th>
      <th>Order Date</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  @foreach ($orders as $order)
    @php
        session(['order_status' => $order->status]);
    @endphp
    <tr>
      <td>{{ $order->id }}</td>
      <td>{{ $order->status }}</td>
      <td>{{ $order->payment_method }}</td>
      <td>{{ $order->courier}}</td>
      <td>{{ $order->created_at }}</td>
      <td>
          @if ($order->status == 'completed')
          <a href="{{ route('reviews.index', ['orderId' => $order->id]) }}" style="color: red;">Review</a>
          @else
              <span>Review (available when order is completed)</span>
          @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

@endsection
