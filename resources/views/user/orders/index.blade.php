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
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
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
    </script>
</body>
</html>
