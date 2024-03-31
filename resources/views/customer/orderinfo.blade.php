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
<body> <table>
    
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Customer</th>
      <th>Status</th>
      <th>Payment Method</th>
      <th>Courier</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{ $order->id }}</td>
      <td>{{ $order->customer }}</td>
      <td>{{ $order->status }}</td>
      <td>{{ $order->payment_method }}</td>
      <td>{{ $order->courier }}</td>
      <td>{{ $order->created_at->format('Y-m-d') }}</td>
      <td>
        <a href="{{ route('reviews.create')}}">add review</a>
      </td>
    </tr>
    </tbody>
</table>
</body>

@endsection

