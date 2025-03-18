<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm theo Danh Mục - Hải Sản Tươi Sống</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #0177b6;
            color: white;
            text-align: center;
            padding: 1em 0;
            position: relative;
        }
        /* Đặt nút quay lại ở góc trái */
        .back-button-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .btn-back {
            display: flex;
            align-items: center;
            padding: 8px 16px;
            color: white;
            background-color: #0177b6;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-back i {
            margin-right: 8px; /* Khoảng cách giữa biểu tượng và chữ */
        }

        .btn-back:hover {
            background-color: #015d8e;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .search-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 60%;
            max-width: 500px;
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 8px 20px;
        }
        .search-box input {
            border: none;
            outline: none;
            width: 80%;
            padding: 12px;
            font-size: 16px;
            border-radius: 20px;
            margin-right: 10px;
            background-color: #f1f1f1;
        }
        .search-box button {
            padding: 12px 20px;
            background-color: #0177b6;
            border: none;
            border-radius: 20px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .search-box button:hover {
            background-color: #015d8e;
        }
        .search-box button i {
            font-size: 18px;
        }
        .container {
            display: flex;
            flex: 1;
            width: 80%;
            margin: 20px auto;
        }
        .main-content {
            width: 100%;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #0177b6;
        }
        ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        li {
            width: 30%;
            margin-bottom: 20px;
        }
        .product-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            transition: box-shadow 0.3s;
        }
        .product-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .product-card img {
            cursor: pointer;
            max-width: 100%;
            border-radius: 8px;
            transition: transform 0.2s;
        }
        .product-card img:hover {
            transform: scale(1.05);
        }
        .product-card p {
            margin: 10px 0;
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            color: white;
            background-color: #0177b6;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #015d8e;
        }
        .button-container {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        footer {
            background-color: #0177b6;
            color: white;
            text-align: center;
            padding: 1em 0;
            margin-top: auto;
        }
        footer p {
            margin: 0;
        }
    </style>
    <!-- FontAwesome để sử dụng biểu tượng tìm kiếm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="back-button-container">
            <a href="{{ route('user.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Quay lại Trang Chủ <!-- Biểu tượng quay lại -->
            </a>
        </div>
        <h1>Danh Mục: {{ $category->name }}</h1>

        <div class="search-container">
            <form method="GET" action="{{ route('category.products', $category->id) }}">
                <div class="search-box">
                    <input type="text" name="search" placeholder="Tìm sản phẩm..." value="{{ request('search') }}">
                    <button type="submit">
                        <i class="fas fa-search"></i> <!-- Biểu tượng tìm kiếm -->
                    </button>
                </div>
            </form>
        </div>
    </header>

    <div class="container">
    <div class="main-content">
        @if($products->isNotEmpty())
            <ul>
                @foreach($products as $product)
                    <li>
                        <div class="product-card">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="Image" width="150" height="150" onclick="openModal(this)">
                            <p>{{ $product->name }}</p>

                            {{-- Hiển thị cân nặng --}}
                            <p>
                                Cân nặng: 
                                @if ($product->weight)
                                    {{ $product->weight->value }} kg
                                @else
                                    Không có
                                @endif
                            </p>

                            @if ($product->discount_percentage > 0 && now()->between($product->discount_start_date, $product->discount_end_date))
                                @php
                                    $discountAmount = ($product->price * $product->discount_percentage) / 100;
                                    $finalPrice = $product->price - $discountAmount;
                                @endphp
                                <p>Giá gốc: <s>{{ number_format($product->price, 0, ',', '.') }} VNĐ</s></p>
                                <p>Giá sau giảm: <strong style="color: red;">{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</strong></p>
                                <p style="color: green;">Giảm: {{ $product->discount_percentage }}% ({{ number_format($discountAmount, 0, ',', '.') }} VNĐ)</p>
                                <p><strong>Thời gian giảm giá:</strong> {{ date('d/m/Y', strtotime($product->discount_start_date)) }} - {{ date('d/m/Y', strtotime($product->discount_end_date)) }}</p>
                            @else
                                <p>Giá: {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                            @endif

                            <div class="button-container">
                                <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn">Xem Chi Tiết</a>

                                @if(Auth::check())
                                    @if ($product->stock > 0)
                                        <form method="POST" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-danger" onclick="showOutOfStockAlert()">
                                            Hết hàng
                                        </button>
                                    @endif

                                    {{-- Nhúng thư viện SweetAlert2 --}}
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                    <script>
                                        function showOutOfStockAlert() {
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Sản phẩm đã hết hàng!',
                                                text: 'Rất tiếc! Sản phẩm này hiện không còn trong kho. Vui lòng quay lại sau.',
                                                confirmButtonText: 'OK',
                                                confirmButtonColor: '#d33'
                                            });
                                        }
                                    </script>
                                @else
                                    <a href="{{ route('login') }}" class="btn">Đăng nhập để mua hàng</a>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Không có sản phẩm nào trong danh mục này.</p>
        @endif
    </div>
</div>


    <footer>
        <p>&copy; 2025 Hải Sản Tươi Sống. All rights reserved.</p>
    </footer>

    <script>
        function openModal(imgElement) {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            modal.style.display = "block";
            modalImg.src = imgElement.src;
            captionText.innerHTML = imgElement.alt;
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>
</body>
</html>
