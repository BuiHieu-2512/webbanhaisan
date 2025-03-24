<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        img {
            display: block;
            margin: 10px auto;
            max-width: 100%;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background: #1a252f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chi Tiết Sản Phẩm</h1>
        <p><strong>Tên:</strong> {{ $product->name }}</p>
        <p><strong>Mô tả:</strong> {{ $product->description }}</p>
        <p><strong>Giá Gốc:</strong> {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>

        <p><strong>Giảm Giá:</strong> 
            @if($product->discount && $product->discount > 0)
                <span style="color: red;">{{ $product->discount }}% ({{ number_format(($product->price * $product->discount / 100), 0, ',', '.') }} VNĐ)</span>
            @else
                Không có giảm giá
            @endif
        </p>

        <p><strong>Thời gian giảm giá:</strong> 
            @if($product->discount_start && $product->discount_end)
                {{ date('d/m/Y', strtotime($product->discount_start)) }} - {{ date('d/m/Y', strtotime($product->discount_end)) }}
            @else
                Không có thông tin
            @endif
        </p>

        <p><strong>Giá Sau Giảm:</strong> 
            @php
                $finalPrice = $product->price - ($product->price * ($product->discount ?? 0) / 100);
            @endphp
            <span style="color: green;">{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</span>
        </p>

        <p><strong>Số lượng:</strong> {{ $product->stock }}</p>
        <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>

        <p><strong>Hình Ảnh:</strong></p>
        <img src="{{ asset('storage/' . $product->image_url) }}" alt="Image" width="200">

        <p><strong>Hình Ảnh Chứng Nhận:</strong></p>
        <img src="{{ asset('storage/' . $product->certification_image_url) }}" alt="Certification Image" width="200">

        <br>
        <a href="{{ route('products.index') }}" class="btn">Quay lại</a>
    </div>
</body>
</html>