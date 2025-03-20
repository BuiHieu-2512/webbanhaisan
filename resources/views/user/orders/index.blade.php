<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Mua Hải Sản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f0f8ff;
        }
        .card {
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .btn-danger {
            transition: background-color 0.3s;
        }
        .btn-danger:hover {
            background-color: darkred;
        }
        .order-columns {
            display: flex;
            gap: 20px;
        }
        .order-column {
            flex: 1; 
        }
        .btn-back {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <a href="{{ route('user.dashboard') }}" class="btn-back">⬅ Quay lại Trang Chủ</a>
        <h2 class="text-primary text-center">🐟 Lịch Sử Mua Hải Sản 🦐</h2>
        <div class="order-columns">
            @foreach(['Đang xử lý', 'Đã duyệt', 'Đang giao', 'Đã giao', 'Đã hủy'] as $status)
                <div class="order-column">
                    <h4 class="text-warning">🕒 Đơn Hàng {{ $status }}</h4>
                    <div id="{{ str_replace(' ', '-', strtolower($status)) }}-orders">
                        @foreach($orders as $order)
                            @if($order->status === $status)
                                <div class="card mb-3 shadow-sm border-primary order-card" data-id="{{ $order->id }}">
                                    <div class="card-body">
                                        <h5 class="text-success">💰 Đơn hàng #{{ $order->id }}</h5>
                                        <ul class="list-group mt-2">
                                            @foreach($order->orderItems as $item)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <span class="fw-bold">{{ $item->product->name }}</span> - {{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }} VND
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <p class="mt-2 fw-bold text-danger">💵 Tổng: {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
                                        @if($order->status === 'Đang xử lý')
                                            <form class="cancel-order-form" action="{{ route('orders.cancel', $order->id) }}" method="POST" data-id="{{ $order->id }}">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-danger">❌ Hủy đơn hàng</button>
                                            </form>
                                        @endif
                                        @if($order->status === 'Đã giao')
    @foreach($order->orderItems as $item)
        <button class="btn btn-success mt-2" onclick="openReviewModal({{ $order->id }}, {{ $item->product->id }}, '{{ $item->product->name }}')">
            ⭐ Đánh giá sản phẩm {{ $item->product->name }}
        </button>
    @endforeach
@endif


                                    </div>
                                </div>
                            @endif
                        @endforeach
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
                <h5 class="modal-title">Đánh giá sản phẩm</h5>
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
                        <label for="review_text" class="form-label">Nhận xét của bạn:</label>
                        <textarea class="form-control" name="review_text" id="review_text" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
        document.querySelectorAll('.cancel-order-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                if (confirm("Bạn có chắc chắn muốn hủy đơn hàng này không?")) {
                    this.submit();
                }
            });
        });


        function openReviewModal(orderId, productId, productName) {
        document.getElementById('order_id').value = orderId;
        document.getElementById('product_id').value = productId;
        document.getElementById('product_name').innerText = productName;

        var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
        reviewModal.show();
    }
    </script>
</body>
</html>
