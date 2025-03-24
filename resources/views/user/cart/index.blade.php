@extends('layouts.user')

@section('content')
<div class="main-content">
    <!-- Breadcrumb với dấu >> -->
    <nav class="breadcrumb px-4 py-2" style="background-color: #f8f9fa; border-radius: 5px;">
        <a href="{{ route('user.dashboard') }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Home</a>
        <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
        <span class="breadcrumb-item active" style="color: #555; font-weight: bold;">Giỏ hàng</span>
    </nav>

    <!-- Header tiêu đề -->
    <header class="text-center py-3" style="background-color: #0077be; color: white; border-radius: 5px;">
        <h2 class="m-0">Giỏ hàng của bạn</h2>
    </header>

    <div class="container-fluid my-4">
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @if($cartItems->isEmpty())
            <p class="text-center fs-5 fw-bold text-muted mt-3">Giỏ hàng của bạn đang trống.</p>
        @else
            <!-- Bảng nội dung -->
            <table class="table table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>Giá gốc</th>
                        <th>Giảm giá</th>
                        <th>Giá sau giảm</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                        @php 
                            $discountAmount = ($item->product->discount_percentage > 0 && now()->between($item->product->discount_start_date, $item->product->discount_end_date)) 
                                                ? ($item->product->price * $item->product->discount_percentage / 100) 
                                                : 0;
                            $finalPrice = $item->product->price - $discountAmount;
                            $total += $finalPrice * $item->quantity;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ number_format($item->product->price, 0, ',', '.') }} VNĐ</td>
                            <td>-{{ number_format($discountAmount, 0, ',', '.') }} VNĐ</td>
                            <td><strong>{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</strong></td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control d-inline-block" style="width: 60px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                </form>
                            </td>
                            <td>{{ number_format($finalPrice * $item->quantity, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tổng tiền và nút đặt hàng -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="m-0 fs-5 fw-bold">Tổng tiền: <span class="text-primary">{{ number_format($total, 0, ',', '.') }} VNĐ</span></p>
                <form method="GET" action="{{ route('cart.checkoutForm') }}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">Đặt hàng</button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
