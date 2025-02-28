<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phản hồi liên hệ</title>
</head>
<body>
    <p>Xin chào {{ $contact->fullname }},</p>
    <p>Chúng tôi đã nhận được yêu cầu liên hệ của bạn.</p>
    <p><strong>Nội dung liên hệ:</strong> {{ $contact->message }}</p>
    <p>Chúng tôi sẽ phản hồi bạn trong thời gian sớm nhất.</p>
    <p>Trân trọng,<br>Đội ngũ hỗ trợ</p>
</body>
</html>
