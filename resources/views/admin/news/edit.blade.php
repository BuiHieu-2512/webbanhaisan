@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex justify-content-center">
    <div class="card shadow-lg border-0 mt-4" style="width: 60%; border-radius: 10px;">
        <div class="card-body p-4">
            <a href="{{ route('news.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-4">
                    <label for="title">Tiêu đề</label>
                    <input type="text" class="form-control py-2" id="title" name="title" value="{{ old('title', $news->title) }}" required>
                </div>

                <div class="form-group mb-4">
                    <label for="content">Nội dung</label>
                    <textarea class="form-control py-2" id="content" name="content" rows="5" required>{{ old('content', $news->content) }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="image">Ảnh minh họa</label>
                    @if($news->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$news->image) }}" alt="Hình ảnh tin tức" class="img-thumbnail" width="150">
                        </div>
                    @endif
                    <input type="file" class="form-control-file mt-2" id="image" name="image">
                </div>

                <div class="form-group form-check mb-4">
                    <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" {{ $news->is_published ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">Xuất bản</label>
                </div>

                <button type="submit" class="btn btn-success w-100 py-3" style="font-size: 18px; height: 30px;">
    <i class="fas fa-save"></i> Cập nhật
</button>

            </form>
        </div>
    </div>
</div>

<style>
    .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 20px;
    }
    .container {
        margin-top: 50px;
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
    }
    /* Hiển thị lỗi */
.alert {
    font-size: 1rem;
    border-radius:15px;
    padding: 15px;
}

/* Form Card */
.card {
    border-radius: 62px;
    padding: 30px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Label */
.form-group label {
    font-weight: bold;
    margin-bottom: 8px;
    font-size: 1.1rem;
}

/* Input và Textarea */
.form-control {
    padding: 14px;
    font-size: 1rem;
    border-radius: 18px;
    margin-top: 16px;
}

/* Giãn cách các nhóm input */
.form-group {
    margin-bottom: 50px;
}

/* Checkbox */
.form-check-label {
    font-size: 1rem;
    margin-left: 15px;
}

/* Nút hành động */
.btn-primary, .btn-secondary {
    font-size: 1.1rem;
    border-radius: 18px;
    padding: 12px 20px;
}

/* Hover Button */
.btn-primary:hover, .btn-secondary:hover {
    opacity: 0.9;
}
.title-news {
    font-size: 1.8rem; /* Giảm kích thước chữ */
    font-weight: bold;
    text-transform: uppercase;
}
</style>
@endsection
