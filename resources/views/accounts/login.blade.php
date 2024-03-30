<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .login-form {
      max-width: 400px;
      margin: 0 auto;
      padding: 30px;
      border: 1px solid #ddd;
      border-radius: 5px;
      margin-top: 50px;
    }
  </style>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    @include('messages')
    <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="login-form">
              <h2 class="text-center mb-4">Login</h2>
              <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
              </form>
              <p class="mt-3 text-center">Don't have an account? <a href="{{ route('signup.form') }}">Sign up here</a></p>
            </div>
          </div>
        </div>
      </div>

</body>
</html>
</html>
