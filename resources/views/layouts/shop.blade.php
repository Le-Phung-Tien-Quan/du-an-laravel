@extends('layouts.user')
@section('body')

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
            @elseif(Request::is('category/*'))
                <li><a href="{{ url('/shop') }}">Cửa hàng</a></li>
                <li class="active">Danh mục sản phẩm</li>
            @endif
        </ul>
    </nav>
    <section class="sofa-section">
        <div class="sofa-content">
            <h2>Sofa</h2>
        </div>
        <div class="sofa-image">
            <img src="{{ asset('') }}img/banner (2).png" alt="Sofa">
        </div>
    </section>

    <div class="container-s">
        <aside class="sidebar">
            <h2>Danh mục sản phẩm</h2>
            <hr>
            <ul>
                <li><a href="/category/1">Bàn</a></li>
                <li><a href="/category/2">Ghế</a></li>
                <li><a href="/category/3">Tủ</a></li>
                <li><a href="/category/4">Sofa</a></li>
                <li><a href="/category/5">Đèn</a></li>
                <li><a href="/category/6">Giường</a></li>
                <li><a href="/category/7">Cây</a></li>
            </ul>
            <h2>Bộ lọc</h2>
            <hr>
            <h3>Chọn khoảng giá</h3>
            <ul>
                <li><label><input type="radio" name="price" value="under_1m" onchange="filterByPrice()"> Dưới 1 triệu</label></li>
                <li><label><input type="radio" name="price" value="1m_2m" onchange="filterByPrice()"> Từ 1 triệu - 2 triệu</label></li>
                <li><label><input type="radio" name="price" value="2m_3m" onchange="filterByPrice()"> Từ 2 triệu - 3 triệu</label></li>
                <li><label><input type="radio" name="price" value="3m_5m" onchange="filterByPrice()"> Từ 3 triệu - 5 triệu</label></li>
                <li><label><input type="radio" name="price" value="above_5m" onchange="filterByPrice()"> Trên 5 triệu</label></li>
            </ul>

            <h3>Màu sắc</h3>
            <div class="color-filter">
                <span style="background-color: #000;"></span>
                <span style="background-color: #808080;"></span>
                <span style="background-color: #FFFFFF;"></span>
                <span style="background-color: #8B4513;"></span>
                <span style="background-color: #0000FF;"></span>
                <span style="background-color: #008000;"></span>
            </div>
            <h3>Chất liệu</h3>
            <ul>
                <li><label><input type="checkbox"> Gỗ công nghiệp</label></li>
                <li><label><input type="checkbox"> Gỗ ổi</label></li>
                <li><label><input type="checkbox"> Gỗ xoan</label></li>
                <li><label><input type="checkbox"> Gỗ xưa</label></li>
                <li><label><input type="checkbox"> Nhựa</label></li>
            </ul>

        </aside>
        <main class="product-list">
            <div class="filter-options">
                <button onclick="filterProducts('')">Mặc định</button>
                <button onclick="filterProducts('name_asc')">A - Z</button>
                <button onclick="filterProducts('name_desc')">Z - A</button>
                <button onclick="filterProducts('price_asc')">Giá tăng dần</button>
                <button onclick="filterProducts('price_desc')">Giá giảm dần</button>
                <button onclick="filterProducts('newest')">Hàng mới nhất</button>
                <button onclick="filterProducts('oldest')">Hàng cũ nhất</button>
            </div>
            {{-- <div class="product-grid-s">
                <div class="item">
                    <div class="item-image">
                        <img src="{{ asset('') }}{{ asset('') }}img/den1.png" alt="Đèn trang trí Left Heat">
                        <div class="discount-badge">-50%</div>
                        <button class="favorite-btn"><i class="far fa-heart"></i></button>
                    </div>
                    <div class="item-details">
                        <h3>ĐÈN TRANG TRÍ LEFT HEAT</h3>
                        <p class="price-tag">5.500.000 ₫ <span class="old-price-tag">11.000.000 ₫</span></p>
                        <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="item">
                    <div class="item-image">
                        <img src="{{ asset('') }}{{ asset('') }}img/den1.png" alt="Đèn trang trí Left Heat">
                        <div class="discount-badge">-50%</div>
                        <button class="favorite-btn"><i class="far fa-heart"></i></button>
                    </div>
                    <div class="item-details">
                        <h3>ĐÈN TRANG TRÍ LEFT HEAT</h3>
                        <p class="price-tag">5.500.000 ₫ <span class="old-price-tag">11.000.000 ₫</span></p>
                        <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="item">
                    <div class="item-image">
                        <img src="{{ asset('') }}{{ asset('') }}img/den1.png" alt="Đèn trang trí Left Heat">
                        <div class="discount-badge">-50%</div>
                        <button class="favorite-btn"><i class="far fa-heart"></i></button>
                    </div>
                    <div class="item-details">
                        <h3>ĐÈN TRANG TRÍ LEFT HEAT</h3>
                        <p class="price-tag">5.500.000 ₫ <span class="old-price-tag">11.000.000 ₫</span></p>
                        <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="item">
                    <div class="item-image">
                        <img src="{{ asset('') }}{{ asset('') }}img/den1.png" alt="Đèn trang trí Left Heat">
                        <div class="discount-badge">-50%</div>
                        <button class="favorite-btn"><i class="far fa-heart"></i></button>
                    </div>
                    <div class="item-details">
                        <h3>ĐÈN TRANG TRÍ LEFT HEAT</h3>
                        <p class="price-tag">5.500.000 ₫ <span class="old-price-tag">11.000.000 ₫</span></p>
                        <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="item">
                    <div class="item-image">
                        <img src="{{ asset('') }}{{ asset('') }}img/den1.png" alt="Đèn trang trí Left Heat">
                        <div class="discount-badge">-50%</div>
                        <button class="favorite-btn"><i class="far fa-heart"></i></button>
                    </div>
                    <div class="item-details">
                        <h3>ĐÈN TRANG TRÍ LEFT HEAT</h3>
                        <p class="price-tag">5.500.000 ₫ <span class="old-price-tag">11.000.000 ₫</span></p>
                        <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="item">
                    <div class="item-image">
                        <img src="{{ asset('') }}{{ asset('') }}img/den1.png" alt="Đèn trang trí Left Heat">
                        <div class="discount-badge">-50%</div>
                        <button class="favorite-btn"><i class="far fa-heart"></i></button>
                    </div>
                    <div class="item-details">
                        <h3>ĐÈN TRANG TRÍ LEFT HEAT</h3>
                        <p class="price-tag">5.500.000 ₫ <span class="old-price-tag">11.000.000 ₫</span></p>
                        <button class="cart-btn"><i class="fa-solid fa-basket-shopping"></i> Thêm vào giỏ</button>
                    </div>
                </div>
            </div> --}}
            @yield('shop')
            <div class="pagination">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </main>
    </div>
    <section class="collection">
        <div class="container-c">
            <div class="view-more">
            <h1>Sản phẩm gợi ý</h1>
            </div>
            <div class="collection-grid">
                <div class="item">
                    <div class="item-image">
                        <img src="{{ asset('') }}img/den-nguoi-om-bong-den.png" alt="Đèn người ôm bóng đèn">
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
                        <img src="{{ asset('') }}img/den-nguoi-om-bong-den.png" alt="Đèn người ôm bóng đèn">
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
                        <img src="{{ asset('') }}img/den-nguoi-om-bong-den.png" alt="Đèn người ôm bóng đèn">
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
                        <img src="{{ asset('') }}img/den1.png" alt="Đèn trang trí Left Heat">
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

</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
       document.getElementById("pagination").addEventListener("click", function(e) {
           if (e.target.tagName === "A") {
               e.preventDefault();
               let url = e.target.getAttribute("href");

               fetch(url, {
                   headers: {
                       "X-Requested-With": "XMLHttpRequest"
                   }
               })
               .then(response => response.text())
               .then(data => {
                   let parser = new DOMParser();
                   let doc = parser.parseFromString(data, "text/html");
                   document.querySelector("#product-list").innerHTML = doc.querySelector("#product-list").innerHTML;
                   document.querySelector("#pagination").innerHTML = doc.querySelector("#pagination").innerHTML;
               });
           }
       });
   });
   function filterProducts(sort) {
    window.location.href = `?sort=${sort}`;
}
function filterByPrice() {
    let selectedPrice = document.querySelector('input[name="price"]:checked').value;
    let currentParams = new URLSearchParams(window.location.search);
    currentParams.set('price', selectedPrice);
    window.location.href = '?' + currentParams.toString();
}
   </script>
@endsection
