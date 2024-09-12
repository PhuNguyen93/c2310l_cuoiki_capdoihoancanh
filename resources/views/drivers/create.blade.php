@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Create New Driver</h1>

    <!-- Hiển thị thông báo lỗi nếu có -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form tạo tài xế mới -->
    <form method="POST" action="{{ route('drivers.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>
        <div class="mb-3">
            <label for="driver_license_number" class="form-label">Driver License</label>
            <input type="text" name="driver_license_number" id="driver_license_number" class="form-control" value="{{ old('driver_license_number') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Driver</button>
    </form>
</div>
@endsection
