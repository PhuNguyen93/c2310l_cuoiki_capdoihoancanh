<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class RentalController extends Controller
{
    public function calculateTotalPrice(Request $request)
    {
        // Lấy dữ liệu từ yêu cầu
        $vehicleId = $request->input('vehicle_id');
        $borrowDate = $request->input('borrow_date');
        $returnDate = $request->input('return_date');

        // Lấy thông tin xe từ cơ sở dữ liệu
        $vehicle = Vehicle::find($vehicleId);

        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        // Tính số ngày mượn
        $borrowDate = new \DateTime($borrowDate);
        $returnDate = new \DateTime($returnDate);
        $interval = $borrowDate->diff($returnDate);
        $days = $interval->days;

        // Tính tổng tiền
        $totalPrice = $days * $vehicle->rental_price;

        return response()->json(['total_price' => $totalPrice]);
    }
}
