@extends('layouts.user')
@section('body')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<section class="login-section">
    <div class="login-form">
        <h2>ĐĂNG NHẬP</h2>
        <p>Nếu bạn chưa có tài khoản, <a href="{{ route('register') }}">đăng ký tại đây</a></p>

        <!-- Hiển thị lỗi nếu có -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Đăng Nhập -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <input id="password" type="password" name="password" placeholder="Mật khẩu" required>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    Ghi nhớ đăng nhập
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit">Đăng nhập</button>
        </form>

        <!-- Quên mật khẩu -->
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-password">Quên mật khẩu?</a>
        @endif

        <!-- Đăng nhập với mạng xã hội -->

    </div>
</section>

</body>
</html>
@endsection
