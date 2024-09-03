{{-- resources/views/vehicles/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Vehicle Details</h1>

    <p><strong>Name:</strong> {{ $vehicle->vehicle_name }}</p>
    <p><strong>License Plate:</strong> {{ $vehicle->license_plate }}</p>
    <p><strong>Status:</strong> {{ $vehicle->status }}</p>
    <p><strong>Rental Price:</strong> {{ $vehicle->rental_price }}</p>
    @if($vehicle->image)
        <p><strong>Image:</strong></p>
        <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->vehicle_name }}">
    @endif

    <a href="{{ route('vehicles.edit', $vehicle) }}">Edit</a>

    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    <a href="{{ route('vehicles.index') }}">Back to list</a>
@endsection
