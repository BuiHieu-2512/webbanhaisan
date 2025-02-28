
<div class="container">

<a href="{{ route('user.dashboard') }}" class="btn-back">⬅ Quay lại Trang Chủ</a>



{{-- Thông báo thành công --}}
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Hiển thị lỗi validate --}}
    @if($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Liên Hệ</h1>

    

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <label>Họ tên</label><br>
        <input type="text" name="fullname" value="{{ old('fullname') }}"><br><br>

        <label>Số điện thoại</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Nội dung</label><br>
        <textarea name="message" rows="5">{{ old('message') }}</textarea><br><br>

        <button type="submit">Gửi liên hệ</button>
    </form>
</div>

