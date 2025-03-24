@extends('layouts.admin')

@section('styles')
<style>
    .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 20px;
        background: #fff;
    }

    header {
        text-align: center;
        margin: 20px 0;
    }

    h1 {
        
        font-size: 24px;
        font-weight: bold;
    }

    .form-wrapper {
        width: 100%;
        max-width: 600px;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input, textarea, select {
        width: 100%;
        padding: 20px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .error {
        display: block;
        color: #dc3545;
        font-size: 12px;
        margin-top: -15px;
        margin-bottom: 10px;
    }

    button, .back-btn {
        display: inline-block;
        padding: 10px 15px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        transition: background-color 0.3s;
        margin-right: 10px;
    }

    button:hover, .back-btn:hover {
        background: #0056b3;
    }

    .form-actions {
        text-align: right; /* Căn nút về bên phải */
    }

</style>
@endsection

@section('content')
<header>
    <h1>Tạo Mới Danh Mục - Chợ Hải Sản</h1>
</header>
<div class="container">
    <div class="form-wrapper">
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
            <div class="form-actions">
                <a href="{{ route('categories.index') }}" class="back-btn">Quay lại</a>
                <button type="submit">Tạo Mới</button>
            </div>
        </form>
    </div>
</div>
@endsection