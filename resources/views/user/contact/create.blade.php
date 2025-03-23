@extends('layouts.user')

@section('content')

<div class="container mt-4">
<nav class="breadcrumb px-4 py-2" style="background-color: #f8f9fa; border-radius: 5px;">
        <a href="{{ route('user.dashboard') }}" class="breadcrumb-item" style="color: #007bff; text-decoration: none; font-weight: bold;">Home</a>
        <span class="breadcrumb-separator" style="font-weight: bold;"> >> </span>
        <span class="breadcrumb-item active" style="color: #555; font-weight: bold;">Liên Hệ </span>
    </nav>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Hiển thị lỗi validate --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-center text-primary">📞 Liên Hệ Với Chúng Tôi </h1>

    <div class="card shadow-lg mt-3">
        <div class="card-body">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="fullname" class="form-label">👤 Họ tên</label>
                    <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" class="form-control" placeholder="Nhập họ tên của bạn">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">📞 Số điện thoại</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Nhập số điện thoại">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">✉️ Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Nhập email của bạn">
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">📝 Nội dung</label>
                    <textarea id="message" name="message" rows="5" class="form-control" placeholder="Nhập nội dung liên hệ">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">📤 Gửi liên hệ</button>
            </form>
        </div>
    </div>
</div>

@endsection
