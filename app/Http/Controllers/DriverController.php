<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    // Hiển thị danh sách tài xế (Read, Sort, Filter, Pagination)
    public function index(Request $request)
{

    // Lấy dữ liệu từ các input tìm kiếm và sắp xếp
    $search = $request->input('search');
    $sortBy = $request->input('sort_by', 'name');  // Mặc định sắp xếp theo tên
    $sortOrder = $request->input('sort_order', 'asc');  // Mặc định thứ tự sắp xếp là tăng dần

    // Tạo query để lấy danh sách tài xế
    $query = Driver::query();

    // Tìm kiếm theo tên hoặc số giấy phép lái xe
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('license_number', 'like', "%{$search}%");
        });
    }

    // Sắp xếp dữ liệu theo yêu cầu
    $query->orderBy($sortBy, $sortOrder);

    // Phân trang dữ liệu, mỗi trang hiển thị 5 kết quả
    $drivers = $query->paginate(5);

    // Trả về view với dữ liệu đã được xử lý
    return view('drivers.index', compact('drivers', 'search', 'sortBy', 'sortOrder',));
}

    // Hiển thị form tạo mới (Create Form)
    public function create()
    {
        return view('drivers.create');
    }

    // Lưu thông tin tài xế mới (Store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'license_number' => 'required|max:50|unique:drivers',
            'phone_number' => 'required|max:20',
            'address' => 'required|max:255',
        ]);

        Driver::create($request->all());

        return redirect()->route('drivers.index')->with('success', 'Tài xế đã được thêm thành công!');
    }

    // Hiển thị chi tiết tài xế (Read Detail)
    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    // Hiển thị form chỉnh sửa thông tin tài xế (Edit Form)
    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    // Cập nhật thông tin tài xế (Update)
    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|max:100',
            'license_number' => 'required|max:50|unique:drivers,license_number,' . $driver->id,
            'phone_number' => 'required|max:20',
            'address' => 'required|max:255',
        ]);

        $driver->update($request->all());

        return redirect()->route('drivers.index')->with('success', 'Thông tin tài xế đã được cập nhật!');
    }

    // Xóa tài xế (Delete)
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Tài xế đã được xóa thành công!');
    }
}
