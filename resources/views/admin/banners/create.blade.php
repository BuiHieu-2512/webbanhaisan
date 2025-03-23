@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <div class="banner-form">
        <h1>Thêm Banner</h1>
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
</div>

<style>
    /* Tạo viền bo góc và bóng đổ cho form */
    .banner-form {
        max-width: 800px;
        margin: auto;
        padding: 90px;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Tiêu đề form */
    .banner-form h1 {
        text-align: center;
        font-size: 29px;
        font-weight: bold;
        color: #333;
        margin-bottom: 50px;
        margin-top: -80px;
    }

    /* Input và Select */
    .banner-form .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px;
        transition: 0.3s;
    }

    /* Hiệu ứng focus */
    .banner-form .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    /* Nút bấm */
    .banner-form .btn-primary {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        background-color: #007bff;
        border: none;
        transition: 0.3s;
    }

    /* Hiệu ứng hover */
    .banner-form .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Khoảng cách giữa các nhóm input */
    .banner-form .form-group {
        margin-bottom: 15px;
    }

    /* Hiệu ứng cho textarea */
    .banner-form textarea {
        resize: none;
        min-height: 100px;
    }
</style>

@endsection
