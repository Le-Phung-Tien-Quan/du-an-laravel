<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('') }}css/home.css">
<script src="{{ asset('') }}js/home.js"></script>
@extends('layouts.user')
@section('body')

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1> <span>Nội thất</span>  nâng tầm không gian sống</h1>
                <p>Khám phá nội thất thiết kế đương đại mang đến cảm giác thoải mái, sang trọng. Cá nhân hoá trong từng sản phẩm phù hợp với mọi không gian sống.</p>
                <button class="cta-button"><i class="fa-solid fa-cart-shopping"></i> Mua sắm ngay</button>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <h2>15.000+</h2>
                        <p>Sản phẩm đa dạng</p>
                    </div>
                    <div class="hero-stat">
                        <h2>10+</h2>
                        <p>Hệ thống cửa hàng</p>
                    </div>
                    <div class="hero-stat">
                        <h2>20+</h2>
                        <p>Giải thưởng</p>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('') }}img/banner.png" alt="Nội thất đẹp">
            </div>
        </div>
    </section>


    <section class="featured-products">
        <div class="container1">
            <div class="featured-header">
                <h2>Các dòng sản phẩm nổi bật</h2>
                <div class="slider-controls">
                    <button class="prev-slide"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="next-slide"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="product-slider">
                @foreach ($categories as $item)
                    <div class="product-item">
                        <div class="product-details">
                            <h3>{{ $item->name }}</h3>
                            <p>{{ $item->description }}</p>
                            <a href="#">Xem thêm →</a>
                        </div>
                        <div class="product-image">
                            <!-- Sửa URL từ category_id thành id -->
                            <a href="/category/{{ $item->id }}">
                                <img src="{{ asset('') }}img/{{ $item->image }}" alt="Sofa">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <section class="collection">
        <div class="container">
            <h2>Bộ sưu tập</h2>
            <div class="collection-filters">
                <button class="filter active">Hiện đại</button>
                <button class="filter">Cổ điển</button>
                <button class="filter">Đơn giản</button>
                <button class="filter">Sang trọng</button>
            </div>
            <div class="collection-products">
                @foreach ($views as $item)
                <div class="product">
                    <div class="product-image">
                        <a href="/detail/{{ $item->slug }}"><img src="{{ asset('') }}img/{{ $item->image }}" alt="Đèn người ôm bóng đèn"></a>
                        @if ($item->sale_price !== null)
                        <div class="discount">-{{ round((($item->price - $item->sale_price) / $item->price) * 100) }}%</div>
                    @endif
                        <button class="wishlist"><i class="far fa-heart"></i></button>
                    </div>
                    <div class="product-details">
                        <h3>{{ $item->name }}</h3>
                        <p class="price">
                            {{ number_format($item->price, 0, ',', '.') }} đ
                            @if ($item->sale_price !== null)
                                <span class="old-price">{{ number_format($item->sale_price, 0, ',', '.') }} đ</span>
                            @endif
                        </p>
                        <form id="add-to-cart-form" action="/cart" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="quantity-input">
                                <input style="display: none;" name="quantity" type="number" value="1" min="1" max="{{ $item->quantity }}">
                            </div>
                            <div class="actions">
                                <button type="submit" class="add-to-cart"><i class="fa-solid fa-basket-shopping"></i>+ Thêm vào giỏ hàng</button>
                            </div>
                        </form>

                    </div>
                </div>
            @endforeach




            </div>
            <div class="xem">
                <a href="#"></a>Xem thêm →</a>
            </div>
        </div>
    </section>
    <section class="inspiration">
    <div class="container">
        <div class="inspiration-content">
            <h2>NGUỒN CẢM HỨNG VÔ TẬN</h2>
            <p>Khám phá nội thất thiết kế đương đại mang đến cảm giác thoải mái, sang trọng. Cá nhân hoá trong từng sản phẩm phù hợp với mọi không gian sống.</p>
            <a href="#" class="view-more">Xem thêm →</a>
        </div>
    </div>
</section>
<section class="collection">
    <div class="container">
        <div class="collection-products1">
            <div class="col5">
                <button class="product-slider-prev"><i class="fa-solid fa-chevron-left"></i></button>

                @foreach ($phongkhach as $item)
                    <div class="product-item box">
                        <div class="product-image">
                            <a href="/detail/{{ $item->slug }}"><img src="{{ asset('') }}img/{{ $item->image }}" alt="{{ $item->name }}" class="zoom"></a>
                            @if ($item->sale_price !== null)
                                <div class="discount">-{{ round((($item->price - $item->sale_price) / $item->price) * 100) }}%</div>
                            @endif
                            <button class="wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <div class="product-details">
                            <h3 style="min-width: 330px;">{{ $item->name }}</h3>
                            <span class="">{{ number_format($item->price, 0, ',', '.') }} ₫</span>
                            @if ($item->sale_price !== null)
                                <p class="price">{{ number_format($item->sale_price, 0, ',', '.') }} ₫</p>
                            @endif
                            <form id="add-to-cart-form" action="/cart" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="quantity-input">
                                    <input style="display: none;" name="quantity" type="number" value="1" min="1" max="{{ $item->quantity }}">
                                </div>
                                <div class="actions">
                                    <button type="submit" class="add-to-cart"><i class="fa-solid fa-basket-shopping"></i>+ Thêm vào giỏ hàng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach

                <button class="product-slider-next"><i class="fa-solid fa-chevron-right"></i></button>
            </div>

            <div class="product banner">
                <img src="{{ asset('img/phongdep.png') }}" alt="Nội thất phòng khách">
                <div class="banner-content">
                    <h2 class="h2">Nội thất phòng khách</h2>
                    <a href="#" class="view-more" style="margin-left: 420px; color: white;">Xem thêm →</a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="collection">
    <div class="container">
        <div class="collection-products1">
            <div class="product banner">
                <img src="{{ asset('') }}img/bep.png" alt="Nội thất phòng khách">
                <div class="banner-content">
                    <h2 class="h2-">Nội thất phòng bếp</h2>
                    <a href="#" class="view-more" style="margin-right: 420px; color: white;">Xem thêm →</a>
                </div>
            </div>
            <div class="col5 col50">
            <button class="product-slider-prev1"><i class="fa-solid fa-chevron-left"></i></button>
            @foreach ($phongbep as $item)
            <div class="product-item box">
                <div class="product-image">
                    <a href="/detail/{{ $item->slug }}"><img src="{{ asset('') }}img/{{ $item->image }}" alt="{{ $item->name }}" class="zoom"></a>
             @if ($item->sale_price !== null && $item->sale_price > 0)
                        <div class="discount">-{{ round((($item->price - $item->sale_price) / $item->price) * 100) }}%</div>
                    @endif
                    <button class="wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-details">
                    <h3 style="min-width: 330px;">{{ $item->name }}</h3>
                    <span class="">{{ number_format($item->price, 0, ',', '.') }} ₫</span>
             @if ($item->sale_price !== null && $item->sale_price > 0)



                        <p class="price">{{ number_format($item->sale_price, 0, ',', '.') }} ₫</p>
                    @endif
                    <form id="add-to-cart-form" action="/cart" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="quantity-input">
                            <input style="display: none;" name="quantity" type="number" value="1" min="1" max="{{ $item->quantity }}">
                        </div>
                        <div class="actions">
                            <button type="submit" class="add-to-cart"><i class="fa-solid fa-basket-shopping"></i>+ Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach



            <button class="product-slider-next1"><i class="fa-solid fa-chevron-right"></i></button>
            </div>

        </div>
    </div>
</section>

<section class="customer-reviews">
    <div class="container">
        <h2>Đánh giá từ khách hàng</h2>
        <p>Hơn 1.000 khách hàng đã hài lòng về dịch vụ và sản phẩm của chúng tôi</p>
        <div class="reviews">
            <div class="review-item">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Mình rất đánh giá cao về độ hoàn thiện của sản phẩm. Mẫu mã và màu sắc cũng rất đa dạng, nhiều lựa chọn.</p>
                <div class="customer-info">
                    <img src="{{ asset('') }}img/cmt1.png" alt="Bạn Diễm Hằng">
                    <p class="name">Bạn Diễm Hằng - Hà Nội</p>
                </div>
            </div>
            <div class="review-item">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Nhân viên của OH! Decor rất nhiệt tình và chuyên nghiệp, mình có thiện cảm ngay từ khi được tư vấn sản phẩm.</p>
                <div class="customer-info">
                    <img src="{{ asset('') }}img/cmt2.png" alt="Anh Trần Hà">
                    <p class="name">Anh Trần Hà - Hồ Chí Minh</p>
                </div>
            </div>
            <div class="review-item">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Chất lượng dịch vụ khi mình đến lựa chọn sản phẩm là điều mình cảm thấy ấn tượng khi đến với OH! Decor</p>
                <div class="customer-info">
                    <img src="{{ asset('') }}img/cmt3.png" alt="Bạn Hà Thu">
                    <p class="name">Bạn Hà Thu - Đà Nẵng</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-section">
    <div class="container">
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


</body>
</html>
<script>
    document.getElementById("add-to-cart-form").addEventListener("submit", function (event) {
        event.preventDefault();
        let form = this;
        let formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData
        }).then(response => {
            if (response.ok) {
                window.location.href = "/";
            }
        });
    });
</script>
@endsection
