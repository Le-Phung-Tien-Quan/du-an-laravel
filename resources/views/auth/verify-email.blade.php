<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Minh Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<section class="login-section">
    <div class="login-form">
        <h2>XÁC MINH EMAIL</h2>
        <p>Cảm ơn bạn đã đăng ký! Hãy kiểm tra email để xác minh tài khoản.</p>

        @if (session('status') == 'verification-link-sent')
            <p class="success-message">Một liên kết xác minh mới đã được gửi đến email của bạn.</p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">Gửi lại email xác minh</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Đăng xuất</button>
        </form>
    </div>
</section>

</body>
</html>
