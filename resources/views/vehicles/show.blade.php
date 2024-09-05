{{-- resources/views/vehicles/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Vehicle Details</h1>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ $vehicle->vehicle_name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>License Plate:</strong> {{ $vehicle->license_plate }}</p>
                        <p><strong>Status:</strong> {{ $vehicle->status }}</p>
                        <p><strong>Rental Price:</strong> ${{ number_format($vehicle->rental_price, 2) }}</p>

                        <div class="d-flex mt-4">
                            <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning me-2">Edit</a>
                            <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-2">Delete</button>
                            </form>
                            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        @if($vehicle->image)
                            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->vehicle_name }}" class="img-fluid rounded">
                        @else
                            <img src="{{ asset('images/no-image-available.png') }}" alt="No image available" class="img-fluid rounded">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection