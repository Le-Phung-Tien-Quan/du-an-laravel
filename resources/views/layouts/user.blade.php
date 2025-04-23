<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<header>
    <div class="container2">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="OH! Decor Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li><a href="/shop">Cửa hàng</a></li>
                <li class="dropdown">
                    <a href="#">Sản phẩm <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="product-dropdown">
                        <div class="product-grid">
                            <div class="category">
                                <h3>Hiện đại</h3>
                                <ul>
                                    <li>Giường</li>
                                    <li>Tủ</li>
                                    <li>Đèn</li>
                                    <li>Cây trang trí</li>
                                    <li>Tranh treo tường</li>
                                </ul>
                            </div>
                            <div class="category">
                                <h3>Cổ điển</h3>
                                <ul>
                                    <li>Giường</li>
                                    <li>Tủ</li>
                                    <li>Đèn</li>
                                    <li>Cây trang trí</li>
                                    <li>Tranh treo tường</li>
                                </ul>
                            </div>
                            <div class="category">
                                <h3>Đơn giản</h3>
                                <ul>
                                    <li>Giường</li>
                                    <li>Tủ</li>
                                    <li>Đèn</li>
                                    <li>Cây trang trí</li>
                                    <li>Tranh treo tường</li>
                                </ul>
                            </div>
                            <div class="category">
                                <h3>Sang trọng</h3>
                                <ul>
                                    <li>Giường</li>
                                    <li>Tủ</li>
                                    <li>Đèn</li>
                                    <li>Cây trang trí</li>
                                    <li>Tranh treo tường</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#">Blog <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="blog-dropdown">
                        <ul>
                            <li><a href="#">Tin tức</a></li>
                            <li><a href="#">Dự án</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="/contact">Liên hệ</a></li>
                <li class="dropdown">
                    <a href="#">Dự án <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="blog-dropdown">
                        <ul>
                            <li><a href="#">Chung cư</a></li>
                            <li><a href="#">Dự án</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <form action="{{ route('search') }}" method="GET" class="search-box">
            <span class="search-icon"><i class="fa-solid fa-magnifying-glass white"></i></span>
            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm" required>
            <button type="submit" style="display: none;"></button>
        </form>

        <nav class="cart">
            <li class="dropdown">
                @auth
                    <a href="/orders" class="white"><i class="fa-solid fa-user"></i> {{ Auth::user()->name }}</a>
                    <div class="blog-dropdown">
                        <ul>
                            <li><a href="{{ route('profile.edit') }}">Chỉnh sửa hồ sơ</a></li>
                            @php
                            $user = Auth::user();
                        @endphp

                        @if ($user && $user->role === 'admin')
                            <li><a href="{{ route('admin') }}">Trang quản trị</a></li>
                        @endif
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                        </ul>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="white">Đăng nhập</a> |
                    <a href="{{ route('register') }}" class="white">Đăng ký</a>
                @endauth
            </li>

            <li><a href="#">|</a></li>
            <li><a href="/cart" class="white"><i class="fa-solid fa-cart-shopping"></i></a></li>
        </nav>
    </div>
</header>


@yield('body')

<link rel="stylesheet" href="{{ asset('') }}css/footer.css">
<footer class="footer">
    <div class="footer-top">
        <div class="footer-left">
            <img src="{{ asset('') }}img/footer.png" alt="Ghế bành">
        </div>
        <div class="footer-right">
            <h2>Theo dõi và cập nhật tin tức mới nhất</h2>
            <p>Khám phá nội thất thiết kế đương đại mang đến cảm giác thoải mái, sang trọng. Cá nhân hoá trong từng sản phẩm phù hợp với mọi không gian sống.</p>
            <div class="subscribe">
                <input type="email" placeholder="Nhập email của bạn">
                <button>Theo dõi →</button>
            </div>
        </div>
    </div>
    <div class="footer-bottom" style="padding-bottom: 30px;">
        <div class="footer-section">
            <h3>THÔNG TIN LIÊN HỆ</h3>
            <p>Công ty cổ phần OHIDecor</p>
            <p><i class="fas fa-map-marker-alt"></i> Tầng 6, Tòa Ladeco, 266 Đội Cấn, Ba Đình, Hà Nội</p>
            <p>1800.6750</p>
            <p>support@sapo.vn</p>
        </div>
        <div class="footer-section">
            <h3>CHĂM SÓC KHÁCH HÀNG</h3>
            <p>Thời gian hỗ trợ 24/7 không kể ngày lễ</p>
            <p>Hotline 1800.6750</p>
        </div>
        <div class="footer-section">
            <h3>HƯỚNG DẪN</h3>
            <p>Chính sách mua bán</p>
            <p>Hệ thống kiểm duyệt</p>
            <p>Chính sách bảo mật</p>
            <p>Quy định đối với người bán</p>
            <p>Hướng dẫn mua hàng</p>
        </div>
        <div class="footer-section">
            <h3>KẾT NỐI</h3>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <h3 style="margin-top: 10px;">PHƯƠNG THỨC THANH TOÁN</h3>
            <div class="payment-methods">
                <img src="{{ asset('') }}img/order.png" alt="Visa">
            </div>
        </div>
    </div>
    <hr>
    <div class="footer-bottom1">
            <img src="{{ asset('') }}img/logo.png" alt="OH! Decor Logo">
            <p>Bản quyền của Tiến Quân © 2025</p>
</div>

</footer>
<div class="chat-button white">
    <a href="https://www.facebook.com/" style="text-decoration: none">
    <i class="fa-solid fa-comment white" style="margin-right: 5px;"></i>Chat</a>
</div>

<script>
    document.querySelectorAll(".blog-item h3, .blog-item img").forEach(element => {
    element.addEventListener("mouseenter", function () {
        let img = this.closest(".blog-item").querySelector("img");
        img.style.opacity = "0.7";
        img.style.transition = "opacity 0.3s ease-in-out";
    });

    element.addEventListener("mouseleave", function () {
        let img = this.closest(".blog-item").querySelector("img");
        img.style.opacity = "1";
    });
});
window.addEventListener("scroll", function() {
    var header = document.querySelector("header");
    if (window.scrollY > 50) {
        header.classList.add("shrink");
    } else {
        header.classList.remove("shrink");
    }
});

</script>
