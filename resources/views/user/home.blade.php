<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ĐẢO HẢI SẢN - Trang Chủ</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            overflow: hidden;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease;
        }
        .slide {
            min-width: 100%;
        }
        .slide img {
            width: 100%;
            height: auto;
            object-fit: cover;
            cursor: pointer;
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



.slider .slide:first-child {
    display: block; /* Hiển thị slide đầu tiên */
}

    </style>
</head>
<body>
    <header>
        <h1>Chào Mừng Đến Với Đảo Hải Sản</h1>
       
        <nav>
        <div class="logo">
    <img src=" https://cdn.discordapp.com/attachments/917951368101249097/1342163606455718040/Hieu_SeaFood_seafood_logo.png?ex=67b8a2c3&is=67b75143&hm=195eb1dcf6794120695b3fd41cdcf9cf314ad596fc9be4bb443d086caf6dfa78&" alt="ĐẢO HẢI SẢN" style="width: 100px; height: auto;">
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
            <a href="#">
                <i class="fas fa-user"></i>
                Xin chào, {{ auth()->user()->username }}
            </a>
        </li>

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


        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                </button>
            </form>
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
            <div class="pagination">
                {{ $categories->links('vendor.pagination.custom') }}
            </div>
        </div>
        <div class="main-content">
            <div class="slider">
                <div class="slides">
                    <div class="slide">
                        <img src="https://product.hstatic.net/1000275435/product/5_optimized_1cc4d009aaad4ee98300ad12591ecaaa_master.jpg" alt="Banner 1" onClick="openModal(this)">
                    </div>
                    <div class="slide">
                        <img src="https://th.bing.com/th/id/OIP.cb7O7bHq7Arm6dNoVI4zYwHaEd?w=1600&h=964&rs=1&pid=ImgDetMain" alt="Banner 2" onClick="openModal(this)">
                    </div>
                    <div class="slide">
                        <img src="https://bigbluefiji.com/wp-content/uploads/2017/09/fiji-charter-seafood-beach-bbq.jpg" alt="Banner 3" onClick="openModal(this)">
                    </div>
                </div>
            </div>
            <div class="near-banner">
                <img src="https://bigbluefiji.com/wp-content/uploads/2017/09/fiji-charter-seafood-beach-bbq.jpg" alt="Gần Banner" class="near-banner-image" onClick="openModal(this)">
                <img src="https://bigbluefiji.com/wp-content/uploads/2017/09/fiji-charter-seafood-beach-bbq.jpg" alt="Gần Banner" class="near-banner-image" onClick="openModal(this)">
                <img src="https://bigbluefiji.com/wp-content/uploads/2017/09/fiji-charter-seafood-beach-bbq.jpg" alt="Gần Banner" class="near-banner-image" onClick="openModal(this)">
                <img src="https://bigbluefiji.com/wp-content/uploads/2017/09/fiji-charter-seafood-beach-bbq.jpg" alt="Gần Banner" class="near-banner-image" onClick="openModal(this)">
            </div>
        </div>
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
    // Chức năng tự động chuyển slide
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');  // Lấy tất cả các slide
    const totalSlides = slides.length;  // Số lượng slide

    // Hàm chuyển đến slide tiếp theo
    function nextSlide() {
        slides[currentSlide].style.display = 'none'; // Ẩn slide hiện tại
        currentSlide = (currentSlide + 1) % totalSlides; // Tính chỉ số slide tiếp theo
        slides[currentSlide].style.display = 'block'; // Hiển thị slide tiếp theo
    }

    // Set interval để tự động chuyển slide mỗi 3 giây
    setInterval(nextSlide, 3000);

    // Hiển thị slide đầu tiên ngay khi tải trang
    slides[currentSlide].style.display = 'block';
</script>

</body>
</html>
