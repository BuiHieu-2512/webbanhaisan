<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng của bạn</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #42a5f5;
            color: white;
            text-align: center;
            padding: 1.5em 0;
            position: relative;
        }
        header .btn-back {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #0288d1;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
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
            font-size: 2em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #0288d1;
            color: white;
        }
        .btn {
            background-color: #0288d1;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn:hover {
            background-color: #0277bd;
            transform: scale(1.05);
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
            color: #0288d1;
        }
        .buy-container {
            text-align: right;
            margin-top: 20px;
        }
        .btn-buy {
            background-color: rgb(27, 186, 240);
            padding: 12px 20px;
            font-size: 18px;
        }
        .btn-buy:hover {
            background-color: #388e3c;
        }
        input[type="number"] {
            width: 60px;
            text-align: center;
            padding: 5px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #81d4fa;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<header>
    <a href="{{ route('user.dashboard') }}" class="btn-back">⬅ Quay lại Trang Chủ</a>
    <h2>Giỏ hàng của bạn</h2>
</header>

<div class="container">
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

    @if($cartItems->isEmpty())
        <p style="text-align: center; font-size: 18px;">Giỏ hàng trống.</p>
    @else
        <table>
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Giá gốc</th>
                <th>Giảm giá</th>
                <th>Giá sau giảm</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Hành động</th>
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price, 0, ',', '.') }} VNĐ</td>
                    <td>-{{ number_format($discountAmount, 0, ',', '.') }} VNĐ</td>
                    <td><strong>{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</strong></td>
                    <td>
                        <form method="POST" action="{{ route('cart.update', $item->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                            <button type="submit" class="btn">Cập nhật</button>
                        </form>
                    </td>
                    <td>{{ number_format($finalPrice * $item->quantity, 0, ',', '.') }} VNĐ</td>
                    <td>
                        <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <p class="total">Tổng tiền: <strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong></p>

        <div class="buy-container">
            <form method="GET" action="{{ route('cart.checkoutForm') }}">
                @csrf
                <button type="submit" class="btn btn-buy">Đặt hàng</button>
            </form>
        </div>
    @endif
</div>

</body>
</html>
