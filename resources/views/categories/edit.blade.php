<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Danh Mục</title>
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
            width: 80%;
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
        label {
            font-weight: bold;
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error {
            color: red;
            font-size: 0.875em;
        }
        button {
            padding: 10px 15px;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1a252f;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-btn:hover {
            background-color: #1a252f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Chỉnh Sửa Danh Mục</h1>
    </header>
    <div class="container">
        
        <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Tên</label>
                <input id="name" type="text" name="name" value="{{ $category->name }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="description">Mô tả</label>
                <textarea id="description" name="description" rows="5">{{ $category->description }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="img">Hình ảnh</label>
                <input id="img" type="file" name="img" accept="image/*">
                @error('img')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div>
            <a href="{{ route('categories.index') }}" class="back-btn">Quay lại </a>
                <button type="submit">Cập Nhật</button>
            </div>
        </form>
    </div>
</body>
</html>
