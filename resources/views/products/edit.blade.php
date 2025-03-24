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

    .form-wrapper {
        width: 90%;
        background: #fff;
        padding: 5px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
       
        font-weight: bold;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 1px;
    }

    label {
        font-weight: bold;
    }

    input, select, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }

    .btn:hover {
        background: #0056b3;
    }

    .back-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-left: 10px; 
    }

    .back-btn:hover {
        background: #545b62;
    }

    .button-group {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="form-wrapper">
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

        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h1>Chỉnh Sửa Sản Phẩm</h1>

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
                <input id="discount_percentage" type="number" name="discount_percentage" value="{{ old('discount_percentage', $product->discount_percentage ?? '') }}" min="0" max="100">
            </div>

            <div class="form-group">
                <label for="discount_start_date">Ngày bắt đầu</label>
                <input id="discount_start_date" type="date" name="discount_start_date" value="{{ old('discount_start_date', $product->discount_start_date ?? '') }}">
            </div>

            <div class="form-group">
                <label for="discount_end_date">Ngày kết thúc</label>
                <input id="discount_end_date" type="date" name="discount_end_date" value="{{ old('discount_end_date', $product->discount_end_date ?? '') }}">
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

            <div class="form-group">
                <label for="weight_id">Cân nặng</label>
                <select id="weight_id" name="weight_id">
                    @foreach ($weights as $weight)
                        <option value="{{ $weight->id }}" {{ $product->weight_id == $weight->id ? 'selected' : '' }}>
                            {{ $weight->value }} kg
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="button-group">
                <a href="{{ route('products.index') }}" class="back-btn">Quay lại</a>
                <button type="submit" class="btn">Cập Nhật</button>
            </div>
        </form>
    </div>
</div>
@endsection
