<?php

namespace App\Http\Controllers;

use App\Models\WarehouseManager;
use App\Models\WarehouseStaff;
use Illuminate\Http\Request;

class WarehouseStaffController extends Controller
{
    // Hiển thị danh sách người quản kho (Read, Sort, Filter, Pagination)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');

        $warehouseStaffs = WarehouseManager::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
            ->orderBy($sort, $direction)
            ->paginate(10);  // Phân trang

        return view('warehouse_staff.index', compact('warehouseStaffs'));
    }

    // Hiển thị form tạo mới (Create Form)
    public function create()
    {
        return view('warehouse_staff.create');
    }

    // Lưu thông tin người quản kho mới (Store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:warehouse_staffs|max:100',
            'password' => 'required|min:6',
            'phone_number' => 'required|max:20',
        ]);

        WarehouseManager::create($request->all());

        return redirect()->route('warehouse_staff.index')->with('success', 'Nhân viên quản kho đã được thêm thành công!');
    }

    // Hiển thị chi tiết người quản kho (Read Detail)
    public function show(WarehouseManager $warehouseStaff)
    {
        return view('warehouse_staff.show', compact('warehouseStaff'));
    }

    // Hiển thị form chỉnh sửa thông tin người quản kho (Edit Form)
    public function edit(WarehouseStaff $warehouseStaff)
    {
        return view('warehouse_staff.edit', compact('warehouseStaff'));
    }

    // Cập nhật thông tin người quản kho (Update)
    public function update(Request $request, WarehouseStaff $warehouseStaff)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:warehouse_staffs,email,' . $warehouseStaff->id,
            'phone_number' => 'required|max:20',
        ]);

        $warehouseStaff->update($request->all());

        return redirect()->route('warehouse_staff.index')->with('success', 'Thông tin nhân viên đã được cập nhật!');
    }

    // Xóa người quản kho (Delete)
    public function destroy(WarehouseStaff $warehouseStaff)
    {
        $warehouseStaff->delete();
        return redirect()->route('warehouse_staff.index')->with('success', 'Nhân viên đã được xóa thành công!');
    }
}
