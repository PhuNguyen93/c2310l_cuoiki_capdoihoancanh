<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Không cần truyền danh sách roles nữa
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);

        // Tạo tài khoản với role_id mặc định là 1 (Driver)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => 1, // Role_id là 1 cho tài xế
        ]);


        // Đăng nhập người dùng sau khi đăng ký
        Auth::login($user);

        // Chuyển hướng đến trang home sau khi đăng nhập thành công
        return redirect()->route('home');
    }
}
