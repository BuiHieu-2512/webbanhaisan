@extends('layouts.user')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>🎉 Thành công!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>❌ Lỗi!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<nav class="breadcrumb px-4 py-2" style="background-color: #f8f9fa; border-radius: 5px;">
        <a href="{{ route('user.dashboard') }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Home</a>
        <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
        <span class="breadcrumb-item active" style="color: #555; font-weight: bold;">Lịch Sử Mua Hàng</span>
    </nav>

<div class="container mt-4">
    <h2 class="text-center text-primary">🛒 Lịch Sử Mua Hải Sản 🐠</h2>
    <div class="row">
        @foreach(['Đang xử lý', 'Đã duyệt', 'Đang giao', 'Đã giao', 'Đã hủy'] as $status)
            <div class="col-md-6 mb-4 order-status" id="status-{{ Str::slug($status) }}">
                <div class="card border-info shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            @if($status === 'Đang xử lý') ⏳
                            @elseif($status === 'Đã duyệt') ✅
                            @elseif($status === 'Đang giao') 🚚
                            @elseif($status === 'Đã giao') 🎁
                            @elseif($status === 'Đã hủy') ❌
                            @endif
                            {{ $status }}
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($orders as $order)
                            @if($order->status === $status)
                                <div class="border-bottom pb-3 mb-3 order-item" id="order-{{ $order->id }}">
                                    <h6 class="text-success">💰 #{{ $order->id }} - Tổng: 
                                        <span class="text-danger">{{ number_format($order->total_price, 0, ',', '.') }} VND</span>
                                    </h6>
                                    <ul class="list-group">
                                        @foreach($order->orderItems as $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>🐠 {{ $item->product->name }} (x{{ $item->quantity }})</span>
                                                <strong>{{ number_format($item->price, 0, ',', '.') }} VND</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if($order->status === 'Đang xử lý')
                                        <form method="POST" action="{{ route('orders.cancel', $order->id) }}" class="mt-2 cancel-order-form">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">❌ Hủy đơn</button>
                                        </form>
                                    @endif
                                    @if($order->status === 'Đã giao')
                                        @foreach($order->orderItems as $item)
                                            <button class="btn btn-success btn-sm mt-2 review-btn" 
                                                data-order-id="{{ $order->id }}" 
                                                data-product-id="{{ $item->product->id }}" 
                                                data-product-name="{{ $item->product->name }}">
                                                ⭐ Đánh giá
                                            </button>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal Đánh Giá -->
<div id="reviewModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">⭐ Đánh giá sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="reviewForm" method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <input type="hidden" name="order_id" id="order_id">
                    <input type="hidden" name="product_id" id="product_id">
                    <p><strong>Sản phẩm:</strong> <span id="product_name"></span></p>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Chọn số sao:</label>
                        <select class="form-control" name="rating" id="rating" required>
                            <option value="5">⭐⭐⭐⭐⭐ (5 Sao)</option>
                            <option value="4">⭐⭐⭐⭐ (4 Sao)</option>
                            <option value="3">⭐⭐⭐ (3 Sao)</option>
                            <option value="2">⭐⭐ (2 Sao)</option>
                            <option value="1">⭐ (1 Sao)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="review_text" class="form-label">Nhận xét:</label>
                        <textarea class="form-control" name="review_text" id="review_text" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">📝 Gửi đánh giá</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".review-btn").forEach(button => {
            button.addEventListener("click", function() {
                document.getElementById('order_id').value = this.dataset.orderId;
                document.getElementById('product_id').value = this.dataset.productId;
                document.getElementById('product_name').innerText = this.dataset.productName;
                new bootstrap.Modal(document.getElementById('reviewModal')).show();
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        let alerts = document.querySelectorAll(".alert");
        alerts.forEach(alert => {
            alert.classList.add("fade");
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);
});

</script>
@endsection