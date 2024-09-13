{{-- resources/views/vehicles/index.blade.php --}}
@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <h1 class="text-center my-4 text-primary">Vehicle List</h1>
        <!-- Search Form -->
        <form method="GET" action="{{ route('vehicles.index') }}" class="mb-4">
            <div class="d-flex">
                <input type="text" name="search" placeholder="Search by name or license plate"
                    value="{{ request('search') }}" class="form-control w-50 me-2">
                <button type="submit" class="btn btn-outline-primary">Search</button>
                <a href="{{ route('vehicles.create') }}" class="btn btn-success ms-auto">Add New Vehicle</a>
            </div>
        </form>
        <!-- Vehicle List Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>
                            <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'vehicle_name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                class="text-decoration-none text-dark">
                                Vehicle Name @if (request('sort_by') === 'vehicle_name')
                                    <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'license_plate', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                class="text-decoration-none text-dark">
                                License Plate @if (request('sort_by') === 'license_plate')
                                    <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'status', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                class="text-decoration-none text-dark">
                                Status @if (request('sort_by') === 'status')
                                    <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'rental_price', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                class="text-decoration-none text-dark">
                                Rental Price @if (request('sort_by') === 'rental_price')
                                    <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                                @endif
                            </a>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->vehicle_name }}</td>
                            <td>{{ $vehicle->license_plate }}</td>
                            <td class="{{ $vehicle->status == 'Available' ? 'text-success' : 'text-danger' }}">
                                {{ $vehicle->status }}
                            </td>
                            <td>{{ number_format($vehicle->rental_price, 0, ',', '.') }} VND</td>
                            <td>
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No vehicles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $vehicles->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

<style>
    body {
        background-color: #f8f9fa; /* Background color */
        font-family: 'Arial', sans-serif; /* Modern font */
    }

    h1 {
        color: #0056b3; /* Dark blue text */
        font-weight: bold;
    }

    .table {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for deeper look */
    }

    .table th, .table td {
        text-align: center;
        padding: 15px; /* Increased padding for space */
    }

    .table th {
        background-color: #334756; /* Dark background for headers */
        color: white; 
    }

    .table-hover tbody tr:hover {
        background-color: #e2f0fe; /* Light blue on row hover */
    }

    .text-success {
        color: #28a745; /* Green for available status */
    }

    .text-danger {
        color: #dc3545; /* Red for not available status */
    }

    .btn {
        border-radius: 0.25rem; /* Rounded buttons */
        transition: background-color 0.3s; /* Smooth transition for buttons */
    }

    .btn:hover {
        opacity: 0.8; /* Slight opacity change on hover */
    }

    .pagination {
        justify-content: center;
    }

    /* Additional responsive styling */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto; 
        }
        .btn,
        .form-control {
            width: 100%; 
            margin-bottom: 1rem;
        }
    }
</style>