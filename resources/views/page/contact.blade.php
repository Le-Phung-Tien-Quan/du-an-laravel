@extends('layouts.user')
@section('body')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('') }}css/contact.css">
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
        @if(Request::is('shop'))
            <li class="active">Cửa hàng</li>
        @elseif(Request::is('contact'))
            <li class="active">Liên hệ</li>
        @elseif(Request::is('cart'))
            <li class="active">Giỏ hàng</li>
        @elseif(Request::is('product/*'))
            <li><a href="{{ url('/shop') }}">Cửa hàng</a></li>
            <li class="active">Chi tiết sản phẩm</li>
        @endif
    </ul>
</nav>
<section class="contact-section">
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4257952988432!2d106.62777543178227!3d10.855183522224252!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752b6c59ba4c97%3A0x535e784068f1558b!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1743044140199!5m2!1svi!2s" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="contact-info">
        <div class="info-box">
            <h3>Thông tin liên hệ</h3>
            <p><i class="fas fa-map-marker-alt"></i> Tầng 6, Tòa Ladeco, 266 Đội Cấn, Ba Đình, TP Hà Nội</p>
            <p><i class="fas fa-envelope"></i> support@sapo.vn</p>
            <p><i class="fas fa-phone"></i> 1800.6750</p>
            <p><i class="fa-solid fa-clock"></i> T2 - T6: 8AM - 5PM</p>
            <p style="margin-left: 25px;">T7 - CN: 8AM - 2PM</p>
        </div>
        <div class="contact-form">
            <h3>Gửi liên hệ cho chúng tôi</h3>
            <form>
                <input class="ten" type="text" placeholder="Họ và tên">
                <input class="dt" type="text" placeholder="Điên thoại">
                <input class="email" type="email" placeholder="Email">
                <input class="td" type="text" placeholder="Tiêu đề">
                <textarea placeholder="Nội dung"></textarea>
                <button type="submit">GỬI THÔNG TIN</button>
            </form>
        </div>
    </div>
</section>
<section class="collection">
    <div class="container-c">
        <div class="view-more">
        <h1>Các sản phẩm liên quan</h1>
        <a href="#">Xem tất cả →</a>
        </div>
        <div class="collection-grid">
            <div class="item">
                <div class="item-image">
                    <img src="img/den-nguoi-om-bong-den.png" alt="Đèn người ôm bóng đèn">
                    <div class="discount-badge">-10%</div>
                    <button class="favorite-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="item-details">
                    <h3>ĐÈN NGƯỜI ÔM BÓNG ĐÈN</h3>
                    <p class="price-tag">15.000.000 ₫</p>
                    <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                </div>
            </div>
            <div class="item">
                <div class="item-image">
                    <img src="img/den-nguoi-om-bong-den.png" alt="Đèn người ôm bóng đèn">
                    <div class="discount-badge">-10%</div>
                    <button class="favorite-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="item-details">
                    <h3>ĐÈN NGƯỜI ÔM BÓNG ĐÈN</h3>
                    <p class="price-tag">15.000.000 ₫</p>
                    <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                </div>
            </div>
            <div class="item">
                <div class="item-image">
                    <img src="img/den-nguoi-om-bong-den.png" alt="Đèn người ôm bóng đèn">
                    <div class="discount-badge">-10%</div>
                    <button class="favorite-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="item-details">
                    <h3>ĐÈN NGƯỜI ÔM BÓNG ĐÈN</h3>
                    <p class="price-tag">15.000.000 ₫</p>
                    <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                </div>
            </div>
            <div class="item">
                <div class="item-image">
                    <img src="img/den1.png" alt="Đèn trang trí Left Heat">
                    <div class="discount-badge">-50%</div>
                    <button class="favorite-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="item-details">
                    <h3>ĐÈN TRANG TRÍ LEFT HEAT</h3>
                    <p class="price-tag">5.500.000 ₫ <span class="old-price-tag">11.000.000 ₫</span></p>
                    <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
