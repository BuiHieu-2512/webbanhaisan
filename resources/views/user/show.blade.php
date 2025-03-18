<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm - Hải Sản Tươi Sống</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e3f2fd; /* Xanh nhạt */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #42a5f5; /* Xanh nhạt hơn */
            color: white;
            text-align: center;
            padding: 1.5em 0;
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
            color: black; /* Màu chữ đen */
            background-color: transparent; /* Nền trong suốt */
            text-decoration: none;
            border-radius: 4px; /* Bo góc mà không có viền */
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-back i {
            font-size: 18px; /* Đặt kích thước cho biểu tượng */
            color: black; /* Màu biểu tượng */
            margin-right: 8px; /* Thêm khoảng cách giữa biểu tượng và chữ */
        }

        .btn-back:hover {
            background-color: #f1f1f1; /* Màu nền khi hover */
        }

        .btn-back:active {
            background-color: #e0e0e0; /* Màu nền khi bấm */
        }

        .container {
            width: 90%;
            margin: 20px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            flex: 1;
        }
        .left-section {
            width: 60%;
            text-align: left;
        }
        .right-section {
            width: 35%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .image-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }
        .image-row img {
            cursor: pointer;
            width: 48%;
            border-radius: 8px;
            transition: transform 0.2s;
            aspect-ratio: 1;
            object-fit: cover;
        }
        .image-row img:hover {
            transform: scale(1.05);
        }
        h1 {
            color:rgb(24, 2, 81); /* Màu xanh nhạt hơn */
        }
        .product-details p {
            margin: 10px 0;
            font-size: 16px;
            color:rgb(3, 14, 24); /* Màu xanh nhẹ */
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            font-size: 18px;
            color: white;
            background-color: #42a5f5; /* Xanh nhạt */
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0;
            border: none;
        }
        .btn:hover {
            background-color:rgb(0, 5, 10); /* Màu xanh sáng hơn khi hover */
        }
        .alert-success {
            margin-top: 15px;
            color: green;
            font-weight: bold;
        }
        footer {
            background-color: #2196f3; /* Xanh nhạt */
            color: white;
            text-align: center;
            padding: 1.5em 0;
            margin-top: auto;
        }
        footer p {
            margin: 0;
        }
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(17, 3, 3, 0.9); 
        }
        .modal-content {
            margin: auto;
            display: block;
            width: 80%; 
            max-width: 700px;
        }
        .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }
        @keyframes zoom {
            from {transform: scale(0)} 
            to {transform: scale(1)}
        }
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }
        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <div class="back-button-container">
            <a href="{{ route('user.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Quay lại Trang Chủ
            </a>
        </div>
        <h1>Chi Tiết Sản Phẩm</h1>
    </header>

    <div class="container">
    <!-- Hiển thị thông báo thêm vào giỏ hàng -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="left-section">
        <h1>{{ $product->name }}</h1>
        <p>Số lượng: {{ $product->stock }}</p>
        <p>Danh mục: {{ $product->category->name }}</p>

        {{-- Hiển thị cân nặng --}}
        <p>
            Cân nặng: 
            @if ($product->weight)
                {{ $product->weight->value }} kg
            @else
                Không có
            @endif
        </p>

        <div class="product-details">
            <p>{{ $product->description }}</p>

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

    <div class="right-section">
        <div class="image-row">
            <img src="{{ asset('storage/' . $product->image_url) }}" alt="Image" class="product-image" onclick="openModal(this)">
            <img src="{{ asset('storage/' . $product->certification_image_url) }}" alt="Certification Image" class="certification-image" onclick="openModal(this)">
        </div>
    </div>
</div>


    <footer>
        <p>&copy; 2025 Chợ Hải Sản. All rights reserved.</p>
    </footer>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

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
