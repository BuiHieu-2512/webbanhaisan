@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <a class="btn btn-primary mb-3" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-home"></i> Quay lại Trang Chủ
    </a>
    </div>
    
    <h1 class="mb-4" style="text-align: right; padding-right: 470px;">Danh sách liên hệ</h1>

    
    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($contacts->isEmpty())
        <div class="alert alert-warning">Chưa có liên hệ nào.</div>
    @else
    <div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Nội dung</th>
                <th>Ngày gửi</th>
                <th class="text-center">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->fullname }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($contact->message, 50) }}</td>
                    <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
    <td class="text-center">
    <div class="btn-group">
        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-info btn-sm action-btn">
            <i class="fas fa-eye"></i> Xem
        </a>
        <a href="{{ route('admin.contacts.resend', $contact->id) }}" class="btn btn-success btn-sm action-btn" onclick="return confirm('Gửi lại email này?')">
            <i class="fas fa-envelope"></i> Gửi lại
        </a>
        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm action-btn" onclick="return confirm('Xóa liên hệ này?')">
                <i class="fas fa-trash-alt"></i> Xóa
            </button>
        </form>
    </div>
</td>

                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
 <!-- Phân trang -->
 <div class="pagination">
                    {{ $contacts->links('vendor.pagination.custom') }}
                </div>
</div>
    @endif
<style>
    .table th, .table td {
        padding: 15px; /* Giãn dòng theo chiều ngang và chiều dọc */
        vertical-align: middle; /* Căn giữa nội dung trong cell */
    }

    .table-responsive {
        margin-top: 80px;
    }

    .alert {
        margin-top: 70px;
    }
    .btn-group {
        display: flex; /* Dùng flexbox để căn chỉnh các nút ngang hàng */
        justify-content: center; /* Căn giữa các nút trong container */
        gap: 10px; /* Khoảng cách giữa các nút */
    }

    .action-btn {
        padding: 10px 15px; /* Thêm padding cho các nút */
        font-size: 14px; /* Thay đổi kích thước font của nút */
    }

    .action-btn i {
        margin-right: 5px; /* Khoảng cách giữa icon và chữ */
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }
    .btn-success {
        background-color: #28a745;
        color: white;
    }
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-group .btn:hover {
        opacity: 0.9; /* Hiệu ứng hover cho các nút */
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