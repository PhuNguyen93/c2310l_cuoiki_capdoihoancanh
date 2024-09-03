@extends('layouts.app')

@section('content')
    <h1>Vehicle List</h1>

    <form method="GET" action="{{ route('vehicles.index') }}">
        <input type="text" name="search" placeholder="Search by name or license plate" value="{{ request('search') }}">
        <select name="status">
            <option value="">All Statuses</option>
            <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
            <option value="Borrowed" {{ request('status') == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
        </select>
        <select name="sort_by">
            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date Added</option>
            <option value="vehicle_name" {{ request('sort_by') == 'vehicle_name' ? 'selected' : '' }}>Name</option>
            <option value="rental_price" {{ request('sort_by') == 'rental_price' ? 'selected' : '' }}>Price</option>
        </select>
        <select name="sort_order">
            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>License Plate</th>
                <th>Status</th>
                <th>Rental Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->vehicle_name }}</td>
                    <td>{{ $vehicle->license_plate }}</td>
                    <td>{{ $vehicle->status }}</td>
                    <td>{{ $vehicle->rental_price }}</td>
                    <td>
                        <a href="{{ route('vehicles.show', $vehicle) }}">View</a>
                        <a href="{{ route('vehicles.edit', $vehicle) }}">Edit</a>
                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $vehicles->appends(request()->query())->links() }}
@endsection
