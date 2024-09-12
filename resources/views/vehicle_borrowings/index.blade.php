@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Your Borrowed Vehicles</h1>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Vehicle</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->vehicle->vehicle_name }}</td>
                    <td>{{ $borrowing->borrow_date->format('Y-m-d') }}</td>
                    <td>{{ $borrowing->return_date ? $borrowing->return_date->format('Y-m-d') : 'Not Returned Yet' }}</td>
                    <td>
                        <span class="badge {{ $borrowing->status === 'Borrowed' ? 'bg-warning' : 'bg-success' }}">
                            {{ $borrowing->status }}
                        </span>
                    </td>
                    <td>
                        @if($borrowing->status === 'Borrowed')
                            <form action="{{ route('vehicle_borrowings.return', $borrowing->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Return Vehicle</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No borrowings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
