@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Create New Vehicle</h1>

    <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="vehicle_name" class="form-label">Vehicle Name</label>
            <input type="text" class="form-control" id="vehicle_name" name="vehicle_name" required>
        </div>
        <div class="mb-3">
            <label for="license_plate" class="form-label">License Plate</label>
            <input type="text" class="form-control" id="license_plate" name="license_plate" required>
        </div>
        <div class="mb-3">
            <label for="rental_price" class="form-label">Rental Price</label>
            <input type="number" step="0.01" class="form-control" id="rental_price" name="rental_price" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="available">Available</option>
                <option value="borrowed">Borrowed</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Vehicle Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-success">Create Vehicle</button>
    </form>
</div>
@endsection
