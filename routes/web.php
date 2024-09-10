<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseStaffController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BorrowHistoryController;

// Hiển thị trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');
//hiển thị trang liên hệ
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

<<<<<<< Updated upstream
// Tìm kiếm, lọc, phân trang cho nhân viên quản kho
Route::resource('warehouse-staff', WarehouseStaffController::class);
Route::get('warehouse-staff/search', [WarehouseStaffController::class, 'index'])->name('warehouse-staff.search');

// Tìm kiếm, lọc, phân trang cho tài xế
Route::resource('drivers', DriverController::class);
Route::get('drivers/search', [DriverController::class, 'index'])->name('drivers.search');

// Tìm kiếm, lọc, phân trang cho lịch sử mượn
Route::resource('borrow-histories', BorrowHistoryController::class);
Route::get('borrow-histories/search', [BorrowHistoryController::class, 'index'])->name('borrow-histories.search');


=======


// Trang đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Xử lý việc đăng nhập
Route::post('/login', [LoginController::class, 'authenticate']);

// Trang đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Xử lý đăng ký
Route::post('/register', [RegisterController::class, 'register']);
>>>>>>> Stashed changes
