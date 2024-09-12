<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WarehouseStaffController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BorrowHistoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard (sau khi đăng nhập)
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Routes quản lý xe (Vehicle Management)
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

// Routes tìm kiếm, lọc, phân trang cho nhân viên quản kho (Warehouse Staff)
Route::resource('warehouse-staff', WarehouseStaffController::class);
Route::get('warehouse-staff/search', [WarehouseStaffController::class, 'index'])->name('warehouse-staff.search');

// Routes tìm kiếm, lọc, phân trang cho tài xế (Driver Management)
Route::resource('drivers', DriverController::class);
Route::get('drivers/search', [DriverController::class, 'index'])->name('drivers.search');

// Routes tìm kiếm, lọc, phân trang cho lịch sử mượn xe (Borrow History)
Route::resource('borrow-histories', BorrowHistoryController::class);
Route::get('borrow-histories/search', [BorrowHistoryController::class, 'index'])->name('borrow-histories.search');

// Trang hiển thị form đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Xử lý việc đăng nhập
Route::post('/login', [LoginController::class, 'authenticate']);

// Trang hiển thị form đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Xử lý việc đăng ký tài khoản
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
