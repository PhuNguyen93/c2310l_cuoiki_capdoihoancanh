<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        // Lấy dữ liệu từ các input tìm kiếm, lọc, sắp xếp
        $search = $request->input('search');
        $status = $request->input('status');
        $sortBy = $request->input('sort_by', 'created_at');  // Sắp xếp theo trường nào (mặc định là 'created_at')
        $sortOrder = $request->input('sort_order', 'desc');  // Thứ tự sắp xếp (mặc định là 'desc')

        // Tạo query để lấy danh sách xe
        $query = Vehicle::query();

        // Tìm kiếm theo tên xe hoặc biển số xe
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('vehicle_name', 'like', "%{$search}%")
                  ->orWhere('license_plate', 'like', "%{$search}%");
            });
        }

        // Lọc theo trạng thái xe
        if ($status) {
            $query->where('status', $status);
        }

        // Sắp xếp dữ liệu theo yêu cầu
        $query->orderBy($sortBy, $sortOrder);

        // Phân trang dữ liệu, mỗi trang hiển thị 10 kết quả
        $vehicles = $query->paginate(10);

        // Trả về view với dữ liệu đã được xử lý
        return view('vehicles.index', compact('vehicles', 'search', 'status', 'sortBy', 'sortOrder'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20|unique:vehicles',
            'image' => 'nullable|image|max:2048',
            'rental_price' => 'required|numeric|min:0',
        ]);

        // Lưu hình ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vehicle_images', 'public');
        }

        // Tạo xe mới với dữ liệu đã validate
        Vehicle::create([
            'vehicle_name' => $request->input('vehicle_name'),
            'license_plate' => $request->input('license_plate'),
            'image' => $imagePath,
            'rental_price' => $request->input('rental_price'),
            'status' => $request->input('status', 'Available'),
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'vehicle_name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20|unique:vehicles,license_plate,'.$vehicle->id,
            'image' => 'nullable|image|max:2048',
            'rental_price' => 'required|numeric|min:0',
        ]);

        // Cập nhật hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vehicle_images', 'public');
            $vehicle->image = $imagePath;
        }

        $vehicle->update([
            'vehicle_name' => $request->input('vehicle_name'),
            'license_plate' => $request->input('license_plate'),
            'rental_price' => $request->input('rental_price'),
            'status' => $request->input('status', $vehicle->status),
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}

