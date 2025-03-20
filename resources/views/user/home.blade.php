<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ĐẢO HẢI SẢN - Trang Chủ</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap JS (nếu chưa có) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0f7fa; /* Màu xanh dương nhạt */
        }
        header {
            background-color: #0277bd; /* Màu xanh dương đậm */
            color: white;
            text-align: center;
            padding: 1em 0;
        }
        nav {
            background-color: #0288d1; /* Màu xanh dương */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        nav .logo {
            font-size: 1.5em;
            font-weight: bold;
        }

        nav .logo img {
    width: 100px; /* Kích thước mới cho logo */
    height: auto; /* Giữ tỉ lệ ảnh */
}

        nav .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        nav .menu li {
            margin: 0 10px; /* Giảm khoảng cách giữa các mục menu */
        }
        nav .menu li a, nav .menu li form button {
            color: white;
            text-decoration: none;
            font-size: 1em;
            background: none;
            border: none;
            cursor: pointer;
        }
        nav .menu li a:hover, nav .menu li form button:hover {
            text-decoration: underline;
        }
        nav .search-cart {
            display: flex;
            align-items: center;
        }
        nav .search-cart input {
            padding: 5px;
            border: none;
            border-radius: 4px;
        }
        nav .search-cart button,
        nav .search-cart a {
            color: white;
            background: none;
            border: none;
            cursor: pointer;
            margin-left: 5px; /* Giảm khoảng cách giữa các phần tử tìm kiếm và giỏ hàng */
        }
        .container {
            display: flex;
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar {
            width: 25%;
            margin-right: 10px; /* Giảm khoảng cách giữa sidebar và nội dung chính */
        }
        .sidebar h2 {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #0288d1; /* Màu xanh dương */
        }
        .categories {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .categories li {
            margin: 5px 0;
            display: flex;
            align-items: center;
        }
        .categories li a {
            color: #0277bd; /* Màu xanh dương đậm */
            text-decoration: none;
            font-size: 0.9em;
            display: flex;
            align-items: center;
            padding: 8px;
            background-color: #b3e5fc; /* Màu xanh dương nhạt */
            border-radius: 4px;
            width: 100%;
        }
        .categories li a img {
            margin-right: 10px;
        }
        .categories li a:hover {
            background-color: #81d4fa; /* Màu xanh dương sáng khi hover */
        }
        .main-content {
            width: 75%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
            gap: 10px; /* Điều chỉnh khoảng cách giữa banner và ảnh bên cạnh */
        }
        .banner {
            width: 80%;
            margin-right: 0;
        }
        .banner img {
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        .near-banner {
            width: 20%;
            padding-left: 0;
            margin-left: 0;
        }
        .near-banner-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
            object-fit: cover;
            cursor: pointer;
        }
        .promo {
            text-align: center;
            margin-bottom: 20px;
        }
        .promo img {
            width: 100%;
            border-radius: 5px;
        }
        .promo p {
            margin-top: 10px;
        }
        .features {
            text-align: center;
            margin-top: 20px;
        }
        .features div {
            display: inline-block;
            width: 30%;
            padding: 10px;
        }
        footer {
    background-color: #0277bd; /* Màu xanh dương đậm */
    color: white;
    padding: 20px 0;
    text-align: center;
    margin-top: 20px;
    display: flex;
    justify-content: space-between; /* Đặt các phần tử con nằm ngang */
    align-items: center; /* Căn giữa theo chiều dọc */
    flex-wrap: wrap; /* Cho phép các phần tử cuộn xuống nếu không đủ không gian */
}

.footer-container {
    width: 100%;
    display: flex;
    justify-content: space-between;
    gap: 10px; /* Giảm khoảng cách giữa các phần tử */
    flex-wrap: wrap; /* Cho phép các phần tử cuộn xuống nếu không đủ không gian */
}

.footer-section {
    width: 32%; /* Điều chỉnh chiều rộng của mỗi phần tử */
    margin-bottom: 10px; /* Giảm khoảng cách dưới mỗi phần tử */
}

.footer-section h3 {
    margin-top: 0;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin: 5px 0; /* Giảm khoảng cách giữa các mục trong danh sách */
}

.footer-section ul li a {
    color: white;
    text-decoration: none;
}

.footer-section ul li a:hover {
    text-decoration: underline;
}

.footer-section address {
    margin: 5px 0; /* Giảm khoảng cách trong phần địa chỉ */
}

.slider {
    width: 100%;
    max-width: 800px;
    height: 300px;
    overflow: hidden;
    position: relative;
}

.slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.slide {
    min-width: 100%;
    height: 300px;
    object-fit: cover;
}



.slider .slide img {
    width: 100%;
    height: 100%; /* Ảnh sẽ luôn vừa với slider */
    object-fit: cover; /* Cắt ảnh nếu quá lớn */

        }
        .pagination {
            display: flex;
            justify-content: center;
            margin: 30px 0;
            list-style: none;
            padding: 0;
        }
        .pagination li {
            margin: 0 30px;
        }
        .pagination li a, .pagination li span {
            display: inline-block;
            padding: 20px 40px;
            font-size: 1.5em;
            color: #0277bd;
            background-color: #b3e5fc;
            border-radius: 10px;
            text-decoration: none;
            border: 2px solid #0288d1;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .pagination li a:hover {
            background-color: #81d4fa;
            color: white;
            transform: scale(1.1);
        }
        .pagination li.active span {
            background-color: #0277bd;
            color: white;
            font-weight: bold;
            cursor: default;
            border: 2px solid #0277bd;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        .pagination li.disabled span {
            color: #90a4ae;
            background-color: #e0e0e0;
            cursor: not-allowed;
        }
        /* Phóng to ảnh */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            justify-content: center;
            align-items: center;
        }
        .modal img {
            max-width: 90%;
            max-height: 90%;
        }

        /* Ẩn tất cả các slide ngoài slide đầu tiên */
/* Đảm bảo slider có chiều rộng và chiều cao cố định */
.slider {
    width: 100%;
    height: 400px; /* Cố định chiều cao của slider */
    overflow: hidden;
    position: relative; /* Để giữ các slide không bị di chuyển ra ngoài */
}

/* Đảm bảo mỗi slide có chiều rộng 100% và chiều cao cố định */
/* Đảm bảo các slide chồng lên nhau */
.slider .slide {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
/* Ví dụ style cho số lượng giỏ hàng */
.badge {
        background: red;
        color: white;
        border-radius: 50%;
        padding: 4px 8px;
        margin-left: 5px;
        font-weight: bold;
    }

    /* Ví dụ style cho hiển thị số lượng ngay trên chữ Giỏ Hàng */
    .cart-link {
        position: relative; /* Để badge có thể đặt chồng lên */
        display: inline-block;
    }
    .cart-link .badge {
        position: absolute;
        /* Điều chỉnh toạ độ để badge nằm chồng lên chữ “Giỏ Hàng” */
        top: -17px;
        left: 85px;
        transform: translateX(-50%);
        
        background: red;
        color: white;
        border-radius: 30%;
        padding: 2px 6px;
        font-size: 12px;
        font-weight: bold;
    }
* { box-sizing: border-box; margin: 0; padding: 0; }
        .banner-container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            overflow: hidden;
            position: relative;
        }
        .banner-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .banner-wrapper img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .prev { left: 10px; }
        .next { right: 10px; }


.slider .slide:first-child {
    display: block; /* Hiển thị slide đầu tiên */
}

.user-dropdown {
    position: relative;
    display: inline-block;
}

.user-dropdown button {
    background-color: #f8f9fa;
    border: 1px solid #ccc;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
}

.user-dropdown .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    min-width: 180px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    display: none;
    z-index: 100;
}

.user-dropdown .dropdown-menu li {
    padding: 8px 12px;
    cursor: pointer;
}

.user-dropdown .dropdown-menu li:hover {
    background: #f1f1f1;
}

.user-dropdown .dropdown-menu.show {
    display: block;
}


    </style>
</head>
<body>
    <header>
        <h1>Chào Mừng Đến Với Đảo Hải Sản</h1>
       
        <nav>
        <div class="logo">
    <img src=" https://cdn.discordapp.com/attachments/1171456531158548508/1346373150534799473/Hieu_SeaFood_seafood_logo.png?ex=67c7f335&is=67c6a1b5&hm=d5ea27f49d539d6fb915f80bcbe3ddd0ae37711992c4fab0c14dc73b50592e66&" alt="ĐẢO HẢI SẢN" style="width: 70px; height: auto;">
</div>


<ul class="menu">
    @php
        $cartCount = 0;
        if(Auth::check()) {
            // Tính tổng số lượng trong giỏ hàng của user
            $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
        }
    @endphp

    @if(Auth::check())
    
        <li>
            <a href="{{ route('user.news.index') }}">
          <i class="fa-solid fa-newspaper"></i> Tin Tức
            </a>
        </li>

        <li>
            <!-- Thêm class cart-link để badge hiển thị chồng lên -->
            <a href="{{ route('cart.index') }}" class="cart-link">
                <i class="fas fa-shopping-cart"></i> Giỏ Hàng
                @if($cartCount > 0)
                    <span class="badge">{{ $cartCount }}</span>
                @endif
            </a>
        </li>

        <li>
            <a href="{{ route('orders.index') }}">
                <i class="fas fa-receipt"></i> Lịch Sử Mua Hàng
            </a>
        </li>

        <li>
            <a href="{{ route('contact.create') }}">
             <i class="fa-solid fa-paper-plane"></i> Liên Hệ
            </a>
        </li>

        <li class="nav-item dropdown">
    <div class="user-dropdown">
        <button class="dropdown-toggle" id="userDropdown">
            <i class="fas fa-user"></i> Xin chào, {{ auth()->user()->username }}
            <i class="fas fa-chevron-down"></i>
        </button>
        <ul class="dropdown-menu" id="dropdownMenu">
            <li>
                <a class="dropdown-item" href="{{ route('password.change.form') }}">
                    <i class="fas fa-key"></i> Đổi mật khẩu
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                    </button>
                </form>
            </li>
        </ul>
    </div>
</li>
    @else
        <li>
            <a href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i> Đăng Nhập
            </a>
        </li>
    @endif
</ul>
         
        </nav>
    </header>
    <div class="container">
        <div class="sidebar">
            <h2>Danh Mục Sản Phẩm</h2>
            <ul class="categories">
                @if($categories->isNotEmpty())
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('user.category.show', ['id' => $category->id]) }}" style="display: flex; align-items: center;">
                                <img src="{{ asset('storage/' . $category->img) }}" alt="Image" width="50" height="50">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                @else
                    <li>Không có danh mục nào.</li>
                @endif
            </ul>
           
        </div>
        <div class="main-content">
    <div class="slider">
        <div class="slides">
       

            @foreach ($banners as $banner)
                <div class="slide">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner">
                </div>
            @endforeach
        </div>
    </div>
</div>

</div>

    </div>

    <div class="container mt-4">
    <h3>Đánh giá mới nhất</h3>
    
    @foreach($products as $product)
        @if($product->reviews->count() > 0)
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="fw-bold">{{ $product->name }}</h4>
                    @foreach($product->reviews->take(3) as $review) <!-- Lấy 3 đánh giá mới nhất -->
                        <div class="border-bottom pb-2 mb-2">
                            <h5 class="fw-bold">{{ $review->user->username }} - ⭐ {{ $review->rating }}/5</h5>
                            <p>{{ $review->comment }}</p>
                            <small class="text-muted">Ngày đánh giá: {{ $review->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Thông Tin Liên Hệ</h3>
                <address>
                    Phố Phượng Trì, Đan Phượng, Hà Nội<br>
                    Hotline: 034 552 4280<br>
                    Email: hieubienca@gmail.com<br>
                    <a href="https://www.google.com/maps/place/Ngh.+14%2F29+P.+Ph%C6%B0%E1%BB%A3ng+Tr%C3%AC,+tt.+Ph%C3%B9ng,+%C4%90an+Ph%C6%B0%E1%BB%A3ng,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@21.0874209,105.6621026,19z/data=!4m6!3m5!1s0x3134564238955499:0xf2ccbb32de9d47b1!8m2!3d21.087675!4d105.6626423!16s%2Fg%2F11j4gx8gcy?hl=vi-VN&entry=ttu&g_ep=EgoyMDI1MDExMC4wIKXMDSoASAFQAw%3D%3D">Địa chỉ cửa hàng</a>
                </address>
            </div>
            <div class="footer-section">
                <h3>Chăm Sóc Khách Hàng</h3>
                <ul>
              
                    <li><a href="#">Hướng Dẫn Mua Hàng</a></li>
                    <li><a href="#">Bảo Hành & Đổi Trả</a></li>
                    <li><a href="#">Câu Hỏi Thường Gặp</a></li>
                </ul>
        </div>
        <div class="footer-section">
                <h3>Liên Kết Nhanh</h3>
                <ul>
                    <li><a href="#">Giới Thiệu</a></li>
                    <li><a href="#">Chính Sách Bảo Mật</a></li>
                    <li><a href="#">Điều Khoản Sử Dụng</a></li>
                    <li><a href="#">Tuyển Dụng</a></li>
                    
                </ul>
            </div>
        </div>
    </footer>

    <!-- Modal cho ảnh phóng to -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modalImage" src="" alt="Phóng to ảnh">
    </div>

    <script>
        // Mở modal khi nhấn vào ảnh
        function openModal(imageElement) {
            var modal = document.getElementById("myModal");
            var modalImage = document.getElementById("modalImage");
            modal.style.display = "flex";
            modalImage.src = imageElement.src;
        }

        // Đóng modal khi nhấn vào nút đóng
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // Đóng modal khi nhấn ra ngoài ảnh
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

<script>
    let currentSlide = 0;
const slides = document.querySelectorAll('.slide');

function changeSlide(n) {
    showSlide(currentSlide += n);
}

function showSlide(n) {
    if (n >= slides.length) currentSlide = 0;
    if (n < 0) currentSlide = slides.length - 1;

    slides.forEach((slide, index) => {
        slide.style.display = (index === currentSlide) ? 'block' : 'none';
    });
}

document.addEventListener('DOMContentLoaded', () => {
    showSlide(currentSlide);
    setInterval(() => changeSlide(1), 3000);
});

function openModal(src) {
    const modal = document.getElementById("myModal");
    const modalImg = document.getElementById("modalImage");
    modal.style.display = "block";
    modalImg.src = src;
}

function closeModal() {
    const modal = document.getElementById("myModal");
    modal.style.display = "none";
}
document.addEventListener("DOMContentLoaded", function () {
    const dropdownBtn = document.getElementById("userDropdown");
    const dropdownMenu = document.getElementById("dropdownMenu");

    dropdownBtn.addEventListener("click", function (event) {
        event.stopPropagation();
        dropdownMenu.classList.toggle("show");
    });

    document.addEventListener("click", function (event) {
        if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });
});

</script>


</body>
</html>
