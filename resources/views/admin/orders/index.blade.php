<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?seafood,fish,ocean') no-repeat center center/cover;
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
        h2 {
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
        .btn-sm {
            border-radius: 5px;
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
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">⬅ Quay lại Trang Chủ</a>
        <h2 class="text-center mt-3"><i class="fa-solid fa-receipt"></i> Danh sách đơn hàng</h2>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="text-center">{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td class="text-end">{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                        <td class="text-center">
                            @php $status = trim((string) $order->status); @endphp
                            @if ($status == 'Chờ xử lý')
                                <span class="status-pending">🕒 {{ $status }}</span>
                            @elseif ($status == 'Hoàn thành')
                                <span class="status-completed">✅ {{ $status }}</span>
                            @elseif ($status == 'Hủy')
                                <span class="status-cancelled">❌ {{ $status }}</span>
                            @else
                                <span>{{ $status }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i> Xem</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-3">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</body>
</html>
