<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm - Chợ Hải Sản</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #2c3e50;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #dddddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            display: block;
            margin: 0 auto;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            color: white;
            background-color: #2c3e50;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #1a252f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Quản Lý Sản Phẩm - Chợ Hải Sản</h1>
    </header>
    <div class="container">
    <a class="btn" href="{{ route('admin.dashboard') }}">Quay lại</a>
    <a class="btn" href="{{ route('products.create') }}">Tạo Mới Sản Phẩm</a>

    <h2>Danh Sách Sản Phẩm</h2>
    <table>
        <thead>
            <tr>
                <th>Tên</th>
                <th>Mô Tả</th>
                <th>Giá</th>
                <th>Giảm Giá</th>
                <th>Hình Ảnh</th>
                <th>Số Lượng</th>
                <th>Cân nặng</th>
                <th>Danh Mục</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                    <td>
                        @if ($product->discount_percentage && $product->discount_percentage > 0)
                            <span style="color: red;">-{{ $product->discount_percentage }}%</span>
                            <br>
                            <small>Bắt đầu: {{ $product->discount_start_date }}</small><br>
                            <small>Kết thúc: {{ $product->discount_end_date }}</small>
                        @else
                            Không giảm giá
                        @endif
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="Image" width="50" height="50">
                    </td>
                    <td>{{ $product->stock }}</td>
                    <td>
    @if ($product->weight)
         {{ $product->weight->value }} kg
    @else
        Không có
    @endif
</td>

                    <td>{{ $product->category->name }}</td>
                    <td>
                        <a class="btn btn-small" href="{{ route('products.edit', $product->id) }}">Chỉnh Sửa</a>
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-small" type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $products->links('vendor.pagination.custom') }}
    </div>
</div>

</body>
</html>
