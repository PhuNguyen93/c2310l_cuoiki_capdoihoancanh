@extends('layouts.adminApp')

@section('content')
<div class="container mt-4">
    <h1 class="text-center my-4">Warehouse Manager List</h1>

    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('warehouse_managers.index') }}" class="mb-4">
        <div class="d-flex">
            <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}" class="form-control w-25 me-2">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('warehouse_managers.create') }}" class="btn btn-success ms-auto">Add New Warehouse Manager</a>
        </div>
    </form>

    <!-- Bảng danh sách quản lý kho -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>
                        <a href="{{ route('warehouse_managers.index', ['search' => request('search'), 'sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}" class="text-white text-decoration-none">
                            Name
                            @if (request('sort_by') === 'name')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('warehouse_managers.index', ['search' => request('search'), 'sort_by' => 'email', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}" class="text-white text-decoration-none">
                            Email
                            @if (request('sort_by') === 'email')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('warehouse_managers.index', ['search' => request('search'), 'sort_by' => 'phone', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}" class="text-white text-decoration-none">
                            Phone
                            @if (request('sort_by') === 'phone')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($warehouseManagers as $manager)
                    <tr>
                        <td>{{ $manager->user->name }}</td>
                        <td>{{ $manager->user->email }}</td>
                        <td>{{ $manager->phone }}</td>
                        <td>
                            <a href="{{ route('warehouse_managers.show', $manager) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('warehouse_managers.edit', $manager) }}" class="btn btn-warning btn-sm">Edit</a>
                            {{-- <form action="{{ route('warehouse_managers.destroy', $manager) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No warehouse managers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        {{ $warehouseManagers->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
