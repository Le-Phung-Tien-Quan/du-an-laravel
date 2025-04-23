<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<section class="login-section">
    <div class="login-form">
        <h2>ĐẶT LẠI MẬT KHẨU</h2>
        <p>Nhập mật khẩu mới của bạn.</p>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="form-group">
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email', $request->email) }}" required autofocus>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <input id="password" type="password" name="password" placeholder="Mật khẩu mới" required>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit">Đặt lại mật khẩu</button>
        </form>
    </div>
</section>

</body>
</html>
