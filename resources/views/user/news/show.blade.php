@extends('layouts.user')

@section('content')

<nav class="breadcrumb px-4 py-2" style="background-color: #f8f9fa; border-radius: 5px;">
    <a href="{{ route('user.dashboard') }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Home</a>
    <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
    <a href="{{ url()->previous() }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Tin Tức</a>
    <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
    <span class="breadcrumb-item active" style="color: #555; font-weight: bold;">Chi tiết Tin Tức</span>
</nav>

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-body">
            <h1 class="mb-3 text-primary text-center"> {{ $news->title }} </h1>

            <div class="d-flex align-items-start">
    <!-- Ảnh bên trái -->
    @if($news->image)
        <div class="me-3">
            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid rounded" style="max-width: 250px; height: auto;">
        </div>
    @endif

    <!-- Nội dung bên phải -->
    <div>
        <p class="text-muted"><strong>📅 Ngày đăng:</strong> {{ $news->created_at->format('d/m/Y H:i') }}</p>
        <div class="news-content p-3 border rounded bg-light">
            {!! nl2br(e($news->content)) !!}
        </div>
    </div>
</div>

        </div>
    </div>
</div>

@endsection
