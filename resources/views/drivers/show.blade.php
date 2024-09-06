@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Driver Details</h1>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ $driver->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                
                        <div class="mb-3">
                            <strong>Phone:</strong>
                            <p>{{ $driver->phone }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Driver License Number:</strong>
                            <p>{{ $driver->driver_license_number }}</p>
                        </div>
                        

                        <div class="d-flex mt-4">
                            <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-warning me-2">Edit</a>
                            <form action="{{ route('drivers.destroy', $driver) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this driver?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-2">Delete</button>
                            </form>
                            <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
@endsection