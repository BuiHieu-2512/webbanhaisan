<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Banner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
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
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Quản lý Banner</h2>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-success">➕ Thêm Banner</a>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
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
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-warning btn-sm">✏️ Sửa</a>
                                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa banner này?')">🗑️ Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
