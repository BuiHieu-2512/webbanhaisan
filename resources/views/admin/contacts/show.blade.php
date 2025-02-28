<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Liên Hệ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }

        /* Nút quay lại */
        .back-button {
            display: inline-block;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s;
        }
        .back-button:hover {
            background: #0056b3;
        }

        /* Tiêu đề */
        h1 {
            text-align: center;
            color: #222;
        }

        /* Bố cục nội dung */
        .contact-details {
            max-width: 600px;
            margin: 20px auto;
            font-size: 18px;
            line-height: 1.6;
        }
        .contact-details strong {
            color: #000;
        }
    </style>
</head>
<body>

    <!-- Nút quay lại ở trên bên trái -->
    <a href="{{ route('admin.contacts.index') }}" class="back-button">⬅ Quay lại danh sách</a>

    <!-- Tiêu đề -->
    <h1>Chi Tiết Liên Hệ</h1>

    <!-- Nội dung chi tiết -->
    <div class="contact-details">
        <p><strong>Họ tên:</strong> {{ $contact->fullname }}</p>
        <p><strong>Số điện thoại:</strong> {{ $contact->phone }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Nội dung:</strong> {{ $contact->message }}</p>
        <p><strong>Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
    </div>

</body>
</html>
