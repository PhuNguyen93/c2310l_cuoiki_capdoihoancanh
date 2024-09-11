<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        dd();
        if (!Auth::check()) {
            return redirect('login');
        }

        // Kiểm tra role của người dùng
        $user = Auth::user();
        if ($user->role->role_name !== $role) {
            return redirect('/'); // Chuyển hướng đến trang chủ nếu không có quyền
        }

        return $next($request);

    }
}
