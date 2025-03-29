<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chợ Hải Sản - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #1E1E2F;
            color: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            padding: 1.5em;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container {
            display: flex;
            flex: 1;
            margin-top: 20px;
        }
        nav {
            width: 250px;
            background: #2C2C3C;
            padding: 20px;
            min-height: 10vh;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.2);
        }
        nav a {
            display: block;
            color: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
            font-size: 1.1rem;
        }
        nav a:hover {
            background: #ff7e5f;
        }
        .main-content {
            flex: 1;
            background: #fff;
            color: #333;
            padding: 20px;
            border-radius: 10px;
            margin: 0 20px;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .dashboard-card {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }
        .dashboard-card:hover {
            transform: scale(1.05);
        }
        footer {
            background: #2C2C3C;
            padding: 1em;
            text-align: center;
            margin-top: auto;
        
        }
    </style>
    @yield('styles')
</head>
<body>
    <header>
        <h1><i class="fa-solid fa-fish"></i> Chợ Hải Sản Tươi Sống - Admin</h1>
    </header>
    <div class="container">
        <nav>
            <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-house"></i> Trang Chủ</a>
            <a href="{{ route('categories.index') }}"><i class="fa-solid fa-layer-group"></i> Danh Mục</a>
            <a href="{{ route('products.index') }}"><i class="fa-solid fa-fish"></i> Sản Phẩm</a>
            <a href="{{ route('admin.orders.index') }}"><i class="fa-solid fa-receipt"></i> Quản lí Đơn Hàng</a>
            <a href="{{ route('weights.index') }}"><i class="fa-solid fa-scale-balanced"></i> Quản lí Cân Nặng</a>
            <a href="{{ route('admin.banners.index') }}"><i class="fa-solid fa-image"></i> Quản lí Banner</a>
            <a href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users"></i> Quản lí Người Dùng</a>
            <a href="{{ route('news.index') }}"><i class="fa-solid fa-newspaper"></i> Quản lí Tin Tức</a>
            <a href="{{ route('admin.contacts.index') }}"><i class="fa-solid fa-address-book"></i> Quản lí Liên Hệ</a>
            <!-- Nút Đăng Xuất -->
            <form method="POST" action="{{ route('logout') }}" class="logout-form" id="logout-form">
                @csrf
                <button type="button" class="logout-btn" style="background: none; border: none; color: white; padding: 15px; cursor: pointer; width: 100%; text-align: left;" onclick="openLogoutModal()">
                    <i class="fa-solid fa-right-from-bracket"></i> Đăng Xuất
                </button>
            </form>
        </nav>
            <!-- Modal Xác Nhận -->
            <div id="logout-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: flex-start; padding-top: 100px;">
    <div style="background: white; padding: 20px; border-radius: 10px; text-align: center; width: 320px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h3 style="margin-bottom: 15px; color: #333;">Xác nhận Đăng Xuất</h3>
        <p style="margin-bottom: 20px; color: #555;">Bạn có chắc chắn muốn đăng xuất?</p>
        <button onclick="confirmLogout()" style="background: #e74c3c; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">Xác nhận</button>
        <button onclick="closeLogoutModal()" style="background: #34495e; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px; font-size: 14px;">Hủy</button>
    </div>
</div>

        <div class="main-content">
            @yield('content')
        </div>
    </div>
    <footer>
        <p>&copy; 2025 Chợ Hải Sản Tươi Sống. All rights reserved.</p>
    </footer>
    @yield('scripts')
    <!-- Script JavaScript -->
<script>
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