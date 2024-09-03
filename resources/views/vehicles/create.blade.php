@extends('layouts.app')

@section('content')
    <h1>Create New Vehicle</h1>

    <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Vehicle Name:</label>
            <input type="text" name="vehicle_name" value="{{ old('vehicle_name') }}">
        </div>
        <div>
            <label>License Plate:</label>
            <input type="text" name="license_plate" value="{{ old('license_plate') }}">
        </div>
        <div>
            <label>Image:</label>
            <input type="file" name="image">
        </div>
        <div>
            <label>Rental Price:</label>
            <input type="number" name="rental_price" value="{{ old('rental_price') }}" step="0.01">
        </div>
        <div>
            <label>Status:</label>
            <select name="status">
                <option value="Available">Available</option>
                <option value="Borrowed">Borrowed</option>
            </select>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
