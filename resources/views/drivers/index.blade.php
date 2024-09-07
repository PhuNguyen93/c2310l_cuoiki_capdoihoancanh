@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Danh sách tài xế</h1>
    <div class="mb-3">
        <a href="{{ route('drivers.create') }}" class="btn btn-success">Thêm tài xế mới</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Ngày gia nhập</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drivers as $driver)
            <tr>
                <td>{{ $driver->name }}</td>
                <td>{{ $driver->email }}</td>
                <td>{{ $driver->phone }}</td>
                <td>{{ $driver->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('drivers.show', $driver->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $drivers->links() }}
    </div>
</div>
@endsection
