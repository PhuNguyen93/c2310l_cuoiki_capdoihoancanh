@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Create New Vehicle</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="vehicle_name" class="form-label">Vehicle Name</label>
            <input type="text" class="form-control" id="vehicle_name" name="vehicle_name" value="{{ old('vehicle_name') }}" required>
        </div>
        <div class="mb-3">
            <label for="license_plate" class="form-label">License Plate</label>
            <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ old('license_plate') }}" required>
        </div>
        <div class="mb-3">
            <label for="rental_price" class="form-label">Rental Price</label>
            <input type="number" step="0.01" class="form-control" id="rental_price" name="rental_price" value="{{ old('rental_price') }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="borrowed" {{ old('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Vehicle Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Create Vehicle</button>
    </form>
</div>
@endsection
