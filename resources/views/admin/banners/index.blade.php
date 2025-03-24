@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: center; margin-bottom: 20px;">
        <h2 style="color:rgb(0, 0, 0); font-weight: bold;">Quản lý Banner</h2>
    </div>
<div class="container">
    <div style="display: flex; justify-content: flex-end;">
        <a href="{{ route('admin.banners.create') }}" 
           style="background-color: #28a745; color: white; padding: 2px 1px; border-radius: 5px; text-decoration: none; font-weight: bold;">
           ➕ Thêm Banner
        </a>
    </div>
</div>


    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover text-center">
        <thead style="height: 50px;">
    <tr>
        <th style="padding: 12px 8px;">ID</th>
        <th style="padding: 12px 8px;">Hình ảnh</th>
        <th style="padding: 12px   39px;">Tiêu đề</th>
        <th style="padding: 12px   38px;">Mô tả</th>
        <th style="padding: 12px 8px;">Trạng thái</th>
        <th style="padding: 12px 8px;">Hành động</th>
    </tr>
</thead>

            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $banner->image) }}" width="100" height="50" class="banner-img" alt="Banner">
                        </td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->description }}</td>
                        <td>
                            <span class="badge {{ $banner->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $banner->status ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </td>
                        <td>
    <div style="display: flex; gap: 10px; justify-content: center; align-items: center;">
        <a href="{{ route('admin.banners.edit', $banner) }}" 
           style="background-color: #ffc107; color: black; padding: 6px 12px; border-radius: 5px; text-decoration: none; font-weight: bold;">
           ✏️ Sửa
        </a>
        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    style="background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa banner này?')">
                🗑️ Xóa
            </button>
        </form>
    </div>
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    body {
        background-color:rgb(35, 36, 36);
    }
    .container {
        margin-top: 50px;
    }
    table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    thead {
        background: #007bff;
        color: white;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .banner-img {
        border-radius: 8px;
        object-fit: cover;
    }
</style>
@endsection
