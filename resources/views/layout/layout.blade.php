<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Welcome Page') | INTI Leave Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    @yield('head')
</head>

<body>
    <div class="container m-0">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('img/INTI_logo.png') }}" alt="IICS Logo" class="img-fluid"
                    style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @php
                $navSection = $app->view->getSections()['navSection'] ?? "";
                @endphp
                @if(Auth::guard('students')->check())
                <li class="nav-item {{$navSection == "dashboard" ? "active" : ""}}">
                    <a class="nav-link" href="{{url('dashboard')}}">Dashboard</a>
                </li>
                <li class="nav-item {{$navSection == "leaveApplication" ? "active" : ""}}">
                    <a class="nav-link" href="{{url('ApplicationForm')}}">Apply Leave</a>
                </li>
                @endif
                @if(Auth::guard('staff')->check())
                <li class="nav-item {{$navSection == "pending" ? "active" : ""}}">
                    <a class="nav-link" href="{{url('pending')}}">Pending Leave</a>
                </li>
                @endif
                <li class="nav-item {{$navSection == "history" ? "active" : ""}}">
                    <a class="nav-link" href="{{url('history')}}">History</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Logout"
                        href="{{url('logout')}}">
                        <span class="mr-1">
                            @if(Auth::guard('staff')->check())
                            {{Auth::guard('staff')->user()->name}}
                            @endif
                            @if(Auth::guard('students')->check())
                            {{Auth::guard('students')->user()->name}}
                            @endif
                        </span>
                        <img src="{{ asset('img/profile.png') }}" alt="profile" width="30" height="30">
                    </a>
                </li>
            </ul>

    </nav>

    @yield('content')
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
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @yield('scripts')
</body>

</html>