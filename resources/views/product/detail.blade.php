@extends('layouts.user')
@section('body')

<link rel="stylesheet" href="{{ asset('') }}css/deatil.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
        @if(Request::is('shop'))
            <li class="active">Cửa hàng</li>
        @elseif(Request::is('contact'))
            <li class="active">Liên hệ</li>
        @elseif(Request::is('cart'))
            <li class="active">Giỏ hàng</li>
        @elseif(Request::is('detail/*'))
            <li><a href="{{ url('/shop') }}">Cửa hàng</a></li>
            <li class="active">Chi tiết sản phẩm</li>
        @endif
    </ul>
</nav>
<section class="product-section">
    <div class="product-image">
        <img src="{{ asset('') }}img/{{ $product->image }}" alt="Sofa Chicago 3 chỗ">

    </div>
    <div class="product-details">
        <h1>{{ $product->name }}</h1>
        <p class="product-code">Mã sản phẩm: Đang cập nhật...</p>
        <p class="price">{{ number_format($product->price , 0, ',', '.')}} đ</p>
        <hr>
        <p class="color">Màu sắc: Xanh lá</p>
        <div class="color-options">
            <img src="{{ asset('') }}img/phongdep.png" alt="">
            <img src="{{ asset('') }}img/phongdep.png" alt="">
            <img src="{{ asset('') }}img/phongdep.png" alt="">
        </div>
        <hr>
        <p class="quantity">Số lượng: {{ $product->quantity }}</p>
        <form action="/cart" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}" >
        <div class="quantity-input">
            <input name="quantity" type="number" value="1" min="1" max="{{ $product->quantity }}">
        </div>
        <div class="actions">
            <button style="submit" class="add-to-cart">+ Thêm vào giỏ hàng</button>
            <a style="text-decoration:none;" href="/cart" class="buy-now">Mua ngay</a>
        </div>

    @if (session('sucess'))
    <div class="alert alert-succes mt-2">
        {{ session('sucess') }}
    </div>
    @endif
        <hr>
        <div class="policies">
            <h3>Quyền lợi & chính sách:</h3>
            <ul>
                {{ $product->description }}
            </ul>
        </div>
    </div>
</section>

<section class="collection">
    <div class="container3">
        <div class="view-more">
        <h1>Các sản phẩm liên quan</h1>
        <a href="#">Xem tất cả →</a>
        </div>
        <div class="collection-grid">
            @foreach ($relatedProducts as $item)
                 <div class="item">
                <div class="item-image">
                    <a href="/detail/{{ $item->slug }}"><img src="{{ asset('') }}img/{{ $item->image }}" alt="Đèn người ôm bóng đèn"></a>
                    @if ($item->sale_price !== null && $item->sale_price > 0)
                    <div class="discount-badge">-{{ round((($item->price - $item->sale_price) / $item->price) * 100) }}%</div>
                    @endif
                    <button class="favorite-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="item-details">
                    <h3 style="min-width: 330px;">{{ $item->name }}</h3>
                    <p class="price-tag">
                        {{ number_format($item->price, 0, ',', '.') }} đ
                        @if ($item->sale_price !== null)
                            <span class="old-price">{{ number_format($item->sale_price, 0, ',', '.') }} đ</span>
                        @endif
                    </p>
                    <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                </div>
            </div>
            @endforeach


        </div>

    </div>
</section>


<section class="blog-section">
    <div class="container4">
        <h2>Blog chia sẻ</h2>
        <div class="blog-posts">
            <div class="blog-item">
                <img src="{{ asset('') }}img/blog1.png" alt="Hướng dẫn tự decor phòng ngủ">
                <div class="blog-content">
                    <p class="date">Thứ năm, 30/11/2023, 11:36</p>
                    <h3>Hướng dẫn tự decor phòng ngủ đẹp và chuẩn phong thủy 2023</h3>
                    <p>Bạn đang tìm kiếm ý tưởng decor phòng ngủ? Bạn muốn tham khảo nhiều phong cách trang trí phòng ngủ đẹp và chi tiết nhất? Tham khảo hướng dẫn decor phòng ngủ dưới đây để tìm ra ý tưởng trang trí phù hợp nhất với bạn nhé...</p>

                </div>
            </div>
            <div class="blog-item">
                <img src="{{ asset('') }}img/blog2.png" alt="Ghế sofa bộ rời">
                <div class="blog-content">
                    <p class="date">Thứ năm, 30/11/2023, 11:29</p>
                    <h3>Ghế sofa bộ rời phù hợp với không gian phòng khách nào?</h3>
                    <p>Những bộ ghế sofa sang trọng hay hiện đại, đơn giản hay có điền đều mang lại phong cách riêng. Bạn thích kiểu dáng, thiết kế của những bộ ghế sofa bộ rời nhưng không biết có phù hợp với phòng khách nhà bạn hay không...</p>

                </div>
            </div>
            <div class="blog-item">
                <img src="{{ asset('') }}img/blog3.png" alt="Bí quyết chọn sofa cho phòng khách nhỏ">
                <div class="blog-content">
                    <p class="date">Thứ năm, 30/11/2023, 11:23</p>
                    <h3>Bí quyết chọn sofa cho phòng khách nhỏ</h3>
                    <p>Với không gian phòng khách nhỏ, việc lựa chọn sofa trở nên không còn đơn giản đối với nhiều gia đình. Nhưng điều đó không có nghĩa là quá khó khăn. Hãy để Showroom Hùng Tủy giúp bạn giải quyết mối lo ngại này. 1. Kiểm tra...</p>

                </div>
            </div>
        </div>
    </div>
</section>




@endsection
