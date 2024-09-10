<nav class="navbar navbar-expand-lg navbar-light " >
    <div class="container-fluid">
        <img src="{{ asset('assets/images/logo2.png') }}" alt="BP Car Services" width="50" height="50" class="d-inline-block align-text-top">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">aaaa</a></li>
                        <li><a class="dropdown-item" href="#">aaaa</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">aaaaa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-3 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-person-plus-fill me-2"></i>Sign up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- <style>
    .navbar-dark .nav-link {
        color: #f8f9fa; /* Màu chữ sáng hơn */
    }

    .navbar-dark .nav-link:hover {
        color: #ffc107; /* Màu vàng khi hover */
    }

    .navbar-dark .dropdown-menu {
         background-color: #6c757d; /* Nền tối cho dropdown */
    }

    .navbar-dark .dropdown-item {
        color: #f8f9fa; /* Màu chữ sáng cho item dropdown */
    }

    .navbar-dark .dropdown-item:hover {
        background-color: #ffc107; /* Màu nền khi hover */
        color: #343a40; /* Màu chữ khi hover */
    }
</style> --}}
