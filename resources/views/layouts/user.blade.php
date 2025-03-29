<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ĐẢO HẢI SẢN - @yield('title', 'Trang Chủ')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #eef7f9;
        }

        header {
            background-color: #007bff; /* Màu xanh dương */
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-size: 2.5rem;
        }

        nav .logo img {
            width: 80px;
        }

        nav ul.menu {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        nav ul.menu a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
        }

        nav ul.menu a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #0077be;
            color: #fff;
            padding: 20px 0;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 20px;
        }

        .footer-section {
            margin: 10px;
            flex: 1;
        }

        .footer-section h3 {
            font-size: 18px;
            border-bottom: 2px solid #fff;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        .footer-section a {
            color: #fff;
            text-decoration: none;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        .badge {
    background-color: #dc3545;
    color: white;
    font-size: 0.95rem;
    border-radius: 15px;
    padding: 0.25em 0.5em;
    position: absolute; /* Đặt vị trí cố định trên biểu tượng giỏ hàng */
    top: 19px; /* Điều chỉnh lên trên */
    right: 610px; /* Điều chỉnh sang phải */
    min-width: 25px; /* Đảm bảo badge có kích thước tối thiểu */
    height: 25px;
    text-align: center;
    font-weight: bold;
    line-height: 18px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Hiệu ứng bóng */
}


        .dropdown-item[href="{{ route('password.change.form') }}"] {
            color: #007bff; /* Đổi màu chữ thành xanh dương */
            font-weight: bold;
        }

        .dropdown-item[href="{{ route('password.change.form') }}"]:hover {
            color: #0056b3; /* Đổi màu chữ khi hover */
        }
    </style>
</head>
<body>
    <header>
        <h1>Chào Mừng Đến Với Đảo Hải Sản</h1>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand logo" href="{{ route('user.dashboard') }}">
            <img src="{{ asset('storage/logo/seafoodlogo.png') }}" alt="ĐẢO HẢI SẢN">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="menu navbar-nav ms-auto">
                    @php
                        $cartCount = 0;
                        if(Auth::check()) {
                            $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                        }
                    @endphp
                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.news.index') }}"><i class="fa-solid fa-newspaper"></i> Tin Tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i> Giỏ Hàng
                                @if($cartCount > 0)
                                    <span class="badge">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-receipt"></i> Lịch Sử Mua Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.create') }}"><i class="fa-solid fa-paper-plane"></i> Liên Hệ</a>
                        </li>
                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user"></i> Xin chào, {{ auth()->user()->username }}
    </a>
    <ul class="dropdown-menu" aria-labelledby="userDropdown">
        <li>
            <a class="dropdown-item text-primary fw-bold" href="{{ route('password.change.form') }}">
                <i class="fas fa-key me-2"></i> Đổi mật khẩu
            </a>
        </li>
        <li>
            <!-- Nút Đăng Xuất -->
<form method="POST" action="{{ route('logout') }}" class="logout-form" id="logout-form">
    @csrf
    <button type="button" class="dropdown-item" onclick="openLogoutModal()" style="color:rgb(4, 76, 201);">
        <i class="fas fa-sign-out-alt me-2"></i> Đăng Xuất
    </button>
</form>
        </li>
    </ul>
</li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Đăng Nhập</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        @yield('content')
    </div>
    <!-- Modal Xác Nhận -->
<div id="logout-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: flex-start; padding-top: 100px;">
    <div style="background: white; padding: 20px; border-radius: 10px; text-align: center; width: 320px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h3 style="margin-bottom: 15px; color: #333;">Xác nhận Đăng Xuất</h3>
        <p style="margin-bottom: 20px; color: #555;">Bạn có chắc chắn muốn đăng xuất?</p>
        <button onclick="confirmLogout()" style="background: #e74c3c; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">Xác nhận</button>
        <button onclick="closeLogoutModal()" style="background: #34495e; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px; font-size: 14px;">Hủy</button>
    </div>
</div>
<footer>
    <div class="container">
        <div class="footer-container" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap;">
            <div class="footer-section">
                <h3>Thông Tin Liên Hệ</h3>
                <address style="font-size: 16px; line-height: 1.6; margin-top: 15px;">
                    <strong style="font-size: 18px;">Phố Phượng Trì, Đan Phượng, Hà Nội</strong><br>
                    <span style="color: #007bff; font-weight: bold;">Hotline:</span> 034 552 4280<br>
                    <span style="color: #007bff; font-weight: bold;">Email:</span> hieubienca@gmail.com<br>
                    <a href="https://www.google.com/maps/place/Ngh.+14%2F29+P.+Ph%C6%B0%E1%BB%A3ng+Tr%C3%AC,+tt.+Ph%C3%B9ng,+%C4%90an+Ph%C6%B0%E1%BB%A3ng,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam" 
                       style="display: inline-block; margin-top: 10px; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; font-weight: bold; border-radius: 5px;"
                       target="_blank"
                       onmouseover="this.style.backgroundColor='#0056b3';"
                       onmouseout="this.style.backgroundColor='#007bff';">
                        📍 Địa chỉ cửa hàng (Click để xem bản đồ)
                    </a>
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

            <div class="footer-section" style="display: flex; align-items: center;">
                <div>
                    <h3>Liên Kết Nhanh</h3>
                    <ul>
                        <li><a href="#">Giới Thiệu</a></li>
                        <li><a href="#">Chính Sách Bảo Mật</a></li>
                        <li><a href="#">Điều Khoản Sử Dụng</a></li>
                        <li><a href="#">Tuyển Dụng</a></li>
                    </ul>
                </div>
                <!-- Mạng xã hội bên cạnh -->
                <div class="social-links" style="margin-left: 30px; display: flex; gap: 15px;">
                    <a href="https://www.facebook.com/congtuhieubui" style="color:rgb(27, 2, 221);"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="https://www.instagram.com/buihieu_25/" style="color: #E4405F;"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="https://www.youtube.com/" style="color: #ff0000;"><i class="fab fa-youtube fa-2x"></i></a>
                    <a href="https://www.tiktok.com/" style="color: #000000;"><i class="fab fa-tiktok fa-2x"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Thêm link Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


<!-- Thêm link Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Logic hiện tại của bạn vẫn giữ nguyên
        function openModal(imageElement) {
            var modal = document.getElementById("myModal");
            var modalImage = document.getElementById("modalImage");
            modal.style.display = "flex";
            modalImage.src = imageElement.src;
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
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
        function openLogoutModal() {
        document.getElementById('logout-modal').style.display = 'flex';
    }
    function closeLogoutModal() {
        document.getElementById('logout-modal').style.display = 'none';
    }
    function confirmLogout() {
        document.getElementById('logout-form').submit();
    }
    </script>
</body>
</html>
