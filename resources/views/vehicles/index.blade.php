{{-- resources/views/vehicles/index.blade.php --}}
@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Danh Sách Xe</h1>
        <!-- Form tìm kiếm -->
        <form method="GET" action="{{ route('vehicles.index') }}" class="mb-4">
            <div class="d-flex">
                <input type="text" name="search" placeholder="Tìm kiếm theo tên hoặc biển số"
                    value="{{ request('search') }}" class="form-control w-25 me-2">
                <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                <a href="{{ route('vehicles.create') }}" class="btn btn-success ms-auto">Thêm Xe Mới</a>
            </div>
        </form>
        <!-- Bảng danh sách xe -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>
                            <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'vehicle_name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                class="text-white text-decoration-none">
                                Tên @if (request('sort_by') === 'vehicle_name')
                                    <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'license_plate', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                class="text-white text-decoration-none">
                                Biển Số @if (request('sort_by') === 'license_plate')
                                    <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'status', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                class="text-white text-decoration-none">
                                Trạng Thái @if (request('sort_by') === 'status')
                                    <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('vehicles.index', ['search' => request('search'), 'sort_by' => 'rental_price', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                class="text-white text-decoration-none">
                                Giá Thuê @if (request('sort_by') === 'rental_price')
                                    <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                                @endif
                            </a>
                        </th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->vehicle_name }}</td>
                            <td>{{ $vehicle->license_plate }}</td>
                            <td>{{ $vehicle->status }}</td>
                            <td>{{ number_format($vehicle->rental_price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-info btn-sm">Xem</a>
                                <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Không tìm thấy xe nào.</td>
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
