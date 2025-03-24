@extends('layouts.admin')

@section('styles')
<style>
    /* General styles */
    .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 20px;
       
    }

    /* Header styles */
    header {
        text-align: center;
        margin-bottom: 15px;
    }

    /* Action buttons layout */
    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .action-buttons .btn {
        font-size: 14px;
        padding: 10px 15px;
    }

    /* Table styles */
    .table-container {
        margin-top: 20px;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #f9f9f9;
        border-radius: 8px;
    }

    thead {
        background: #007bff;
        color: white;
    }

    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    tbody tr:hover {
        background: #f1f1f1;
    }

    img {
        border-radius: 5px;
        transition: transform 0.2s;
    }

    img:hover {
        transform: scale(1.3);
    }

    /* Small adjustments for responsiveness */
    @media (max-width: 768px) {
        th, td {
            padding: 8px;
        }

        img {
            width: 40px;
            height: 40px;
        }
    
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

@section('content')
<header>
    <h1>Quản Lý Sản Phẩm - Chợ Hải Sản</h1>
</header>

<div class="container" style="margin-top: 20px; padding: 20px; background: #fff; border-radius: 8px;">
    <!-- Header với nút và tiêu đề -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- Nút Quay lại -->
        <a class="btn btn-primary" href="{{ route('admin.dashboard') }}" 
           style="font-size: 16px; padding: 12px 20px; display: flex; align-items: center; font-weight: bold; text-decoration: none;">
            <i class="fas fa-arrow-left" style="margin-right: 10px; font-size: 18px;"></i> Quay lại
        </a>

        <!-- Tiêu đề căn giữa -->
        <h2 style="flex-grow: 1; text-align: center; margin: 0; font-weight: bold; color: #007bff;">Danh Sách Sản Phẩm</h2>

        <!-- Nút Tạo Mới Sản Phẩm -->
        <a class="btn btn-success" href="{{ route('products.create') }}" 
           style="font-size: 16px; padding: 12px 20px; display: flex; align-items: center; font-weight: bold; text-decoration: none;">
            <i class="fas fa-plus-circle" style="margin-right: 10px; font-size: 18px;"></i> Tạo Mới Sản Phẩm
        </a>
    </div>
</div>


    <!-- Table container for product list -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Mô Tả</th>
                    <th>Giá</th>
                    <th>Giảm Giá</th>
                    <th>Hình Ảnh</th>
                    <th>Số Lượng</th>
                    <th>Cân Nặng</th>
                    <th>Danh Mục</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($product->description, 50, '...') }}</td>
                        
                        <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                        <td>
                            @if ($product->discount_percentage > 0)
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
                            {{ $product->weight ? $product->weight->value . ' kg' : 'Không có' }}
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>
    <a href="{{ route('products.edit', $product->id) }}" 
       class="btn btn-danger btn-sm" 
       style="text-decoration: none; padding: 5px 10px; font-weight: bold;">
        <i class="fas fa-edit"></i> Chỉnh Sửa
    </a>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-danger btn-sm" 
                style="text-decoration: none; padding: 5px 10px; font-weight: bold;">
            <i class="fas fa-trash"></i> Xóa
        </button>
    </form>
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="pagination">
        {{ $products->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection
