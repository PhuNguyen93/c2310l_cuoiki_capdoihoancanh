@extends('layouts.adminApp')

@section('content')
    <div class="container mt-4">
        <h2>Warehouse Manager Details</h2>

        <div class="mb-3">
            <strong>Name:</strong>
            <p>{{ $warehouseManager->user->name }}</p>
        </div>

        <div class="mb-3">
            <strong>Email:</strong>
            <p>{{ $warehouseManager->user->email }}</p>
        </div>

        <div class="mb-3">
            <strong>Phone:</strong>
            <p>{{ $warehouseManager->phone }}</p>
        </div>

        <a href="{{ route('warehouse_managers.edit', $warehouseManager->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('warehouse_managers.index') }}" class="btn btn-secondary">Back</a>
    </div>

    @endsection
