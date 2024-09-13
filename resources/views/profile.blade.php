@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profile</h1>

    <div class="card">
        <div class="card-header">User Information</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $driver->user->name }}</p>
            <p><strong>Email:</strong> {{ $driver->user->email }}</p>
            <p><strong>Driver License Number:</strong> {{ $driver->driver_license_number }}</p>
            <p><strong>Phone:</strong> {{ $driver->phone }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Borrowing History</div>
        <div class="card-body">
            @if($borrowings->isEmpty())
                <p>No borrowing history found.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vehicle Name</th>
                            <th>Borrow Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowings as $borrowing)
                            <tr>
                                <td>{{ $borrowing->id }}</td>
                                <td>{{ $borrowing->vehicle->vehicle_name ?? 'N/A' }}</td>
                                <td>{{ $borrowing->borrow_date }}</td>
                                <td>{{ $borrowing->return_date ?? 'Not Returned' }}</td>
                                <td>{{ $borrowing->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
