@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <a class="btn btn-secondary" href="{{route('admin.dashboard')}}"><i class="fas fa-arrow-left"></i> Quay lại Trang Chủ</a>
    <h1>Danh sách Tin Tức</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('news.create') }}" class="btn btn-custom" 
   style="float: right; margin-bottom: 20px; margin-top: 10px;">
   <i class="fas fa-plus"></i> Thêm Tin Mới
</a>
<div style="clear: both;"></div> <!-- Đảm bảo không bị lỗi bố cục -->


    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->is_published ? 'Đã xuất bản' : 'Chưa xuất bản' }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa tin tức này?')"><i class="fas fa-trash-alt"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pagination">
    {{ $news->links('vendor.pagination.custom') }}
</div>
<style>
    .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 20px;
    }
    .container {
        margin-top: 50px;
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
    }
    .btn-custom {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .btn-custom:hover {
        opacity: 0.8;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid #dee2e6;
    }
    th, td {
        padding: 12px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .action-buttons a, .action-buttons button {
        margin-right: 10px;
    }
    .alert-success {
        color: green;
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a, .pagination span {
        margin: 0 5px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        color: #007bff;
        text-decoration: none;
        border-radius: 5px;
    }

    .pagination a:hover {
        background: #007bff;
        color: white;
    }
</style>

@endsection


