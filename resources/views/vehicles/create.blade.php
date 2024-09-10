@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Create New Vehicle</h1>

        <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data" class="bg-light p-4 rounded shadow">
            @csrf
            <div class="mb-3">
                <label for="vehicle_name" class="form-label">Vehicle Name:</label>
                <input type="text" name="vehicle_name" id="vehicle_name" class="form-control" value="{{ old('vehicle_name') }}" required placeholder="Enter vehicle name">
            </div>
            <div class="mb-3">
                <label for="license_plate" class="form-label">License Plate:</label>
                <input type="text" name="license_plate" id="license_plate" class="form-control" value="{{ old('license_plate') }}" required placeholder="Enter license plate">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="rental_price" class="form-label">Rental Price:</label>
                <input type="number" name="rental_price" id="rental_price" class="form-control" value="{{ old('rental_price') }}" step="0.01" required placeholder="Enter rental price">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Borrowed" {{ old('status') == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection
