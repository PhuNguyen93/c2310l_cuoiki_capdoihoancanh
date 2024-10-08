<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Page Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

</head>

<body>
    <div class="container-fuild">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark text-white min-vh-100">
                <div class="position-sticky pt-3">
                    <div class="user-info text-center mb-4">
                        <img src="https://via.placeholder.com/50" class="rounded-circle mb-3" alt="User Avatar">
                        <h5 class="text-light">Dong Doi Dua Day</h5>
                        <p class="text-light">Web Developer</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('home') }}">
                                <i class="bi bi-house"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('dashboard') }}">
                                <i class="bi bi-house"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('vehicles.index') }}">
                                <i class="bi bi-house"></i> Vehicles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('drivers.index') }}">
                                <i class="bi bi-ui-radios-grid"></i>Drivers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('warehouse_managers.index') }}">
                                <i class="bi bi-ui-radios-grid"></i>WarehouseManager
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9">
                <div class="">
                    <h1 class="h2"></h1>
                    <p class="text-muted">A free and open source Bootstrap 5 admin template</p>
                </div>
                @yield('content')
            </main>
        </div>
    </div>


</body>

</html>
