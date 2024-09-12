@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Driver List</h1>

    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('drivers.index') }}" class="mb-4">
        <div class="d-flex">
            <input type="text" name="search" placeholder="Search by name, email, phone, or license" value="{{ request('search') }}" class="form-control w-25 me-2">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('drivers.create') }}" class="btn btn-primary ms-auto">Add New Driver</a>
        </div>
    </form>

    <!-- Bảng danh sách tài xế -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                            Name
                            @if (request('sort_by') === 'name')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'email', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                            Email
                            @if (request('sort_by') === 'email')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'phone', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                            Phone
                            @if (request('sort_by') === 'phone')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'driver_license_number', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                            Driver License
                            @if (request('sort_by') === 'driver_license_number')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($drivers as $driver)
                    <tr>
                        <td>{{ $driver->user->name }}</td>
                        <td>{{ $driver->user->email }}</td>
                        <td>{{ $driver->phone }}</td>
                        <td>{{ $driver->driver_license_number }}</td>
                        <td>
                            <a href="{{ route('drivers.show', $driver) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('drivers.destroy', $driver) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No drivers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        {{ $drivers->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
