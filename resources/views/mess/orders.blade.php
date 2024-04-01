<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>salamat sa pagbili sa shop namin tropa</h1>
    <h2>{{$name}}</h2>
    <table>
        <thead>
            <tr>
                <th>order id</th>
                <th>product name</th>
                <th>product price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($orderProducts as $order)
               <tr>
                <td>{{$order->order_id}}</td>
                <td>{{$order->product->name}}</td>
                <td>{{$order->product->price}}</td>
                <td>{{$order->quantity}}</td>
               </tr>
           @endforeach
        </tbody>
    </table>
</body>
</html>