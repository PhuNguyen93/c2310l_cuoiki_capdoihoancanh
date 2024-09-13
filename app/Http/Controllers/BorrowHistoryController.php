<?php

namespace App\Http\Controllers;

use App\Models\BorrowHistory;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;

class BorrowHistoryController extends Controller
{
    // Hiển thị lịch sử mượn (Read, Sort, Filter, Pagination)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'borrow_date');
        $direction = $request->input('direction', 'desc');

        $borrowHistories = BorrowHistory::when($search, function($query, $search) {
                return $query->whereHas('driver', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate(10);  // Phân trang

        return view('borrow_histories.index', compact('borrowHistories'));
    }

    // Tạo mới một bản ghi mượn (Create Form)
    public function create()
    {
        $vehicles = Vehicle::where('status', 'available')->get();
        $drivers = Driver::all();
        return view('borrow_histories.create', compact('vehicles', 'drivers'));
    }

    // Lưu thông tin mượn mới (Store)
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date|after:borrow_date',
            'status' => 'required|in:pending,approved,returned',
        ]);

        BorrowHistory::create($request->all());

        return redirect()->route('borrow_histories.index')->with('success', 'Lịch sử mượn đã được thêm thành công!');
    }

    // Cập nhật thông tin mượn (Edit Form)
    public function edit(BorrowHistory $borrowHistory)
    {
        $vehicles = Vehicle::where('status', 'available')->get();
        $drivers = Driver::all();
        return view('borrow_histories.edit', compact('borrowHistory', 'vehicles', 'drivers'));
    }

    // Cập nhật thông tin mượn (Update)
    public function update(Request $request, BorrowHistory $borrowHistory)
    {
        $request->validate([
            'return_date' => 'nullable|date|after:borrow_date',
            'status' => 'required|in:pending,approved,returned',
        ]);

        $borrowHistory->update($request->all());

        return redirect()->route('borrow_histories.index')->with('success', 'Thông tin lịch sử mượn đã được cập nhật!');
    }

    // Xóa lịch sử mượn (Delete)
    public function destroy(BorrowHistory $borrowHistory)
    {
        $borrowHistory->delete();
        return redirect()->route('borrow_histories.index')->with('success', 'Lịch sử mượn đã được xóa thành công!');
    }

}
