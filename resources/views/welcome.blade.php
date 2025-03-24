<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Cửa Hàng Hải Sản Tươi Sống</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
        }
        header {
            background-color: #0073e6;
            color: white;
            padding: 20px 10px;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #005bb5;
            padding: 10px 0;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .hero {
            background-image: url('seafood-banner.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
        }
        .hero p {
            font-size: 1.5rem;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h2 {
            color: #0073e6;
        }
        .footer {
            background-color: #003f7f;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Chào Mừng Đến Với Cửa Hàng Hải Sản Tươi Sống</h1>
    </header>
    <nav>
        <a href="#">Trang Chủ</a>
        <a href="#about">Giới Thiệu</a>
        <a href="#products">Sản Phẩm</a>
        <a href="#contact">Liên Hệ</a>
    </nav>
    <div class="hero">
        <div>
            <h1>Hải Sản Tươi Ngon, Đậm Vị Biển</h1>
            <p>Chúng tôi cung cấp hải sản tươi sống chất lượng cao, giao tận nơi.</p>
        </div>
    </div>
    <div class="content">
        <h2>Về Chúng Tôi</h2>
        <p>Cửa hàng hải sản của chúng tôi cam kết mang đến cho bạn những sản phẩm tươi ngon nhất, được đánh bắt từ biển mỗi ngày.</p>

        <h2>Sản Phẩm Nổi Bật</h2>
        <p>Khám phá các loại tôm, cá, cua và nhiều hải sản khác với giá cả hợp lý.</p>
    </div>
    <footer class="footer">
        <p>&copy; 2025 Cửa Hàng Hải Sản Tươi Sống. Mọi quyền được bảo lưu.</p>
    </footer>
</body>
</html>
