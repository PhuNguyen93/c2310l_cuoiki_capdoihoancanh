<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        // Truy vấn tất cả các xe
        $vehicles = Vehicle::select('id', 'license_plate', 'color', 'year', 'status')
            ->paginate(10);

        return view('vehicles.index', compact('vehicles'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'license_plate' => 'required|unique:vehicles|max:255',
            'color' => 'required',
            'year' => 'required|integer',
            // 'brand' => 'required|max:255',
            // 'model' => 'required|max:255',
            'status' => 'required|in:available,unavailable',
        ]);

        // Tạo một xe mới với thông tin đã validate
        $vehicle = new Vehicle([
            'license_plate' => $request->get('license_plate'),
            'color' => $request->get('color'),
            'year' => $request->get('year'),
            // 'brand' => $request->get('brand')
            // 'model' => $request->get('model')
            'status' => $request->get('status'),
        ]);

        $vehicle->save();

        return redirect('/vehicles')->with('success', 'Vehicle saved!');
    }

    // Hiển thị form tạo mới (Create Form)
    public function create()
    {
        return view('vehicles.create');
    }

    // Hiển thị chi tiết xe (Read Detail)
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    // Hiển thị form chỉnh sửa thông tin xe (Edit Form)
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'license_plate' => 'required|max:255',
            'color' => 'required',
            'year' => 'required|integer',
            // 'brand' => 'required|max:255'
            // 'model' => 'required|max:255'
            'status' => 'required|in:available,unavailable',
        ]);

        // Cập nhật xe với thông tin đã validate
        $vehicle = Vehicle::find($id);
        $vehicle->license_plate = $request->get('license_plate');
        $vehicle->color = $request->get('color');
        $vehicle->year = $request->get('year');
        // $vehicle->brand = $request->get('brand')
        // $vehicle->model = $request->get('model')
        $vehicle->status = $request->get('status');

        $vehicle->save();

        return redirect('/vehicles')->with('success', 'Vehicle updated!');
    }

    // Xóa xe (Delete)
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Xe đã được xóa thành công!');
    }
}
