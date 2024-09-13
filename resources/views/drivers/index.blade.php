@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1 class="text-center my-4 text-primary">Driver List</h1>

    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('drivers.index') }}" class="mb-4">
        <div class="d-flex">
            <input type="text" name="search" placeholder="Search by name, email, phone, or license" value="{{ request('search') }}" class="form-control w-25 me-2">
            <button type="submit" class="btn btn-outline-primary">Search</button>
            <a href="{{ route('drivers.create') }}" class="btn btn-success ms-auto">Add New Driver</a>
        </div>
    </form>

    <!-- Bảng danh sách tài xế -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-primary text-center">
                <tr>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-dark">
                            Name @if (request('sort_by') === 'name')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'email', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-dark">
                            Email @if (request('sort_by') === 'email')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'phone', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-dark">
                            Phone @if (request('sort_by') === 'phone')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'driver_license_number', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-decoration-none text-dark">
                            Driver License @if (request('sort_by') === 'driver_license_number')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
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
    <div class="mt-4">
        {{ $drivers->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

<style>
    body {
        background-color: #f8f9fa; /* Màu nền */
        font-family: 'Arial', sans-serif; /* Font hiện đại */
    }

    h1 {
        color: #0056b3; /* Màu chữ đậm */
        font-weight: bold;
    }

    .table {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Đổ bóng cho bảng */
    }

    .table th, .table td {
        text-align: center;
        padding: 15px; /* Tăng padding cho bảng */
    }

    .table th {
        background-color: #334756; /* Màu nền tối cho tiêu đề */
        color: white; 
    }

    .table-hover tbody tr:hover {
        background-color: #e2f0fe; /* Màu nền sáng khi hover */
    }

    .btn {
        border-radius: 0.25rem; /* Nút tròn góc */
        transition: background-color 0.3s; /* Hiệu ứng chuyển màu mượt mà cho nút */
    }

    .btn:hover {
        opacity: 0.8; /* Thay đổi độ mờ khi hover */
    }

    .pagination {
        justify-content: center; /* Căn giữa phân trang */
    }

    /* Responsive styling */
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