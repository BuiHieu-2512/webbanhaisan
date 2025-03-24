@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <!-- Nút quay lại -->
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-lg btn-primary shadow-lg px-4 py-2 rounded-pill d-flex align-items-center gap-2">
            <i class="fa-solid fa-house-chimney fs-5"></i>
            <span class="fw-bold">Quay lại Trang Chủ</span>
        </a>
    </div>
</div>


    <!-- Card danh sách đơn hàng -->
    <div class="d-flex justify-content-center">
    <div class="card shadow-lg border-0 mb-5" style="width: 90%; margin-left: 34%;">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">
                <i class="fa-solid fa-receipt"></i> Danh sách đơn hàng
            </h3>
        </div>
        </div>
            <div class="card-body">
                <!-- Bảng danh sách đơn hàng -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center"><i class="fa-solid fa-hashtag"></i> ID</th>
                                <th class="text-center"><i class="fa-solid fa-user"></i> Khách hàng</th>
                                <th class="text-center"><i class="fa-solid fa-money-bill-wave"></i> Tổng tiền</th>
                                <th class="text-center"><i class="fa-solid fa-info-circle"></i> Trạng thái</th>
                                <th class="text-center"><i class="fa-solid fa-cogs"></i> Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="align-middle">{{ $order->id }}</td>
                                    <td class="align-middle">
                                        <i class="fa-solid fa-user-circle text-info"></i> {{ $order->customer_name }}
                                    </td>
                                    <td class="align-middle fw-bold text-success">
                                        <i class="fa-solid fa-coins"></i>
                                        {{ number_format($order->total_price, 0, ',', '.') }} VND
                                    </td>
                                    <td class="align-middle">
                                        @php $status = trim((string) $order->status); @endphp
                                        @if ($status == 'Chờ xử lý')
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                <i class="fa-solid fa-hourglass-half"></i> {{ $status }}
                                            </span>
                                        @elseif ($status == 'Hoàn thành')
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="fa-solid fa-check"></i> {{ $status }}
                                            </span>
                                        @elseif ($status == 'Hủy')
                                            <span class="badge bg-danger px-3 py-2">
                                                <i class="fa-solid fa-times"></i> {{ $status }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">{{ $status }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <div class="pagination">
                    {{ $orders->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
        
</div>

<!-- CSS chỉnh lại -->
<style>
    .table {
        width: 100%;
        margin: auto;
    }

    .table th, .table td {
        text-align: center !important;
        padding: 10px; /* Tăng khoảng cách giữa các dòng */
    }

    .card {
        max-width: 30%;
        margin: auto;
        padding: 10px; /* Tăng khoảng cách bên trong card */
    }

    .card-header {
        padding: 10px;
    }

    .table-responsive {
        padding: 5px; /* Thêm khoảng cách giữa bảng và khung */
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
