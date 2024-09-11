<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    // Hiển thị danh sách tài xế (Read, Sort, Filter, Pagination)
    public function index(Request $request)
    {
        if (Auth::user()->role_id != 2) {
            return redirect()->route('home')->with('error', 'You do not have the required permissions.');
        }
        $search = $request->input('search');
        $sort = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');

        $drivers = Driver::when($search, function($query, $search) {
                return $query->where('name', 'like', "%$search%")
                             ->orWhere('license_number', 'like', "%$search%");
            })
            ->orderBy($sort, $direction)
            ->paginate(10);  // Phân trang

        return view('drivers.index', compact('drivers'));
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
