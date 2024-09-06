<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        // Lấy dữ liệu từ các input tìm kiếm, lọc, sắp xếp
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'created_at');  // Sắp xếp theo trường nào (mặc định là 'created_at')
        $sortOrder = $request->input('sort_order', 'desc');  // Thứ tự sắp xếp (mặc định là 'desc')

        // Tạo query để lấy danh sách tài xế
        $query = Driver::query();

        // Tìm kiếm theo tên tài xế, số điện thoại hoặc số giấy phép lái xe
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('driver_license_number', 'like', "%{$search}%");
            });
        }

        // Sắp xếp dữ liệu theo yêu cầu
        $query->orderBy($sortBy, $sortOrder);

        // Phân trang dữ liệu, mỗi trang hiển thị 5 kết quả
        $drivers = $query->paginate(5);

        // Trả về view với dữ liệu đã được xử lý
        return view('drivers.index', compact('drivers', 'search', 'sortBy', 'sortOrder'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:drivers',
            'driver_license_number' => 'required|string|max:50',
        ]);

        // Tạo tài xế mới với dữ liệu đã validate và gán user_id
        Driver::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'driver_license_number' => $request->input('driver_license_number'),
            'user_id' => auth()->id(), // Gán user_id cho tài xế
        ]);

        return redirect()->route('drivers.index')->with('success', 'Driver created successfully.');
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:drivers,phone,'.$driver->id,
            'driver_license_number' => 'required|string|max:50',
        ]);

        $driver->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'driver_license_number' => $request->input('driver_license_number'),
            // Không cập nhật user_id vì nó không nên thay đổi
        ]);

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }
}