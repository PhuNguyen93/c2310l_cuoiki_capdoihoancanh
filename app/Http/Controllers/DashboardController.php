<?php

namespace App\Http\Controllers;

use App\Models\VehicleBorrowing;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Lấy tất cả các lần mượn xe cùng với thông tin về driver và vehicle
        $borrowings = VehicleBorrowing::with(['driver.user', 'vehicle'])->get();

        // Truyền dữ liệu vào view
        return view('dashboard', compact('borrowings'));
    }
}
