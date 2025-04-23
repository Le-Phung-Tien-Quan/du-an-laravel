<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
{
    // Kiểm tra nếu người dùng chưa đăng nhập
    if (!auth()->check()) {
        return redirect('/login')->with('error', 'Bạn cần đăng nhập để truy cập.');
    }

    // Kiểm tra nếu người dùng đã đăng nhập nhưng không phải là admin
    if (auth()->user()->role !== 'admin') {
        // Người dùng không phải admin, trả về trang lỗi hoặc thông báo quyền hạn
        return response()->view('errors.404', [], 404);

    }

    // Nếu người dùng là admin, cho phép tiếp tục
    return $next($request);
}

}
