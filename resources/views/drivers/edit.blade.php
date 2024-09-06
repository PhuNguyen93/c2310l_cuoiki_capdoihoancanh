@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Edit Driver</h1>

        <form method="POST" action="{{ route('drivers.update', $driver) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Driver Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $driver->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $driver->phone) }}" required>
            </div>
            <div class="mb-3">
                <label for="driver_license_number" class="form-label">Driver License Number:</label>
                <input type="text" name="driver_license_number" id="driver_license_number" class="form-control" value="{{ old('driver_license_number', $driver->driver_license_number) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection