@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Borrow a Vehicle</h1>
    <form action="{{ route('vehicle_borrowings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="vehicle_id" class="form-label">Select Vehicle</label>
            <select id="vehicle_id" name="vehicle_id" class="form-select" required>
                <option value="" disabled selected>Select a vehicle...</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }} - ${{ $vehicle->rental_price }}/day</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="borrow_date" class="form-label">Borrow Date</label>
            <input type="date" id="borrow_date" name="borrow_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Borrow Vehicle</button>
    </form>
</div>
@endsection
