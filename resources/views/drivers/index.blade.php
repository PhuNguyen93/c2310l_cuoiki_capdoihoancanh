@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Driver List</h1>

    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('drivers.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" placeholder="Search by name or license number"
                value="{{ request('search') }}" class="form-control">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('drivers.create') }}" class="btn btn-success">Add New Driver</a>
        </div>
    </form>

    <!-- Bảng danh sách tài xế -->
    <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark text-white text-center">
                <tr>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-white">
                            Name @if (request('sort_by') === 'name')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'driver_license_number', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-white">
                            License Number @if (request('sort_by') === 'driver_license_number')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'phone', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-white">
                            Phone @if (request('sort_by') === 'phone')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($drivers as $driver)
                    <tr class="text-center">
                        <td>{{ $driver->name ?? 'N/A' }}</td>  <!-- Xem xét kết nối với model User -->
                        <td>{{ $driver->driver_license_number }}</td>
                        <td>{{ $driver->phone }}</td> <!-- Hiển thị số điện thoại -->
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
                        <td colspan="4" class="text-center">No drivers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $drivers->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection