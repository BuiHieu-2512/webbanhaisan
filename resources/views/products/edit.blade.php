<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sản Phẩm</title>
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
        <h1>Chỉnh Sửa Sản Phẩm</h1>
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
    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên</label>
            <input id="name" type="text" name="name" value="{{ $product->name }}">
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea id="description" name="description">{{ $product->description }}</textarea>
            @error('description')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Giá</label>
            <input id="price" type="text" name="price" value="{{ $product->price }}">
            @error('price')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="discount_percentage">Giảm giá (%)</label>
            <input id="discount_percentage" type="number" name="discount_percentage" 
                value="{{ old('discount_percentage', $product->discount_percentage ?? '') }}" min="0" max="100">
        </div>

        <div class="form-group">
            <label for="discount_start_date">Ngày bắt đầu</label>
            <input id="discount_start_date" type="date" name="discount_start_date" 
                value="{{ old('discount_start_date', $product->discount_start_date ?? '') }}">
        </div>

        <div class="form-group">
            <label for="discount_end_date">Ngày kết thúc</label>
            <input id="discount_end_date" type="date" name="discount_end_date" 
                value="{{ old('discount_end_date', $product->discount_end_date ?? '') }}">
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
            <input id="stock" type="number" name="stock" value="{{ $product->stock }}">
            @error('stock')
                <span>{{ $message }}</span>
            @enderror
        </div>
        {{-- 🔹 Thêm phần chọn Cân nặng --}}
        <div class="form-group">
            <label for="weight_id">Cân nặng</label>
            <select id="weight_id" name="weight_id">
                @foreach ($weights as $weight)
                    <option value="{{ $weight->id }}" 
                        {{ $product->weight_id == $weight->id ? 'selected' : '' }}>
                        {{ $weight->value }} kg
                    </option>
                @endforeach
            </select>
            @error('weight_id')
                <span>{{ $message }}</span>
            @enderror


        <div class="form-group">
            <label for="category_id">Danh mục</label>
            <select id="category_id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span>{{ $message }}</span>
            @enderror
        </div>

        
        </div>

        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="back-btn">Quay lại</a>
            <button type="submit">Cập Nhật</button>
        </div>
    </form>
</div>

</body>

</html>