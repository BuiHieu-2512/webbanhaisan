@extends('layouts.user')

@section('content')

<nav class="breadcrumb px-4 py-2" style="background-color: #f8f9fa; border-radius: 5px;">
    <a href="{{ route('user.dashboard') }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Home</a>
    <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
    <a href="{{ url()->previous() }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Danh mục</a>
    <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
    <span class="breadcrumb-item active" style="color: #555; font-weight: bold;">Chi tiết sản phẩm</span>
</nav>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <!-- Cột chi tiết sản phẩm (Bên trái) -->
                <div class="col-md-7">
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <p><strong>Số lượng:</strong> {{ $product->stock }}</p>
                    <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
                    <p><strong>Cân nặng:</strong> {{ $product->weight ? $product->weight->value . ' kg' : 'Không có' }}</p>
                    <p>{{ $product->description }}</p>

                    @if ($product->discount_percentage > 0 && now()->between($product->discount_start_date, $product->discount_end_date))
                        @php
                            $discountAmount = ($product->price * $product->discount_percentage) / 100;
                            $finalPrice = $product->price - $discountAmount;
                        @endphp
                        <p>Giá gốc: <s>{{ number_format($product->price, 0, ',', '.') }} VNĐ</s></p>
                        <p class="text-danger fw-bold">Giá sau giảm: {{ number_format($finalPrice, 0, ',', '.') }} VNĐ</p>
                        <p class="text-success">Giảm: {{ $product->discount_percentage }}% ({{ number_format($discountAmount, 0, ',', '.') }} VNĐ)</p>
                        <p><strong>Thời gian giảm giá:</strong> {{ date('d/m/Y', strtotime($product->discount_start_date)) }} - {{ date('d/m/Y', strtotime($product->discount_end_date)) }}</p>
                    @else
                        <p><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                    @endif

                    @if(Auth::check())
    @if ($product->stock > 0)
        <form method="POST" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
            </button>
        </form>
    @else
        <button type="button" class="btn btn-danger" onclick="showOutOfStockAlert()">
            <i class="fas fa-exclamation-circle"></i> Hết hàng
        </button>
    @endif
@else
    <a href="{{ route('login') }}" class="btn btn-warning">
        <i class="fas fa-sign-in-alt"></i> Đăng nhập để mua hàng
    </a>
@endif

                </div>

                <!-- Cột ảnh (Bên phải) -->
                <div class="col-md-5 text-center">
                    <div class="image-container">
                        <!-- Ảnh sản phẩm -->
                        <img src="{{ asset('storage/' . $product->image_url) }}" 
                            alt="Hình ảnh sản phẩm" 
                            class="product-image img-thumbnail rounded shadow-sm"
                            onclick="zoomImage(this)">

                        <!-- Ảnh chứng nhận -->
                        <img src="{{ asset('storage/' . $product->certification_image_url) }}" 
                            alt="Giấy chứng nhận" 
                            class="certificate-image img-thumbnail rounded shadow-sm"
                            onclick="zoomImage(this)">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Đóng container tại đây -->

<!-- Footer được đặt bên ngoài container -->


<script>
    function zoomImage(image) {
        const zoomedImage = document.createElement('img');
        zoomedImage.src = image.src;
        zoomedImage.style.position = 'fixed';
        zoomedImage.style.top = '50%';
        zoomedImage.style.left = '50%';
        zoomedImage.style.transform = 'translate(-50%, -50%)';
        zoomedImage.style.maxWidth = '90vw';
        zoomedImage.style.maxHeight = '90vh';
        zoomedImage.style.boxShadow = '0 0 15px rgba(0, 0, 0, 0.6)';
        zoomedImage.style.cursor = 'zoom-out';
        zoomedImage.style.borderRadius = '10px';
        zoomedImage.style.zIndex = '9999';
        zoomedImage.style.background = 'rgba(0, 0, 0, 0.8)';
        zoomedImage.style.padding = '10px';

        zoomedImage.onclick = () => {
            document.body.removeChild(zoomedImage);
        };

        document.body.appendChild(zoomedImage);
    }
</script>

<style>
    .image-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 10px;
    }

    .product-image, .certificate-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.2s ease-in-out;
        border-radius: 8px;
    }

    .product-image:hover, .certificate-image:hover {
        transform: scale(1.1);
    }
</style>

@endsection
