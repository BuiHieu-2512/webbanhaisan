@extends('layouts.user')

@section('content')
<div class="main-content">
<nav class="breadcrumb px-4 py-2" style="background-color: #f8f9fa; border-radius: 5px;">
        <a href="{{ route('user.dashboard') }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Home</a>
        <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
        <span class="breadcrumb-item active" style="color: #555; font-weight: bold;">Thanh toán</span>
    </nav>

    <header class="d-flex justify-content-between align-items-center py-3 px-4" style="background-color: #42a5f5; color: white; border-radius: 5px;">
        <h2 class="m-0 text-center w-100" style="font-size: 2rem;">Thanh toán đơn hàng</h2>
    </header>

    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success text-center" style="border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center" style="border-radius: 5px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="card p-4 shadow-sm" style="border-radius: 15px;">
            <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_name" class="form-label" style="color: #0288d1;">Tên khách hàng</label>
                            <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label" style="color: #0288d1;">Địa chỉ</label>
                            <input type="text" id="address" name="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label" style="color: #0288d1;">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="payment_method" class="form-label" style="color: #0288d1;">Phương thức thanh toán</label>
                            <select id="payment_method" name="payment_method" class="form-select" required onchange="handlePaymentMethod()">
                                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                <option value="vnpay">VNPay</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="order-summary" style="background:rgb(239, 242, 243); border-radius: 10px; padding: 20px;">
                            <h3 style="color: #0288d1;">Chi tiết đơn hàng</h3>
                            <table class="table table-bordered text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá sau giảm</th>
                                        <th>Thành tiền</th>
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
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ number_format($finalPrice * $item->quantity, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="text-end fs-5 fw-bold mt-3">Tổng tiền: <span style="color: #0288d1;">{{ number_format($total, 0, ',', '.') }} VNĐ</span></p>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="total_amount" name="total_amount" value="{{ $total }}">
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary btn-lg px-4" style="background-color: #42a5f5; border: none; border-radius: 5px; color: white;">
                        Đặt hàng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function handlePaymentMethod() {
        let paymentMethod = document.getElementById("payment_method").value;
        let checkoutForm = document.getElementById("checkout-form");

        if (paymentMethod === "vnpay") {
            checkoutForm.action = "{{ route('vnpay.payment') }}";
        } else {
            checkoutForm.action = "{{ route('cart.checkout') }}";
        }
    }
</script>
@endsection
