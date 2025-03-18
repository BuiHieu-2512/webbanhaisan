<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Banner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group img {
            display: block;
            margin-top: 10px;
            border-radius: 5px;
            max-width: 100%;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chỉnh sửa Banner</h1>
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description" required>{{ old('description', $banner->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" name="image" id="image">
                <small>Chỉ chọn nếu muốn thay đổi ảnh</small>
                <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner">
            </div>
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select name="status" id="status">
                    <option value="1" {{ $banner->status ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ !$banner->status ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</body>
</html>
