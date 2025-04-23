@extends('layouts.app')

@section('content')
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
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
