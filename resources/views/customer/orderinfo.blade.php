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
      <td>#1234</td>
      <td>John Doe</td>
      <td>Shipped</td>
      <td>Credit Card</td>
      <td>FedEx</td>
      <td>2024-03-10</td>
      <td>
        <a href="{{ route('reviews.create')}}">add review</a>
      </td>
    </tr>
    </tbody>
</table>
</body>

@endsection

