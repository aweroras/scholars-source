<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <h1>THIS IS SCHOLARS SHOP</h1>
        <H2>Hello, {{$name}}</H2>
        <h2>Gmail that you use {{$email}}</h2>
        <h3>Click to<a href="{{route('account.verify',$email)}}"> Verify</a></h3>
</body>
</html>