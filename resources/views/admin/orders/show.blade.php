@extends('layouts.admin')

@section('content')

<div class="container d-flex flex-column align-items-center">
    <!-- Nút quay lại -->
    <div class="d-flex justify-content-center mb-5 mt-3">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary rounded-pill shadow-lg d-flex align-items-center gap-2 px-4 py-2">
            <i class="fa-solid fa-arrow-left"></i> Quay lại
        </a>
    </div>
</div>
<div class="container">
    <div class="d-flex justify-content-center">
        <!-- Card chứa chi tiết đơn hàng -->
        <div class="d-flex justify-content-center">
        <div class="card shadow-lg border-0 mb-5" style="width: 90%; margin-left: 110%;">
                <h2 class="mb-0 py-3">
                    <i class="fa-solid fa-receipt"></i> Chi tiết đơn hàng #{{ $order->id }}
                </h2>
            </div>
            </div>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-3"><strong>👤 Khách hàng:</strong> {{ $order->customer_name }}</p>
                        <p class="mb-3"><strong>📍 Địa chỉ:</strong> {{ $order->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-3"><strong>📞 Số điện thoại:</strong> {{ $order->phone }}</p>
                        <p class="mb-3"><strong>💰 Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
                    </div>
                </div>
                <p class="mt-3"><strong>📌 Trạng thái:</strong> 
                    <span class="badge py-2 px-3 fs-6
                        {{ $order->status == 'Đã hủy' ? 'bg-danger' : 
                            ($order->status == 'Hoàn thành' ? 'bg-success' : 
                            ($order->status == 'Đang giao' ? 'bg-warning' : 'bg-info')) }}">
                        {{ $order->status }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Card chứa danh sách sản phẩm -->
    <div class="container mt-4">
    <div class="row">
        <!-- Cột trái: Sản phẩm trong đơn hàng -->
        <div class="col-md-8">
            <div class="card shadow-lg border-2 mb-5" style="border: 2px solid #007bff; background-color: #f8f9fa;">
                <div class="card-header text-white" style="background-color: #007bff;">
                    <h4 class="mb-0">📦 Sản phẩm trong đơn hàng</h4>
                </div>
                <div class="card-body p-4">
                    <table class="table table-hover text-start">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3">Tên sản phẩm</th>
                                <th class="py-3">Số lượng</th>
                                <th class="py-3">Giá</th>
                                <th class="py-3">Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td class="py-3">{{ $item->product->name }}</td>
                                    <td class="py-3">{{ $item->quantity }}</td>
                                    <td class="py-3">{{ number_format($item->price, 0, ',', '.') }} VND</td>
                                    <td class="py-3">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VND</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Cột phải: Cập nhật trạng thái đơn hàng -->
        <div class="col-md-4">
            <div class="card shadow-lg border-2 text-center mb-5" style="border: 2px solid #6c757d; background-color: #e9ecef;">
                <div class="card-header text-white" style="background-color:rgb(242, 244, 246);">
                    <h4 class="mb-0">🔄 Cập nhật trạng thái</h4>
                </div>
                <div class="card-body py-4">
                    @if ($order->status === 'Đã hủy')
                    <select class="form-select" disabled 
    style="width: 60%; font-size: 18px; padding: 12px; margin-top: 10px; border-radius: 8px; background-color: #f8d7da; color: #721c24; border: 2px solid #f5c6cb;">
    <option selected>Đã hủy</option>
</select>

                        <p class="text-danger mt-3"><strong>❌ Đơn hàng này đã bị hủy, không thể cập nhật trạng thái.</strong></p>
                    @else
                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                            @csrf
                            <div class="dropdown-container mb-4">
                                <select name="status" class="form-select text-center">
                                    <option value="Đang xử lý" {{ $order->status == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="Đã duyệt" {{ $order->status == 'Đã duyệt' ? 'selected' : '' }}>Đã duyệt</option>
                                    <option value="Đang giao" {{ $order->status == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                                    <option value="Đã giao" {{ $order->status == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                                    <option value="Đã hủy" {{ $order->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success shadow-lg" 
    style="width: 60%; font-size:18px; padding: 12px; margin-top: 10px; border-radius: 8px;">
    <i class="fa-solid fa-check-circle"></i> Cập nhật
</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 20px;
       
    }

    .table {
        width: 90%;
        margin: auto;
    }

    .table th, .table td {
        text-align: center !important;
        padding: 10px; /* Tăng khoảng cách giữa các dòng */
    }

    .card {
        max-width: 70%;
        padding: 15px; /* Tăng khoảng cách bên trong card */
    }

    .card-header {
        padding: 10px;
    }

    .table-responsive {
        padding: 5px; /* Thêm khoảng cách giữa bảng và khung */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
