<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            width: 100px;
        }
        h1 {
            color: #212529;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
        }
        h2 {
            color: #212529;
            text-align: center;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #e9ecef;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="http://127.0.0.1:8000/template/assets/img/logo/logo.png" alt="Scholars Shop Logo">
        </div>
        <h1>Order Details</h1>
        <h2>{{$name}}</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
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
    </div>
</body>
</html>