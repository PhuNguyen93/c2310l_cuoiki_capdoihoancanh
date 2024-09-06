@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách tài xế</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày gia nhập</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($drivers as $driver)
                    <tr>
                        <td>{{ $driver->name }}</td>
                        <td>{{ $driver->email }}</td>
                        <td>{{ $driver->created_at }}</td>
                        <td>
                            <a href="{{ route('drivers.show', $driver->id) }}" class="btn btn-info">Xem</a>
                            <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
