@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Driver List</h1>

    <form method="GET" action="{{ route('drivers.index') }}" class="mb-4">
        <div class="d-flex">
            <input type="text" name="search" placeholder="Search by name or email"
                value="{{ request('search') }}" class="form-control w-25 me-2">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('drivers.create') }}" class="btn btn-primary ms-auto">Add New Driver</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                            Name @if (request('sort_by') === 'name')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'email', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                            Email @if (request('sort_by') === 'email')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th class="text-white">Phone</th>
                    <th>
                        <a href="{{ route('drivers.index', ['search' => request('search'), 'sort_by' => 'created_at', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                            Joined @if (request('sort_by') === 'created_at')
                                <small>{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</small>
                            @endif
                        </a>
                    </th>
                    <th class="text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($drivers as $driver)
                    <tr>
                        <td>{{ $driver->name }}</td>
                        <td>{{ $driver->email }}</td>
                        <td>{{ $driver->phone }}</td>
                        <td>{{ $driver->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('drivers.show', $driver->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display:inline;">
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

    <div class="">
        {{ $drivers->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
