<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $vehicles = Vehicle::all();
        return view('home', compact('vehicles'));
    }

     public function dashboard()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login first.');
        }

        // Kiểm tra nếu người dùng có role_id đúng
        if (Auth::user()->role_id != 2) {
            return redirect()->route('home')->with('error', 'You do not have the required permissions.');
        }

        // Xử lý trang dashboard nếu người dùng có quyền truy cập
        return view('dashboard');
    }
}
