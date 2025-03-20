<div class="container">
    <h2>Quên mật khẩu</h2>

    @if (session('status'))
        <div class="alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">Nhập địa chỉ email của bạn</label>
            <input id="email" type="email" name="email" required>
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Gửi yêu cầu đặt lại mật khẩu</button>
    </form>

    <a href="{{ route('login') }}" class="back-link">Quay lại đăng nhập</a>
</div>
