<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào với nhiều quy tắc
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',  // Kiểm tra email tồn tại trong bảng users
            'password' => 'required|string|min:8',           // Mật khẩu phải có ít nhất 8 ký tự
            'phone' => 'nullable|regex:/^(0[0-9]{9})$/',      // Kiểm tra số điện thoại hợp lệ (nếu có)
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
        ]);

        // Kiểm tra tài khoản và mật khẩu
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['error' => 'Tài khoản hoặc mật khẩu sai']);
        }

        // Nếu thành công, tạo token cho người dùng
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }


}
