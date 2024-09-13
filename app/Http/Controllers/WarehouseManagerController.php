<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WarehouseManager;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WarehouseManagerController extends Controller
{
    // Hiển thị danh sách quản lý kho (Read, Sort, Filter, Pagination)
    public function index(Request $request)
    {
        // if (Auth::user()->role_id != 2) { // Giả định role_id 2 là WarehouseManager
        //     return redirect()->route('home')->with('error', 'You do not have the required permissions.');
        // }

        // Lấy dữ liệu tìm kiếm và sắp xếp
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'name');  // Sắp xếp theo trường nào (mặc định là 'name')
        $sortOrder = $request->input('sort_order', 'asc');  // Thứ tự sắp xếp (mặc định là 'asc')

        // Tạo query để lấy danh sách quản lý kho
        $query = WarehouseManager::query();

        // Tìm kiếm theo tên, email
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Sắp xếp theo các cột được chỉ định
        if (in_array($sortBy, ['name', 'email'])) {
            $query->join('users', 'warehouse_managers.user_id', '=', 'users.id')
                ->select('warehouse_managers.*', 'users.name', 'users.email')
                ->orderBy('users.' . $sortBy, $sortOrder);
        }

        // Phân trang dữ liệu
        $warehouseManagers = $query->paginate(5);

        return view('warehouse_managers.index', compact('warehouseManagers', 'search', 'sortBy', 'sortOrder'));
    }

    // Hiển thị form tạo mới (Create Form)
    public function create()
    {
        return view('warehouse_managers.create');
    }

    // Lưu thông tin quản lý kho mới (Store)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|max:20',
            'employee_number' => 'required|max:255',
        ]);

        // Tạo user mới với vai trò Warehouse Manager
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role_id' => 2, // Giả định 2 là role của Warehouse Manager
        ]);

        // Tạo quản lý kho mới
        WarehouseManager::create([
            'user_id' => $user->id,
            'phone' => $validatedData['phone'],
            'employee_number' => $validatedData['employee_number'],
        ]);

        return redirect()->route('warehouse_managers.index')->with('success', 'Quản lý kho đã được thêm thành công!');
    }

    // Hiển thị chi tiết quản lý kho
    public function show(WarehouseManager $warehouseManager)
    {
        return view('warehouse_managers.show', compact('warehouseManager'));
    }

    // Hiển thị form chỉnh sửa quản lý kho (Edit Form)
    public function edit(WarehouseManager $warehouseManager)
    {
        return view('warehouse_managers.edit', compact('warehouseManager'));
    }

    // Cập nhật thông tin quản lý kho (Update)
    public function update(Request $request, WarehouseManager $warehouseManager)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $warehouseManager->user_id,
            'phone' => 'required|max:20',
        ]);

        // Cập nhật thông tin user
        $warehouseManager->user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Cập nhật thông tin quản lý kho
        $warehouseManager->update([
            'phone' => $validatedData['phone'],
        ]);

        return redirect()->route('warehouse_managers.index')->with('success', 'Thông tin quản lý kho đã được cập nhật!');
    }

    // Xóa quản lý kho (Delete)
    public function destroy(WarehouseManager $warehouseManager)
    {
        // Xóa user liên quan
        $warehouseManager->user->delete();
        $warehouseManager->delete();

        return redirect()->route('warehouse_managers.index')->with('success', 'Quản lý kho đã được xóa thành công!');
    }
}
