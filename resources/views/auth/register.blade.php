<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            background-image: url('https://image.kkday.com/v2/image/get/h_650%2Cc_fit/s1.kkday.com/product_115174/20210111040009_p0lTl/jpg');
            background-size: cover;
            background-position: center;
        }
        .form-container {
            flex: 0 0 450px; /* Đặt chiều rộng của form */
            background-color: rgba(255, 255, 255, 0.9); /* Màu nền trắng với độ trong suốt */
            border-radius: 1.5rem; /* Làm tròn các góc của form */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Đổ bóng cho form */
            margin: auto; /* Canh giữa form trong viewport */
            padding: 30px; /* Thêm padding cho form */
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
            padding: 20px; /* Tăng padding cho card-header */
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px; /* Tăng kích thước button */
            font-size: 1.1rem; /* Tăng kích thước font cho button */
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-control {
            height: 45px; /* Tăng chiều cao của input */
            font-size: 1rem; /* Tăng kích thước font trong input */
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        .form-group {
            position: relative; /* Để icon nằm trong input */
            margin-bottom: 15px; /* Tăng khoảng cách dưới mỗi trường */
        }
        .form-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%); /* Giữa icon theo chiều dọc */
            color: #007bff; /* Đổi màu icon */
        }
        .input-group {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="card">
            <div class="card-header text-center">
                <h3><i class="fas fa-user-plus"></i> Register</h3>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" id="name" class="form-control ps-5" placeholder="Name" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" class="form-control ps-5" placeholder="Email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" class="form-control ps-5" placeholder="Password" required>
                    </div>

                    <div class="form-group input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control ps-5" placeholder="Confirm Password" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('login') }}">Already have an account? Login</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>