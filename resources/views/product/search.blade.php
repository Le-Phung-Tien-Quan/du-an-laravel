@extends('layouts.shop')

@section('shop')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục sản phẩm</title>
    <link rel="stylesheet" href="{{ asset('') }}css/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <div class="product-grid-s">
        @if (isset($message))  <!-- Kiểm tra nếu có thông báo -->
        <p>{{ $message }}</p>  <!-- Hiển thị thông báo -->
    @else
        @foreach ($products as $item)
            <div class="item">
                <div class="item-image">
                    <a href="/detail/{{ $item->slug }}"><img src="{{ asset('img/' . $item->image) }}" alt="{{ $item->name }}"></a>
                    @if ($item->sale_price !== null)
                        <div class="discount-badge">-{{ round((($item->price - $item->sale_price) / $item->price) * 100) }}%</div>
                    @endif
                    <button class="favorite-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="item-details">
                    <h3 style="min-width: 330px;">{{ $item->name }}</h3>
                    @if ($item->sale_price !== null)
                        <p class="price-tag">{{ number_format($item->sale_price, 0, ',', '.') }} ₫
                            <span class="old-price-tag">{{ number_format($item->price, 0, ',', '.') }} ₫</span>
                        </p>
                    @endif
                    <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</body>
</html>
@endsection
