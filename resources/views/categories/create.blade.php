<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Mới Danh Mục - Chợ Hải Sản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
        }
        header {
            background-color: #3c8dbc;
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
            background-color: #3c8dbc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1d6a8c;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #3c8dbc;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-btn:hover {
            background-color: #1d6a8c;
        }
    </style>
</head>
<body>
    <header>
        <h1>Tạo Mới Danh Mục - Chợ Hải Sản</h1>
    </header>
    <div class="container">
   
        <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Tên</label>
                <input id="name" type="text" name="name" required autofocus>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="description">Mô tả</label>
                <textarea id="description" name="description" rows="5"></textarea>
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
                <button type="submit">Tạo Mới</button>
            </div>
        </form>
    </div>
</body>
</html>
