<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Mail\RentalConfirmationMail;
use Illuminate\Support\Facades\Mail;

class VehicleRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkout($vehicleId)
{
    $vehicle = Vehicle::findOrFail($vehicleId);
    return view('checkout', compact('vehicle'));
}

public function confirmRental(Request $request)
{
    // Xử lý logic thuê xe, lưu thông tin vào cơ sở dữ liệu, v.v.

    // Redirect về trang chủ với thông báo thành công
    return redirect()->route('home')->with('success', 'Vehicle rented successfully!');
}

public function processCheckout(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'vehicleId' => 'required|integer',
            'recipientName' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'pickupDate' => 'required|date',
            'dropoffDate' => 'required|date',
            'pickupLocation' => 'required|string',
            'dropoffLocation' => 'required|string',
            'paymentMethod' => 'required|string',
        ]);

        // Handle checkout logic (store details in database, etc.)
        // ...

        // Send email confirmation
        Mail::to($validated['email'])->send(new RentalConfirmationMail($validated));

        // Display success message and redirect
        return redirect()->route('home')->with('success', 'Rental reservation successful. An email confirmation has been sent.');
    }



public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $vehicleId)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
