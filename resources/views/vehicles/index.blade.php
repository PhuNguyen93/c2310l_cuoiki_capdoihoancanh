@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Vehicle List</h1>

    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('vehicles.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" placeholder="Search by name or license plate"
                value="{{ request('search') }}" class="form-control">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('vehicles.create') }}" class="btn btn-success">Add New Car</a>
        </div>
    </form>

    <!-- Bảng danh sách xe -->
    <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark text-white text-center">
                <tr>
                    <th>
                        <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'vehicle_name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-white">
                            Name @if (request('sort_by') === 'vehicle_name')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'license_plate', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-white">
                            License Plate @if (request('sort_by') === 'license_plate')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'status', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-white">
                            Status @if (request('sort_by') === 'status')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'rental_price', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-white">
                            Rental Price @if (request('sort_by') === 'rental_price')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehicles as $vehicle)
                    <tr class="text-center">
                        <td>{{ $vehicle->vehicle_name }}</td>
                        <td>{{ $vehicle->license_plate }}</td>
                        <td>{{ $vehicle->status }}</td>
                        <td>${{ number_format($vehicle->rental_price, 2) }}</td>
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

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $vehicles->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection