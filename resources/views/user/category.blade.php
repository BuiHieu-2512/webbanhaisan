@extends('layouts.user')

@section('content')
<div class="container mt-4">
<nav class="breadcrumb px-4 py-2" style="background-color: #f8f9fa; border-radius: 5px;">
        <a href="{{ route('user.dashboard') }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Home</a>
        <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
        <span class="breadcrumb-item active" style="color: #555; font-weight: bold;">Danh mục</span>
    </nav>
    <!-- Tiêu đề danh mục căn giữa -->
    <h2 class="text-primary fw-bold text-center mb-4">Danh Mục: {{ $category->name }}</h2>

    <div class="d-flex justify-content-end mb-4">
        <!-- Thanh tìm kiếm bên phải -->
        <form method="GET" action="{{ route('category.products', $category->id) }}" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Tìm sản phẩm..." value="{{ request('search') }}">
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="row">
        @if($products->isNotEmpty())
            @foreach($products as $product)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card product-card">
                        <img src="{{ asset('storage/' . $product->image_url) }}" 
                            alt="{{ $product->name }}" 
                            class="product-image">

                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-muted">Cân nặng: {{ $product->weight ? $product->weight->value . ' kg' : 'Không có' }}</p>

                            @if ($product->discount_percentage > 0 && now()->between($product->discount_start_date, $product->discount_end_date))
                                @php
                                    $discountAmount = ($product->price * $product->discount_percentage) / 100;
                                    $finalPrice = $product->price - $discountAmount;
                                @endphp
                                <p class="text-danger">Giá sau giảm: <strong>{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</strong></p>
                                <p class="text-decoration-line-through">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                                <p class="text-success">Giảm {{ $product->discount_percentage }}% ({{ number_format($discountAmount, 0, ',', '.') }} VNĐ)</p>
                            @else
                                <p class="text-primary">Giá: {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                            @endif

                            <div class="d-flex justify-content-between mt-3">
                                <!-- Nút "Xem Chi Tiết" với hiệu ứng -->
                                <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-info btn-sm btn-icon">
                                    <i class="fas fa-eye"></i> Xem Chi Tiết
                                </a>

                                @if(Auth::check())
                                    @if ($product->stock > 0)
                                        <form method="POST" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-success btn-sm btn-icon">
                                                <i class="fas fa-cart-plus"></i> Thêm Giỏ Hàng
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-secondary btn-sm btn-icon" onclick="showOutOfStockAlert()">
                                            <i class="fas fa-exclamation-circle"></i> Hết hàng
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-warning btn-sm btn-icon">
                                        <i class="fas fa-user"></i> Đăng nhập để mua hàng
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-danger">Không có sản phẩm nào trong danh mục này.</p>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showOutOfStockAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'Sản phẩm đã hết hàng!',
            text: 'Rất tiếc! Sản phẩm này hiện không còn trong kho. Vui lòng quay lại sau.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
        });
    }
</script>

<style>
/* Tiêu đề danh mục căn giữa */
h2.text-primary {
    font-size: 28px;
    margin-bottom: 20px;
}

/* Thiết kế thanh tìm kiếm */
.search-form {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 25px;
    border: 1px solid #ddd;
    overflow: hidden;
    width: 300px;
    max-width: 100%;
}

.search-input {
    flex: 1;
    border: none;
    padding: 10px 12px;
    font-size: 16px;
    outline: none;
}

.search-button {
    background: transparent;
    color: black;
    border: none;
    padding: 10px 12px;
    cursor: pointer;
}

.search-button i {
    font-size: 18px;
}

/* Card sản phẩm đẹp hơn */
.product-card {
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

/* Hiển thị ảnh sản phẩm đúng kích thước */
.product-image {
    width: 100%;
    height: 180px; /* Giảm chiều cao từ 250px xuống 220px */
    object-fit: cover;
    aspect-ratio: 1/1;
}


/* Hiệu ứng hover cho nút */
.btn-icon {
    display: flex;
    align-items: center;
    gap: 5px;
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-icon i {
    font-size: 14px;
}

.btn-icon:hover {
    transform: scale(1.05);
}

/* Responsive trên mobile */
@media (max-width: 768px) {
    .search-form {
        width: 100%;
    }
}
</style>
@endsection
