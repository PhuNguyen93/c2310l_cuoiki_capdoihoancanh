<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
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

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div>
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                                @error('password')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit">Login</button>
                        </form>

                    </div>
                    <div class="card-footer text-center">
                        <a href="#">Forgot Your Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
