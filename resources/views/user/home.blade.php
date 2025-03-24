@extends('layouts.user')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Danh Mục Sản Phẩm ở góc trái -->
        <div class="col-md-4">
    <div class="sidebar">
        <h4 class="fw-bold">Danh Mục Sản Phẩm</h4>
        <ul class="list-group">
            @if($categories->isNotEmpty())
                @foreach($categories as $category)
                    <li class="list-group-item d-flex align-items-center">
                        <img src="{{ asset('storage/' . $category->img) }}" alt="Image" width="50" height="50" class="me-2">
                        <a href="{{ route('user.category.show', ['id' => $category->id]) }}" 
                           style="color: #007bff; text-decoration: none; font-weight: bold;">
                           {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            @else
                <li class="list-group-item">Không có danh mục nào.</li>
            @endif
        </ul>

        <!-- Phân trang -->
        <div class="mt-3 d-flex justify-content-center">
            {{ $categories->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>


        <!-- Banner ở góc phải -->
        <div class="col-md-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="max-height: 400px; overflow: hidden;">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach ($banners as $index => $banner)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" 
                                @if($index === 0) class="active" aria-current="true" @endif></button>
                    @endforeach
                </div>
                
                <!-- Banner Images -->
                <div class="carousel-inner">
                    @foreach ($banners as $index => $banner)
                        <div class="carousel-item @if($index === 0) active @endif" data-bs-interval="3000">
                            <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="Banner" 
                                 style="height: 400px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Đánh Giá Mới Nhất -->
    <div class="row">
        <div class="col-md-12">
            <h4 class="fw-bold mb-4">Đánh Giá Mới Nhất</h4>
            @foreach($products as $product)
                @if($product->reviews->count() > 0)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            @foreach($product->reviews->take(3) as $review)
                                <div class="border-bottom pb-2 mb-2">
                                    <strong>{{ $review->user->username }} - ⭐ {{ $review->rating }}/5</strong>
                                    <p>{{ $review->comment }}</p>
                                    <small class="text-muted">Ngày đánh giá: {{ $review->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Hàm thay đổi slide thủ công
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');

    function changeSlide(n) {
        showSlide(currentSlide += n);
    }

    function showSlide(n) {
        if (n >= slides.length) currentSlide = 0;
        if (n < 0) currentSlide = slides.length - 1;

        slides.forEach((slide, index) => {
            slide.style.display = (index === currentSlide) ? 'block' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        showSlide(currentSlide);
        setInterval(() => changeSlide(1), 3000);
    });
</script>
@endsection
