<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Danh sách Tin Tức</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container-fluid {
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #343a40;
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
    </style>
</head>
<body>
<div class="container-fluid">
    <a class="btn btn-secondary" href="{{route('admin.dashboard')}}"><i class="fas fa-arrow-left"></i> Quay lại Trang Chủ</a>
    <h1>Danh sách Tin Tức</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('news.create') }}" class="btn btn-custom"><i class="fas fa-plus"></i> Thêm Tin Mới</a>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
