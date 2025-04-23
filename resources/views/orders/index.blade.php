@extends('layouts.app')

@section('content')
<style>
    /* Container cho toàn bộ phần danh sách đơn hàng */
.container {
    margin-top: 50px;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
}

/* Tiêu đề của bảng */
h2 {
    color: #333;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Cải tiến giao diện bảng */
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-collapse: collapse;
}

/* Định dạng các thẻ tiêu đề trong bảng */
.table th {
    padding: 12px;
    background-color: #007bff;
    color: white;
    text-align: center;
    font-weight: bold;
    border-radius: 6px 6px 0 0;
}

/* Định dạng các thẻ dữ liệu trong bảng */
.table td {
    padding: 12px;
    text-align: center;
    border-top: 1px solid #ddd;
}

/* Thêm các hiệu ứng hover cho các hàng trong bảng */
.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Cải thiện button "Xem Chi Tiết" */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

/* Đảm bảo trang có chiều rộng linh hoạt trên các màn hình nhỏ */
@media (max-width: 768px) {
    .table th, .table td {
        font-size: 14px;
        padding: 8px;
    }

    .container {
        padding: 10px;
    }

    h2 {
        font-size: 20px;
    }
}

</style>
<div class="container">
    <h2>Danh sách đơn hàng của bạn</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Đơn Hàng</th>
                <th>Ngày Đặt</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                    <td>
                        @switch($order->status)
                            @case('pending')
                                Chờ xác nhận
                                @break
                            @case('completed')
                                Đã hoàn thành
                                @break
                            @case('canceled')
                                Đã hủy
                                @break
                            @default
                                Chưa xác định
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
