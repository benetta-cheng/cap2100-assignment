<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | INTI Leave Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body class="h-100">
<div class="container h-100 align-items-center">
    <div class="row h-100 align-items-center">
        <div class="col-md-4 offset-md-4">
            <p>Welcome to the INTI Leave Management System</p>
            <div class="container border border-dark rounded py-4">
            <img src="{{ asset('img/INTI_logo.png') }}" alt="IICS Logo" class="img-fluid" style="max-width: 100%; height: auto;">
            <form class="col-md-10 offset-md-1">
                <div class="form-group">
                    <label for="userIdInput">User ID</label>
                    <input id="userIdInput" type="text" class="form-control" placeholder="User ID">
                </div>
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input id="passwordInput" type="password" class="form-control" placeholder="Password">
                </div>
                <button type="button" class="btn btn-danger">Login</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>