<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            width: 100px;
        }
        h1 {
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #333333;
            text-align: center;
            margin-bottom: 10px;
        }
        p {
            color: #666666;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 10px;
            background-color: #0066ff;
            color: #ffffff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0052cc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="http://127.0.0.1:8000/template/assets/img/logo/logo.png" alt="Scholars Shop Logo">
        </div>
        <h2>Email Confirmation</h2>
        <p>Hey, {{ $name }}! Your account is almost ready for usage. Simply click the button below to verify your email address.</p>
        <a href="http://127.0.0.1:8000/account/verify/{{ $email }}" class="btn">Verify Email</a>

    </div>
</body>
</html>
