<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    // Hiển thị danh sách tài xế (Read, Sort, Filter, Pagination)
    public function index(Request $request)
    {
        if (Auth::user()->role_id != 2) {
            return redirect()->route('home')->with('error', 'You do not have the required permissions.');
        }
        // Lấy dữ liệu tìm kiếm và sắp xếp
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'name');  // Sắp xếp theo trường nào (mặc định là 'name')
        $sortOrder = $request->input('sort_order', 'asc');  // Thứ tự sắp xếp (mặc định là 'asc')

        // Tạo query để lấy danh sách tài xế
        $query = Driver::query();

        // Tìm kiếm theo tên, email, phone hoặc driver_license_number
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('driver_license_number', 'like', "%{$search}%");
        }

        // Sắp xếp theo các cột được chỉ định
        if (in_array($sortBy, ['name', 'email', 'phone', 'driver_license_number'])) {
            if ($sortBy == 'name' || $sortBy == 'email') {
                $query->join('users', 'drivers.user_id', '=', 'users.id')
                    ->select('drivers.*', 'users.name', 'users.email')
                    ->orderBy('users.' . $sortBy, $sortOrder);
            } else {
                $query->orderBy($sortBy, $sortOrder);
            }
        }

        // Phân trang dữ liệu
        $drivers = $query->paginate(5);

        return view('drivers.index', compact('drivers', 'search', 'sortBy', 'sortOrder'));
    }

    // Hiển thị form tạo mới (Create Form)
    public function create()
    {
        return view('drivers.create');
    }

    // Lưu thông tin tài xế mới (Store)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|max:20',
            'driver_license_number' => 'required|unique:drivers|max:50',
        ]);

        // Tạo user mới với vai trò tài xế
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role_id' => 1, // Giả định 1 là role của Driver
        ]);

        // Tạo tài xế mới
        Driver::create([
            'user_id' => $user->id,
            'phone' => $validatedData['phone'],
            'driver_license_number' => $validatedData['driver_license_number'],
        ]);

        return redirect()->route('drivers.index')->with('success', 'Tài xế đã được thêm thành công!');
    }

    // Hiển thị chi tiết tài xế
    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    // Hiển thị form chỉnh sửa tài xế (Edit Form)
    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    // Cập nhật thông tin tài xế (Update)
    public function update(Request $request, Driver $driver)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $driver->user_id,
            'phone' => 'required|max:20',
            'driver_license_number' => 'required|max:50|unique:drivers,driver_license_number,' . $driver->id,
        ]);

        // Cập nhật thông tin user
        $driver->user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Cập nhật thông tin tài xế
        $driver->update([
            'phone' => $validatedData['phone'],
            'driver_license_number' => $validatedData['driver_license_number'],
        ]);

        return redirect()->route('drivers.index')->with('success', 'Thông tin tài xế đã được cập nhật!');
    }

    // Xóa tài xế (Delete)
    public function destroy(Driver $driver)
    {
        // Xóa thông tin tài xế
        $driver->delete();
    
        // Xóa user liên quan
        $driver->user->delete();
    
        return redirect()->route('drivers.index')->with('success', 'Tài xế đã được xóa thành công!');
    }
}
