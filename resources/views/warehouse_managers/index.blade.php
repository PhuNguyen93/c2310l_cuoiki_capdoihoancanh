@extends('layouts.adminApp')

@section('content')
<div class="container mt-4">
    <h1 class="text-center my-4 text-primary">Warehouse Manager List</h1>

    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('warehouse_managers.index') }}" class="mb-4">
        <div class="d-flex">
            <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}" class="form-control w-25 me-2">
            <button type="submit" class="btn btn-outline-primary">Search</button>
            <a href="{{ route('warehouse_managers.create') }}" class="btn btn-success ms-auto">Add New Warehouse Manager</a>
        </div>
    </form>

    <!-- Bảng danh sách quản lý kho -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-primary text-center">
                <tr>
                    <th>
                        <a href="{{ route('warehouse_managers.index', ['search' => request('search'), 'sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">
                            Name @if (request('sort_by') === 'name')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('warehouse_managers.index', ['search' => request('search'), 'sort_by' => 'email', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">
                            Email @if (request('sort_by') === 'email')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('warehouse_managers.index', ['search' => request('search'), 'sort_by' => 'phone', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">
                            Phone @if (request('sort_by') === 'phone')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
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
    <div class="mt-4">
        {{ $warehouseManagers->appends(request()->query())->links('pagination::bootstrap-5') }}
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