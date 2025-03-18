<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Tin Tức</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .news-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        .news-card:hover {
            transform: scale(1.03);
        }
        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
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
        <a href="{{ route('user.dashboard') }}" class="btn-back">⬅ Quay lại Trang Chủ</a>
        <h1 class="mb-4 text-center">Danh sách Tin Tức</h1>

        @if($news->isEmpty())
            <div class="alert alert-warning text-center">Hiện chưa có tin tức nào.</div>
        @else
            <div class="row">
                @foreach($news as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card news-card">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($item->content, 100) }}</p>
                                <a href="{{ route('user.news.show', $item->id) }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $news->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
