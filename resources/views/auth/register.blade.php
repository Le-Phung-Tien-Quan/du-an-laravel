@extends('layouts.user')
@section('body')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<section class="login-section">
    <div class="login-form">
        <h2>ĐĂNG KÝ</h2>
        <p>Nếu bạn đã có tài khoản, <a href="{{ route('login') }}">đăng nhập tại đây</a></p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <input id="name" type="text" name="name" placeholder="Họ và tên" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
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

            <!-- Confirm Password -->
            <div class="form-group">
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit">Đăng ký</button>
        </form>

        <!-- Đăng ký với mạng xã hội -->

    </div>
</section>

</body>
</html>
@endsection
