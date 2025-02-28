<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Sửa Tin Tức</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container-fluid {
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn-custom:hover, .btn-secondary:hover {
            opacity: 0.8;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .img-thumbnail {
            margin-bottom: 10px;
        }
        .alert-danger {
            color: red;
        }
        .alert-success {
            color: green;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <a href="{{ route('news.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
    <h1>Sửa Tin Tức</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $news->title) }}" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $news->content) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Ảnh minh họa</label>
            @if($news->image)
                <div>
                    <img src="{{ asset('storage/'.$news->image) }}" alt="" width="100" class="img-thumbnail">
                </div>
            @endif
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" {{ $news->is_published ? 'checked' : '' }}>
            <label class="form-check-label" for="is_published">Xuất bản</label>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
