{{-- resources/views/vehicles/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Vehicle Details</h1>

        <div class="mb-3">
            <p><strong>Name:</strong> {{ $vehicle->vehicle_name }}</p>
            <p><strong>License Plate:</strong> {{ $vehicle->license_plate }}</p>
            <p><strong>Status:</strong> {{ $vehicle->status }}</p>
            <p><strong>Rental Price:</strong> ${{ number_format($vehicle->rental_price, 2) }}</p>
            @if($vehicle->image)
                <div class="my-3">
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->vehicle_name }}" class="img-fluid">
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Back to list</a>
        </div>
    </div>
@endsection
