<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?seafood,ocean') no-repeat center center/cover;
            font-family: Arial, sans-serif;
        }
        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .btn-back {
            display: inline-block;
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-back:hover {
            background: #0056b3;
        }
        h2, h4 {
            color: #35424a;
        }
        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th {
            background: #007bff !important;
            color: white;
            text-align: center;
        }
        .status-pending {
            color: #ff9800;
            font-weight: bold;
        }
        .status-completed {
            color: #28a745;
            font-weight: bold;
        }
        .status-cancelled {
            color: #dc3545;
            font-weight: bold;
        }
        .dropdown-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .dropdown-container select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding-right: 30px;
        }
        .dropdown-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('admin.orders.index') }}" class="btn-back">⬅ Quay lại</a>
        <h2 class="text-center mt-3"><i class="fa-solid fa-receipt"></i> Chi tiết đơn hàng #{{ $order->id }}</h2>
        <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
        <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
        <p><strong>Trạng thái:</strong> 
            <span class="{{ $order->status == 'Đã hủy' ? 'status-cancelled' : ($order->status == 'Hoàn thành' ? 'status-completed' : 'status-pending') }}">
                {{ $order->status }}
            </span>
        </p>

        <h4>Sản phẩm trong đơn hàng</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="mt-3">Cập nhật trạng thái</h4>
        @if ($order->status === 'Đã hủy')
            <select class="form-select" disabled>
                <option selected>Đã hủy</option>
            </select>
            <p class="text-danger mt-2"><strong>❌ Đơn hàng này đã bị hủy, không thể cập nhật trạng thái.</strong></p>
        @else
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf
                <div class="dropdown-container">
                    <select name="status" class="form-select">
                        <option value="Đang xử lý" {{ $order->status == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                        <option value="Đã duyệt" {{ $order->status == 'Đã duyệt' ? 'selected' : '' }}>Đã duyệt</option>
                        <option value="Đang giao" {{ $order->status == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                        <option value="Đã giao" {{ $order->status == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                        <option value="Đã hủy" {{ $order->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                    
                </div>
                <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
            </form>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>