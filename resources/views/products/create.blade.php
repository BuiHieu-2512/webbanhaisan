<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Mới Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 1em 0;
        }
        .container {
            width: 60%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
            align-items: flex-start;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button, .back-btn {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #2c3e50;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }
        button:hover, .back-btn:hover {
            background-color: #1a252f;
        }
        span {
            color: red;
            font-size: 14px;
        }
        .form-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Tạo Mới Sản Phẩm</h1>
    </header>
    @if (session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0;">
        {{ session('error') }}
    </div>
@endif

    <div class="container">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Tên</label>
                <input id="name" type="text" name="name"  autofocus>
                @error('name')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea id="description" name="description"></textarea>
                @error('description')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input id="price" type="text" name="price" >
                @error('price')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="discount_percentage">Giảm giá (%)</label>
                <input id="discount_percentage" type="number" name="discount_percentage" value="{{ old('discount_percentage', $product->discount_percentage ?? '') }}" min="0" max="100">
            </div>

            <div class="form-group">
                <label for="discount_start_date">Ngày bắt đầu</label>
                <input id="discount_start_date" type="date" name="discount_start_date" value="{{ old('discount_start_date', $product->discount_start_date ?? '') }}">
                @error('discount_start_date')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="discount_end_date">Ngày kết thúc</label>
                <input id="discount_end_date" type="date" name="discount_end_date" value="{{ old('discount_end_date', $product->discount_end_date ?? '') }}">
                @error('discount_end_date')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_url">Hình ảnh</label>
                <input id="image_url" type="file" name="image_url" accept="image/*">
                @error('image_url')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="certification_image_url">Hình ảnh chứng nhận</label>
                <input id="certification_image_url" type="file" name="certification_image_url" accept="image/*">
                @error('certification_image_url')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock">Số lượng</label>
                <input id="stock" type="number" name="stock" >
                @error('stock')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
    <label for="weight_id">Cân nặng</label>
    <select id="weight_id" name="weight_id" required>
        <option value="" disabled selected>-- Chọn cân nặng --</option>
        @foreach ($weights as $weight)
            <option value="{{ $weight->id }}">
                {{ $weight->name }} ({{ $weight->value }} kg)
            </option>
        @endforeach
    </select>
    @error('weight_id')
        <span style="color: red;">{{ $message }}</span>
    @enderror
</div>


            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-buttons">
                <a href="{{ route('products.index') }}" class="back-btn">Quay lại</a>
                <button type="submit">Tạo Mới</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let today = new Date().toISOString().split("T")[0];

            let startDateInput = document.getElementById("discount_start_date");
            let endDateInput = document.getElementById("discount_end_date");

            if (startDateInput) {
                startDateInput.setAttribute("min", today);
                startDateInput.addEventListener("change", function () {
                    if (startDateInput.value < today) {
                        alert("Ngày bắt đầu giảm giá không thể là quá khứ!");
                        startDateInput.value = "";
                    }
                    if (endDateInput.value && endDateInput.value < startDateInput.value) {
                        alert("Ngày kết thúc không được nhỏ hơn ngày bắt đầu!");
                        endDateInput.value = "";
                    }
                });
            }

            if (endDateInput) {
                endDateInput.setAttribute("min", today);
                endDateInput.addEventListener("change", function () {
                    if (endDateInput.value < today) {
                        alert("Ngày kết thúc giảm giá không thể là quá khứ!");
                        endDateInput.value = "";
                    }
                    if (startDateInput.value && endDateInput.value < startDateInput.value) {
                        alert("Ngày kết thúc không được nhỏ hơn ngày bắt đầu!");
                        endDateInput.value = "";
                    }
                });
            }
        });
    </script>
</body>
</html>
