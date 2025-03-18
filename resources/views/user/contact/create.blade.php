<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 50%;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        .btn-back {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-back:hover {
            background-color: #2980b9;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 15px;
        }
        button {
            padding: 12px;
            font-size: 16px;
            color: white;
            background-color: #2c3e50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1a252f;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ route('user.dashboard') }}" class="btn-back">⬅ Quay lại Trang Chủ</a>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Hiển thị lỗi validate --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Liên Hệ</h1>

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <label for="fullname">Họ tên</label>
        <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" >

        <label for="phone">Số điện thoại</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" >

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" >

        <label for="message">Nội dung</label>
        <textarea id="message" name="message" rows="5" >{{ old('message') }}</textarea>

        <button type="submit">Gửi liên hệ</button>
    </form>
</div>

</body>
</html>
