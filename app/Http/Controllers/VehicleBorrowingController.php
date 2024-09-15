<?php

namespace App\Http\Controllers;

use App\Models\VehicleBorrowing;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\RentalConfirmationMail;
use Illuminate\Support\Facades\Mail;


class VehicleBorrowingController extends Controller
{
    public function index()
    {
        $borrowings = VehicleBorrowing::where('driver_id', Auth::id())->get();
        return view('vehicle_borrowings.index', compact('borrowings'));
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
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'vehicleId' => 'required|exists:vehicles,id',
        'recipientName' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email',
        'pickupDate' => 'required|date',
        'dropoffDate' => 'required|date|after:pickupDate',
        'pickupLocation' => 'required|string|max:255',
        'dropoffLocation' => 'required|string|max:255',
        'paymentMethod' => 'required|in:cash,local_card,visa',
    ]);

    // Lấy ID của người dùng hiện tại
    $userId = Auth::id();

    // Tạo mới bản ghi trong bảng vehicle_borrowings với driver_id là user_id
    $vehicleBorrowing = new VehicleBorrowing();
    $vehicleBorrowing->vehicle_id = $request->vehicleId;
    $vehicleBorrowing->driver_id = $userId;
    $vehicleBorrowing->borrow_date = $request->pickupDate;
    $vehicleBorrowing->status = 'Borrowed';
    $vehicleBorrowing->save();

    // Cập nhật trạng thái của xe
    $vehicle = Vehicle::find($request->vehicleId);
    $vehicle->status = 'Borrowed';
    $vehicle->save();

     // Tính toán tổng giá thuê
     $totalPrice = $this->calculateTotalPrice($request->vehicleId, $request->pickupDate, $request->dropoffDate);

     // Dữ liệu gửi email
      $details = [
        'recipientName' => $request->recipientName,
        'vehicleId' => $request->vehicleId,
        'pickupDate' => $request->pickupDate,
        'dropoffDate' => $request->dropoffDate,
        'pickupLocation' => $request->pickupLocation,
        'dropoffLocation' => $request->dropoffLocation,
        'paymentMethod' => $request->paymentMethod,
        'totalPrice' => $totalPrice,
    ];

    // Gửi email xác nhận (tuỳ chọn)
    // Mail::to($request->email)->send(new VehicleBorrowingConfirmationMail($vehicleBorrowing));
    Mail::to($request->email)->send(new RentalConfirmationMail($details));

    // Điều hướng về trang chủ với thông báo thành công
    return redirect('/')->with('success', 'Vehicle borrowing registered successfully!');
}
private function calculateTotalPrice($vehicleId, $pickupDate, $dropoffDate)
{
    // Logic để tính tổng giá thuê
    $vehicle = Vehicle::find($vehicleId);
    $pickupDate = new \DateTime($pickupDate);
    $dropoffDate = new \DateTime($dropoffDate);
    $interval = $pickupDate->diff($dropoffDate);
    $numberOfDays = $interval->days;
    return $vehicle->rental_price * $numberOfDays;
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
