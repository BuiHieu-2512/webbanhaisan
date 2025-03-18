<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Tin Tức</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .news-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .news-container img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .btn-back {
            text-decoration: none;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 15px;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <a href="{{ route('user.news.index') }}" class="btn-back">⬅ Quay lại</a>
        <div class="news-container">
            <h1 class="mb-3">{{ $news->title }}</h1>
            
            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
            @endif
            
            <p class="text-muted"><strong>Ngày đăng:</strong> {{ $news->created_at->format('d/m/Y H:i') }}</p>
            <p class="news-content">{{ $news->content }}</p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>