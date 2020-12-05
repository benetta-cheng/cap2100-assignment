<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | INTI Leave Management</title>
    <link rel="stylesheet" href="{{ asset('css/custom-bootstrap.css') }}">
</head>

<body class="h-100">
    <div class="container h-100 align-items-center">
        <div class="row h-100 align-items-center">
            <div class="col-md-4 offset-md-4">
                <p>Welcome to the INTI Leave Management System</p>
                <div class="container border border-dark rounded py-4">
                    <img src="{{ asset('img/INTI_logo.png') }}" alt="IICS Logo" class="img-fluid pb-3"
                        style="max-width: 100%; height: auto;">
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show col-md-10 offset-md-1" role="alert">
                        <strong>Login failed!</strong> Invalid username or password.
                    </div>
                    @endif
                    <form action="login" method="POST" class="needs-validation col-md-10 offset-md-1" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="userIdInput">User ID</label>
                            <input name="userId" id="userIdInput" type="text" class="form-control" placeholder="User ID"
                                @if(old('userId')) value="{{old('userId')}}" @endif required>
                            <div class="invalid-feedback">
                                User ID cannot be empty.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passwordInput">Password</label>
                            <input name="password" id="passwordInput" type="password" class="form-control"
                                placeholder="Password" @if(old('password')) value="{{old('password')}}" @endif required>
                            <div class="invalid-feedback">
                                Password cannot be empty.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script>
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
    </script>
</body>

</html>