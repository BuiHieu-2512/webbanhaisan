<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán đơn hàng</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e3f2fd;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #42a5f5;
            color: white;
            text-align: center;
            padding: 1.5em 0;
            position: relative;
        }
        .back-button-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .btn-back {
            display: flex;
            align-items: center;
            padding: 8px 16px;
            color: black;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn-back i {
            margin-right: 8px;
        }
        .btn-back:hover {
            background-color: #f1f1f1;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }
        h2 {
            text-align: center;
            color: #0288d1;
            font-size: 2.5em;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 16px;
            color: #0288d1;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #81d4fa;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .order-summary {
            margin-top: 20px;
            padding: 20px;
            background: #f1f8e9;
            border-radius: 10px;
        }
        .order-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-summary th, .order-summary td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .total-amount {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            color: #0288d1;
            margin-top: 10px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            color: white;
            background-color: #42a5f5;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0277bd;
        }
    </style>
</head>
<body>
    <header>
        <div class="back-button-container">
            <a href="{{ route('cart.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Quay lại 
            </a>
        </div>
        <h2>Thanh toán đơn hàng</h2>
    </header>

    <!-- Hiển thị thông báo -->
    @if(session('success'))
        <div style="background-color: #4CAF50; color: white; padding: 15px; text-align: center; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #e74c3c; color: white; padding: 15px; text-align: center; border-radius: 5px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
    <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_name">Tên khách hàng</label>
            <input type="text" id="customer_name" name="customer_name" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" id="address" name="address" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="payment_method">Phương thức thanh toán</label>
            <select id="payment_method" name="payment_method" required onchange="handlePaymentMethod()">
                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                <option value="banking">Chuyển khoản ngân hàng</option>
                <option value="vnpay">VNPay</option>
            </select>
        </div>

        <!-- Tóm tắt đơn hàng -->
        <div class="order-summary">
            <h3>Chi tiết đơn hàng</h3>
            <table>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá sau giảm</th>
                    <th>Thành tiền</th>
                </tr>
                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                    @php 
                        $discountAmount = ($item->product->discount_percentage > 0 && now()->between($item->product->discount_start_date, $item->product->discount_end_date)) 
                                            ? ($item->product->price * $item->product->discount_percentage / 100) 
                                            : 0;
                        $finalPrice = $item->product->price - $discountAmount;
                        $total += $finalPrice * $item->quantity;
                    @endphp
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</td>
                        <td>{{ number_format($finalPrice * $item->quantity, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </table>
            <p class="total-amount">Tổng tiền: <strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong></p>
        </div>

        <!-- Input hidden để truyền tổng tiền -->
        <input type="hidden" id="total_amount" name="total_amount" value="{{ $total }}">


        <button type="submit" class="btn-primary">Đặt hàng</button>
    </form>
</div>

<script>
    function handlePaymentMethod() {
        let paymentMethod = document.getElementById("payment_method").value;
        let checkoutForm = document.getElementById("checkout-form");

        if (paymentMethod === "vnpay") {
            checkoutForm.action = "{{ route('vnpay.payment') }}";
        } else {
            checkoutForm.action = "{{ route('cart.checkout') }}";
        }
    }
</script>

</body>
</html>
