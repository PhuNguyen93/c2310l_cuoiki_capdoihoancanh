<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\VehicleBorrowing;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $driver = Driver::where('user_id', Auth::id())->firstOrFail();
        $borrowings = VehicleBorrowing::where('driver_id', $driver->id)->get();

        // Trả dữ liệu qua view
        return view('profile', compact('driver', 'borrowings'));

    }
}
