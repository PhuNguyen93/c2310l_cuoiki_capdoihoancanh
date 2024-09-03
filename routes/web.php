<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Hiển thị danh sách xe
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');

// Hiển thị form tạo mới xe
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');

// Lưu trữ dữ liệu xe mới
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');

// Hiển thị chi tiết một xe
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');

// Hiển thị form chỉnh sửa xe
Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');

// Cập nhật dữ liệu xe
Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');

// Xóa một xe
Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
