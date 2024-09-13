<?php

namespace App\Http\Controllers;

use App\Models\VehicleBorrowing;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class VehicleBorrowingController extends Controller
{
    public function index()
    {
        $borrowings = VehicleBorrowing::where('driver_id', Auth::id())->get();
        return view('vehicle_borrwings.index', compact('borrowings'));
    }

    public function create()
    {
        $vehicles = Vehicle::whereDoesntHave('borrowings', function($query) {
            $query->whereNull('return_date');
        })->get();
        return view('vehicle_borrowings.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'borrow_date' => 'required|date',
        ]);

        VehicleBorrowing::create([
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => Auth::id(),
            'borrow_date' => $request->borrow_date,
        ]);

        return redirect()->route('vehicle_borrowings.index')->with('success', 'Vehicle borrowed successfully!');
    }

    public function returnVehicle($id)
    {
        $borrowing = VehicleBorrowing::findOrFail($id);

        if ($borrowing->driver_id != Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        $borrowing->update([
            'return_date' => now(),
            'status' => 'Returned'
        ]);

        return redirect()->route('vehicle_borrowings.index')->with('success', 'Vehicle returned successfully!');
    }

    public function borrowVehicle(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'borrow_date' => 'required|date',
        ]);

        VehicleBorrowing::create([
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => Auth::id(),
            'borrow_date' => $request->borrow_date,
        ]);

        return response()->json(['success' => 'Vehicle borrowed successfully!']);
    }
}
