<!-- resources/views/vnpay/result.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả thanh toán</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .success { color: green; font-size: 24px; }
        .error { color: red; font-size: 24px; }
        .details { margin-top: 20px; font-size: 18px; }
    </style>
</head>
<body>
<a href="{{ route('user.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Quay lại Trang Chủ <!-- Biểu tượng quay lại -->
            </a>
    <h1>{{ $status }}</h1>
    <p class="{{ $status_class }}">{{ $message }}</p>
    
    <div class="details">
        <p><strong>Mã giao dịch:</strong> {{ $txn_id }}</p>
        <p><strong>Số tiền:</strong> {{ number_format($amount, 0, ',', '.') }} VND</p>
        <p><strong>Thời gian:</strong> {{ $time }}</p>
    </div>

</body>
</html>
