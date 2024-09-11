<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

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
    // Lấy dữ liệu từ form
    $vehicleId = $request->input('vehicleId');
    $recipientName = $request->input('recipientName');
    $phone = $request->input('phone');
    $pickupLocation = $request->input('pickupLocation');
    $dropoffLocation = $request->input('dropoffLocation');
    $paymentMethod = $request->input('paymentMethod');

    // Thêm logic lưu dữ liệu thanh toán vào database nếu cần

    // Chuyển hướng người dùng đến trang thành công hoặc trang khác sau khi xử lý xong
    return redirect()->route('success');
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
