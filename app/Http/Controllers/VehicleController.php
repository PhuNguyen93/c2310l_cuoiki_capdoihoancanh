<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Hiển thị danh sách xe (Read, Sort, Filter, Pagination)
    public function index(Request $request)
    {
        // Tìm kiếm theo biển số xe hoặc model
        $search = $request->input('search');

        // Lọc theo trạng thái
        $status = $request->input('status');

        // Sắp xếp (theo model hoặc brand)
        $sort = $request->input('sort', 'model');
        $direction = $request->input('direction', 'asc');

        // Lấy danh sách xe, lọc và sắp xếp
        $vehicles = Vehicle::when($search, function($query, $search) {
                return $query->where('license_plate', 'like', "%$search%")
                             ->orWhere('model', 'like', "%$search%");
            })
            ->when($status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy($sort, $direction)
            ->paginate(10);  // Phân trang với mỗi trang 10 xe

        return view('vehicles.index', compact('vehicles'));
    }

    // Hiển thị form tạo mới (Create Form)
    public function create()
    {
        return view('vehicles.create');
    }

    // Lưu thông tin xe mới (Store)
    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|unique:vehicles|max:20',
            'model' => 'required|max:100',
            'brand' => 'required|max:100',
            'status' => 'required|in:available,borrowed',
        ]);

        // Tạo xe mới
        Vehicle::create($request->all());

        return redirect()->route('vehicles.index')->with('success', 'Xe đã được thêm thành công!');
    }

    // Hiển thị chi tiết xe (Read Detail)
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    // Hiển thị form chỉnh sửa thông tin xe (Edit Form)
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    // Cập nhật thông tin xe (Update)
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'license_plate' => 'required|max:20|unique:vehicles,license_plate,' . $vehicle->id,
            'model' => 'required|max:100',
            'brand' => 'required|max:100',
            'status' => 'required|in:available,borrowed',
        ]);

        // Cập nhật thông tin xe
        $vehicle->update($request->all());

        return redirect()->route('vehicles.index')->with('success', 'Thông tin xe đã được cập nhật!');
    }

    // Xóa xe (Delete)
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Xe đã được xóa thành công!');
    }
}
