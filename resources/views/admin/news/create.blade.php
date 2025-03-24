@extends('layouts.admin')

@section('content')


    <!-- Hiển thị lỗi -->
    @if ($errors->any())
        <div class="alert alert-danger mb-4 p-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <div class="card shadow-lg border-0">
        <div class="card-body p-5">
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tiêu đề -->
                <div class="form-group mb-5">
                    <label for="title" class="font-weight-bold text-primary mb-2"><i class="fas fa-heading"></i> Tiêu đề</label>
                    <input type="text" class="form-control border-primary rounded p-3" id="title" name="title" value="{{ old('title') }}" required>
                </div>

                <!-- Nội dung -->
                <div class="form-group mb-5">
                    <label for="content" class="font-weight-bold text-primary mb-2"><i class="fas fa-align-left"></i> Nội dung</label>
                    <textarea class="form-control border-primary rounded p-3" id="content" name="content" rows="7" required>{{ old('content') }}</textarea>
                </div>

                <!-- Ảnh minh họa -->
                <div class="form-group">
            <label for="image">Ảnh minh họa (nếu có)</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

                <!-- Xuất bản -->
                <div class="form-group form-check mb-5">
                    <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1">
                    <label class="form-check-label text-primary" for="is_published"><i class=""></i> Xuất bản</label>
                </div>

                <!-- Nút hành động -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('news.index') }}" class="btn btn-secondary px-4 py-2">
                        <i class=""></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-save"></i> Lưu
                    </button>
                </div>
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

/* Tiêu đề chính */
h1 {
    font-size: 2.5rem;
    font-weight: bold;
    text-transform: uppercase;
}

/* Hiển thị lỗi */
.alert {
    font-size: 1rem;
    border-radius: 5px;
    padding: 15px;
}

/* Form Card */
.card {
    border-radius: 12px;
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
    border-radius: 8px;
    margin-top: 16px;
}

/* Giãn cách các nhóm input */
.form-group {
    margin-bottom: 40px;
}

/* Checkbox */
.form-check-label {
    font-size: 1rem;
    margin-left: 5px;
}

/* Nút hành động */
.btn-primary, .btn-secondary {
    font-size: 1.1rem;
    border-radius: 8px;
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