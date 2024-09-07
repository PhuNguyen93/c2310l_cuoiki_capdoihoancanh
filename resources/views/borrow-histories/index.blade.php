@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Lịch sử mượn xe</h1>
    <div class="mb-3">
        <a href="{{ route('borrow-histories.create') }}" class="btn btn-success">Đăng ký mượn xe</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Tài xế</th>
                <th>Xe</th>
                <th>Ngày mượn</th>
                <th>Ngày trả</th>
                <th>Người phê duyệt</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrowHistories as $history)
            <tr>
                <td>{{ $history->driver->name }}</td>
                <td>{{ $history->vehicle->license_plate }}</td>
                <td>{{ $history->borrowed_at->format('d/m/Y') }}</td>
                <td>{{ $history->returned_at ? $history->returned_at->format('d/m/Y') : 'Chưa trả' }}</td>
                <td>{{ $history->warehouseStaff->name }}</td>
                <td>
                    <span class="badge badge-{{ $history->status == 'approved' ? 'success' : 'secondary' }}">
                        {{ ucfirst($history->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('borrow-histories.show', $history->id) }}" class="btn btn-info btn-sm">Xem</a>
                    @if ($history->status == 'pending')
                        <a href="{{ route('borrow-histories.edit', $history->id) }}" class="btn btn-warning btn-sm">Phê duyệt</a>
                        <form action="{{ route('borrow-histories.destroy', $history->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $borrowHistories->links() }}
    </div>
</div>
@endsection
