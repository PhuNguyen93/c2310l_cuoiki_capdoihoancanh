<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use App\Models\VehicleBorrowing;
class VehicleController extends Controller
{
    // Hiển thị danh sách xe (Read, Sort, Filter, Pagination)
    public function index(Request $request)
    {
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
            'license_plate' => 'required|unique:vehicles|max:20',
            'model' => 'required|max:100',
            'brand' => 'required|max:100',
            'status' => 'required|in:available,borrowed',
        ]);

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
        $validatedData = $request->validate([
            'license_plate' => 'required|max:20|unique:vehicles,license_plate,' . $vehicle->id,
            'model' => 'required|max:100',
            'brand' => 'required|max:100',
            'status' => 'required|in:available,borrowed',
        ]);

        // Cập nhật thông tin xe
        $vehicle->update($validatedData);

        return redirect()->route('vehicles.index')->with('success', 'Thông tin xe đã được cập nhật!');
    }

    // Xóa thông tin xe (Delete)
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Xe đã được xóa thành công!');
    }

    public function borrowVehicle(Request $request)
    {
        // Validate the request data
        $request->validate([
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date',
            'total_price' => 'required|numeric',
        ]);

        // Create a new vehicle borrowing record
        $borrowing = VehicleBorrowing::create([
            'vehicle_id' => $request->input('vehicle_id'),
            'driver_id' => Auth::id(), // Assuming the user is authenticated and is a driver
            'borrow_date' => $request->input('borrow_date'),
            'return_date' => $request->input('return_date'),
            'status' => 'Borrowed',
        ]);

        // Respond with success
        return response()->json(['success' => true]);
    }
}
