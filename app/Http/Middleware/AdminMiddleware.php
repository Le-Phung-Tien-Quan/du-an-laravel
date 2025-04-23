<?php
// app/Http/Middleware/Admin.php
// app/Http/Middleware/Admin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng không phải là admin
        if ($request->user() && $request->user()->role !== 'admin') {
            // Trả về trang lỗi 404
            return response()->view('errors.404', [], 404);
        }

        return $next($request);
    }
}
