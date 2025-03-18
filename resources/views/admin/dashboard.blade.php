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
            font-family: Arial, sans-serif;
            background: url('https://source.unsplash.com/1600x900/?seafood,fish,ocean') no-repeat center center/cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background: rgba(44, 62, 80, 0.9);
            color: white;
            text-align: center;
            padding: 1em 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            flex: 1;
        }
        nav {
            margin: 20px 0;
            background: #35424a;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            border-radius: 8px;
        }
        nav a {
            color: #ffffff;
            text-decoration: none;
            padding: 14px 20px;
            display: inline-block;
        }
        nav a i {
            margin-right: 5px;
        }
        nav a:hover {
            background: #e8491d;
            border-radius: 5px;
        }
        .logout-form {
            display: inline;
        }
        .logout-btn {
            background: none;
            border: none;
            color: #ffffff;
            cursor: pointer;
            padding: 14px 20px;
            text-decoration: none;
        }
        .logout-btn i {
            margin-right: 5px;
        }
        .logout-btn:hover {
            background: #e8491d;
            border-radius: 5px;
        }
        .main-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        .dashboard {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .dashboard-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 30%;
        }
        .dashboard-card i {
            font-size: 50px;
            margin-bottom: 10px;
            color: #e8491d;
        }
        footer {
            background: rgba(44, 62, 80, 0.9);
            color: white;
            text-align: center;
            padding: 1em 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1><i class="fa-solid fa-fish"></i> Chợ Hải Sản Tươi Sống - Admin</h1>
    </header>
    <div class="container">
    <nav>
    <a href="#"><i class="fa-solid fa-house"></i> Trang Chủ</a>
    <a href="{{ route('categories.index') }}"><i class="fa-solid fa-layer-group"></i> Danh mục</a>
    <a href="{{ route('products.index') }}"><i class="fa-solid fa-fish"></i> Sản phẩm</a>
    <a href="{{ route('admin.orders.index') }}"><i class="fa-solid fa-receipt"></i> Quản lí Đơn Hàng</a>
    <a href="{{ route('weights.index') }}"><i class="fa-solid fa-receipt"></i> Quản lí Kích cỡ</a>
    <a href="{{ route('admin.banners.index') }}"><i class="fa-solid fa-image"></i> Quản lý Banner</a>

    <!-- Thêm quản lý người dùng -->
    <a href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users"></i> Quản lý Người Dùng</a>

    <!-- Thêm quản lý tin tức -->
    <a href="{{ route('news.index') }}"><i class="fa-solid fa-newspaper"></i> Quản lý Tin Tức</a>
    
    <!-- Thêm quản lý liên hệ -->
    <a href="{{ route('admin.contacts.index') }}"><i class="fa-solid fa-address-book"></i> Quản lý Liên Hệ</a>
    
    <form method="POST" action="{{ route('logout') }}" class="logout-form" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i> Đăng Xuất
        </button>
    </form>
</nav>


        <div class="main-content">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <h1>Thống kê Doanh Thu</h1>

            <form method="GET" action="{{ route('admin.dashboard') }}">
                <label for="start_date">Từ ngày:</label>
                <input type="date" id="start_date" name="start_date" value="{{ $startDate }}">

                <label for="end_date">Đến ngày:</label>
                <input type="date" id="end_date" name="end_date" value="{{ $endDate }}">

                <button type="submit">Lọc</button>
            </form>

            <canvas id="revenueChart"></canvas>
        </div>
    </div>
    
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueData = @json($orders);

        const labels = revenueData.map(order => order.date);
        const data = revenueData.map(order => order.revenue);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: data,
                    borderColor: 'blue',
                    borderWidth: 2
                }]
            }
        });
    </script>

    <footer>
        <p>&copy; 2025 Chợ Hải Sản Tươi Sống. All rights reserved.</p>
    </footer>
</body>
</html>
