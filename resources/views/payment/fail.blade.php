<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận thanh toán thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .checkmark {
            font-size: 50px;
            color: green;
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
        }
        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="checkmark">✔️</div>
        <h1>Thanh toán thành công!</h1>
        <p>Cảm ơn bạn đã thực hiện thanh toán. Đơn hàng của bạn đang được xử lý.</p>
        <a href="/" class="btn">Quay lại trang chủ</a>
    </div>
</body>
</html>
