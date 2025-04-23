@extends('layouts.user')
@section('body')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng của bạn</title>
    <link rel="stylesheet" href="{{ asset('') }}css/cart.css">
</head>
<body >
    <section class="cart-body">
        <h2>Giỏ hàng của bạn</h2>
        <div class="cart1">
        <table class="cart1-table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr>
                    <td>
                        <img src="{{ asset('') }}img/{{ $item['image'] }}" alt="Ghế da Armchair Dakway Đen" class="product-img">
                    </td>
                    <td>
                        <p>
                            <a href="/detail/{{ $item['slug'] }}">
                                {{ $item['name'] }}
                            </a>
                        </p>
                        <form action="/cart/remove/{{ $item['id'] }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn">Xóa</button>
                        </form>
                    </td>
                    <td class="price">
                        @if ($item['sale_price'])
                            <del>{{ number_format($item['price']) }} đ</del>
                            <p>{{ number_format($item['sale_price']) }} đ</p>
                        @else
                            <p>{{ number_format($item['price']) }} đ</p>
                        @endif
                    </td>
                   <!-- Giỏ hàng -->
                   <td>
                    <form action="/cart/update/{{ $item['id'] }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="quantity">
                            <input class="quantity-change" name="quantity" type="number" value="{{ $item['quantity'] }}" min="1">
                            <button type="submit" class="update-btn">Cập nhật</button>
                        </div>
                    </form>

                </td>

                    <td class="total">{{ number_format($item['total']) }} đ</td>
                </tr>
                @endforeach

            </tbody>
        </table>

        <div class="checkout">
            <h3>Thông tin hóa đơn</h3>
           <div class="tong"> <p>Tổng tiền: </p><span>{{ number_format($totalMoney) }} đ</span></div>
            <form action="/payment" id="frmCreateOrder" method="post" style="display: block;">
                @csrf
                <div class="form-group" style="display: none;">
                    <label for="amount">Số tiền</label>
                    <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="amount" type="number"
                    value="{{ $totalMoney }}" />
                </div>
                <div class="form-group" style="display: none;">
                    <!-- Các phương thức thanh toán, bạn có thể ẩn phần này nếu không muốn người dùng thấy -->
                    <h5>Cách 1: Chuyển hướng sang Cổng VNPAY chọn phương thức thanh toán</h5>
                    <input type="radio" Checked="True" id="bankCode" name="bankCode" value="">
                    <label for="bankCode">Cổng thanh toán VNPAYQR</label><br>
                    <input type="radio" id="bankCode" name="bankCode" value="VNPAYQR">
                    <label for="bankCode">Thanh toán bằng ứng dụng hỗ trợ VNPAYQR</label><br>
                    <input type="radio" id="bankCode" name="bankCode" value="VNBANK">
                    <label for="bankCode">Thanh toán qua thẻ ATM/Tài khoản nội địa</label><br>
                    <input type="radio" id="bankCode" name="bankCode" value="INTCARD">
                    <label for="bankCode">Thanh toán qua thẻ quốc tế</label><br>
                </div>
                <div class="form-group" style="display: none;">
                    <h5>Chọn ngôn ngữ giao diện thanh toán:</h5>
                    <input type="radio" id="language" Checked="True" name="language" value="vn">
                    <label for="language">Tiếng việt</label><br>
                    <input type="radio" id="language" name="language" value="en">
                    <label for="language">Tiếng anh</label><br>
                </div>
                <button type="submit" class="btn btn-default" style="display: inline-block;">Thanh toán</button>
            </form>

        </div>
    </div>

    <!-- Ẩn form nhưng giữ lại nút thanh toán -->
</section>

</body>
</html>
@endsection
