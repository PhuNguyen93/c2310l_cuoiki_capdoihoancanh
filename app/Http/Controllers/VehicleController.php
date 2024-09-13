<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleBorrowing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    // Hiển thị danh sách xe (Read, Sort, Filter, Pagination)
    public function index(Request $request)
    {
        // Kiểm tra quyền truy cập (role_id phải là 2 để truy cập)
        if (Auth::user()->role_id != 2) {
            return redirect()->route('home')->with('error', 'You do not have the required permissions.');
        }

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

        // Phân trang dữ liệu, mỗi trang hiển thị 5 kết quả
        $vehicles = $query->paginate(5);

        // Trả về view với dữ liệu đã được xử lý
        return view('vehicles.index', compact('vehicles', 'search', 'status', 'sortBy', 'sortOrder'));
    }

    // Hiển thị form tạo mới (Create Form)
    public function create()
    {
        return view('vehicles.create');
    }

    // Lưu thông tin xe mới (Store)
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'vehicle_name' => 'required|max:255',
        'license_plate' => 'required|unique:vehicles|max:20',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'rental_price' => 'required|numeric',
        'status' => 'required|in:available,borrowed',
    ]);

    // Xử lý hình ảnh
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('vehicles', 'public');
        $validatedData['image'] = $imagePath;
    }

    // Tạo xe mới
    Vehicle::create($validatedData);

    return redirect()->route('vehicles.index')->with('success', 'Xe đã được thêm thành công!');
}

    // Hiển thị chi tiết xe
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    // Hiển thị form chỉnh sửa xe (Edit Form)
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    // Cập nhật thông tin xe (Update)
    public function update(Request $request, Vehicle $vehicle)
{
    // Validate the input fields
    $validatedData = $request->validate([
        'vehicle_name' => 'required|max:255',
        'license_plate' => 'required|max:20|unique:vehicles,license_plate,' . $vehicle->id,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        'rental_price' => 'required|numeric',
        'status' => 'required|in:Available,Borrowed',
    ]);

    // If a new image is uploaded, handle the image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($vehicle->image) {
            Storage::delete('public/' . $vehicle->image);
        }

        // Store the new image and update the path in the database
        $validatedData['image'] = $request->file('image')->store('vehicles', 'public');
    } else {
        // Keep the old image if no new image is uploaded
        $validatedData['image'] = $vehicle->image;
    }

    // Update the vehicle with the new data
    $vehicle->update($validatedData);

    // Redirect to the vehicle list with success message
    return redirect()->route('vehicles.index')->with('success', 'Thông tin xe đã được cập nhật!');
}

    // Xóa thông tin xe (Delete)
    public function destroy(Vehicle $vehicle)
    {
        // Xóa xe
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Xe đã được xóa thành công!');
    }

    // Chức năng mượn xe
    public function borrowVehicle(Request $request)
    {
        // Validate the request data
        $request->validate([
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date',
        ]);

        // Create a new vehicle borrowing record
        VehicleBorrowing::create([
            'vehicle_id' => $request->input('vehicle_id'),
            'driver_id' => Auth::id(), // Sử dụng driver_id từ người dùng hiện tại
            'borrow_date' => $request->input('borrow_date'),
            'return_date' => $request->input('return_date'),
            'status' => 'Borrowed',
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Bạn đã mượn xe thành công!');
    }
}
