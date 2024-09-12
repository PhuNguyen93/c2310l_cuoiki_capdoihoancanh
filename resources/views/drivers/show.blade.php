@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Driver Details</h1>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ $driver->user->name }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $driver->user->email }}</p>
                <p><strong>Phone:</strong> {{ $driver->phone }}</p>
                <p><strong>Driver License:</strong> {{ $driver->driver_license_number }}</p>

                <div class="d-flex mt-4">
                    <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-warning me-2">Edit</a>
                    <form action="{{ route('drivers.destroy', $driver) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger me-2">Delete</button>
                    </form>
                    <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
