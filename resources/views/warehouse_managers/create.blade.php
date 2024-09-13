@extends('layouts.adminApp')

@section('content')
    <div class="container mt-4">
        <h2>Create Warehouse Manager</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('warehouse_managers.store') }}">
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
                <label for="employee_number" class="form-label">Employee Number</label>
                <input type="text" name="employee_number" id="employee_number" class="form-control" value="{{ old('employee_number') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('warehouse_managers.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
