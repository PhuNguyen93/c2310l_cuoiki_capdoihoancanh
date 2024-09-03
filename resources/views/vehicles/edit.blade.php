@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Edit Vehicle</h1>

        <form method="POST" action="{{ route('vehicles.update', $vehicle) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="vehicle_name" class="form-label">Vehicle Name:</label>
                <input type="text" name="vehicle_name" id="vehicle_name" class="form-control" value="{{ old('vehicle_name', $vehicle->vehicle_name) }}" required>
            </div>
            <div class="mb-3">
                <label for="license_plate" class="form-label">License Plate:</label>
                <input type="text" name="license_plate" id="license_plate" class="form-control" value="{{ old('license_plate', $vehicle->license_plate) }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="mb-3">
                <label for="rental_price" class="form-label">Rental Price:</label>
                <input type="number" name="rental_price" id="rental_price" class="form-control" value="{{ old('rental_price', $vehicle->rental_price) }}" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Available" {{ $vehicle->status == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Borrowed" {{ $vehicle->status == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
