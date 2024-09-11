@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Create New Driver</h1>



        <form method="POST" action="{{ route('drivers.store') }}" class="bg-light p-4 rounded shadow">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required placeholder="Enter name"style="height: 70px; font-size: 20px;">
            </div>
            <div class="mb-3">
                <label for="driver_license_number" class="form-label">Driver License Number:</label>
                <input type="text" name="driver_license_number" id="driver_license_number" class="form-control" value="{{ old('driver_license_number') }}" required placeholder="Enter driver license number" style="height: 70px; font-size: 20px;">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required placeholder="Enter phone number"style="height: 70px; font-size: 20px;" >
            </div>
        
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection

