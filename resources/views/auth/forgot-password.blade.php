<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<section class="login-section">
    <div class="login-form">
        <h2>QUÊN MẬT KHẨU</h2>
        <p>Nhập email của bạn để nhận liên kết đặt lại mật khẩu</p>

        <!-- Session Status -->
        @if (session('status'))
            <p class="success-message">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit">Gửi liên kết đặt lại mật khẩu</button>
        </form>

        <a href="{{ route('login') }}" class="forgot-password">Quay lại đăng nhập</a>
    </div>
</section>

</body>
</html>
