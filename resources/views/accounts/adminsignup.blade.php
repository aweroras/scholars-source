<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .signup-form {
      max-width: 400px;
      margin: 0 auto;
      padding: 30px;
      border: 1px solid #ddd;
      border-radius: 5px;
      margin-top: 50px;
    }
  </style>
</head>
<body>
    @include('messages')
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="signup-form">
        <h2 class="text-center mb-4">Admin Signup</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Signup</button>
        </form>
        <p class="mt-3 text-center">Already have an account? <a href="{{ route('login.form') }}">Login here</a></p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
</html>
