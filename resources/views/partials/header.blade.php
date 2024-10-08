<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>Your Page Title</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo2.png') }}" alt="BP Car Services" width="50" height="50" class="d-inline-block align-text-top">
            <span class="ms-2 fs-4">BP Car Services</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Web Development</a></li>
                        <li><a class="dropdown-item" href="#">SEO</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Consulting</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-3 mb-2 mb-lg-0">
    @auth
        <li class="nav-item">
            <a class="nav-link" href="{{route('profile')}}">
                Welcome, {{ Auth::user()->name }}
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link nav-link" style="text-decoration: none;">Logout</button>
            </form>
        </li>
    @else
        <li class="nav-item">
            <a class="btn btn-login" href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </a>
        </li>
        <li class="nav-item">
            <a class="btn btn-signup" href="{{ route('register') }}">
                <i class="bi bi-person-plus-fill me-2"></i>Sign up
            </a>
        </li>
    @endauth
</ul>
        </div>
    </div>
</nav>
</body>
</html>



