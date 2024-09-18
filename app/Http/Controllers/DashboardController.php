<?php

namespace App\Http\Controllers;

use App\Models\VehicleBorrowing;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Lấy tất cả các lần mượn xe cùng với thông tin về driver và vehicle, sắp xếp theo mới nhất trước
        $borrowings = VehicleBorrowing::with(['driver.user', 'vehicle'])
            ->latest() // Gets the most recent first
            ->paginate(6); // Paginate with 6 borrowings per page

        // Truyền dữ liệu vào view
        return view('dashboard', compact('borrowings'));
    }
}