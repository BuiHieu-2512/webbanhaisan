@extends('layouts.user')

@section('content')
<div class="container mt-4">
<nav class="breadcrumb px-4 py-2" style="background-color: #f8f9fa; border-radius: 5px;">
        <a href="{{ route('user.dashboard') }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Home</a>
        <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
        <span class="breadcrumb-item active" style="color: #555; font-weight: bold;">Tin Tức</span>
    </nav>
    <h2 class="text-center text-primary"> Tin Tức Hải Sản </h2>
    
    @if($news->isEmpty())
        <div class="alert alert-warning text-center">Hiện chưa có tin tức nào.</div>
    @else
        <div class="row">
            @foreach($news as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $item->title }}</h5>
                            <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($item->content, 100) }}</p>
                            <a href="{{ route('user.news.show', $item->id) }}" class="btn btn-outline-primary">📖 Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4" style="justify-content: center; margin-top: 20px;">
    <nav>
        <ul class="pagination" style="font-size: 14px; background-color: #f8f9fa; padding: 5px 10px; border-radius: 5px;">
            {{ $news->links() }}
        </ul>
    </nav>
</div>

    @endif
</div>
@endsection