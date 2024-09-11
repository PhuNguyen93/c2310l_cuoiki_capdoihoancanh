<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $roleId
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roleId)
    {
        // Kiểm tra nếu người dùng đã đăng nhập và có vai trò đúng
        if (Auth::check() && Auth::user()->role_id == $roleId) {
            return $next($request);
        }

        // Nếu không, chuyển hướng đến trang khác (ví dụ trang chính)
        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
}
