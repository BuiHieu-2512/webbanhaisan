@extends('layouts.admin')

@section('styles')
<style>
    .full-page-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f4f7f6;
        padding: 20px;
    }

    .form-container {
        width: 100%;
        max-width: 600px;
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s ease-in-out;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .alert {
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .alert.success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert.error {
        background-color: #f8d7da;
        color: #721c24;
    }

    .form-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .form-buttons a,
    .form-buttons button {
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
    }

    .form-buttons a {
        background-color: #007bff;
        color: white;
    }

    .form-buttons a:hover {
        background-color: #0056b3;
    }

    .form-buttons button {
        border: none;
        background-color: #28a745;
        color: white;
    }

    .form-buttons button:hover {
        background-color: #218838;
    }
</style>
@endsection

@section('content')
<div class="full-page-container">
    <div class="form-container">
        <h1>Tạo Mới Sản Phẩm</h1>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        
        @if (session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Tên</label>
                <input id="name" type="text" name="name" autofocus>
            </div>
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input id="price" type="text" name="price">
            </div>
            <div class="form-group">
                <label for="discount_percentage">Giảm giá (%)</label>
                <input id="discount_percentage" type="number" name="discount_percentage" min="0" max="100">
            </div>
            <div class="form-group">
                <label for="discount_start_date">Ngày bắt đầu</label>
                <input id="discount_start_date" type="date" name="discount_start_date">
            </div>
            <div class="form-group">
                <label for="discount_end_date">Ngày kết thúc</label>
                <input id="discount_end_date" type="date" name="discount_end_date">
            </div>
            <div class="form-group">
                <label for="image_url">Hình ảnh</label>
                <input id="image_url" type="file" name="image_url" accept="image/*">
            </div>
            <div class="form-group">
                <label for="certification_image_url">Hình ảnh chứng nhận</label>
                <input id="certification_image_url" type="file" name="certification_image_url" accept="image/*">
            </div>
            <div class="form-group">
                <label for="stock">Số lượng</label>
                <input id="stock" type="number" name="stock">
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
</div>

            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-buttons">
                <a href="{{ route('products.index') }}">Quay lại</a>
                <button type="submit">Tạo Mới</button>
            </div>
        </form>
    </div>
</div>
@endsection
