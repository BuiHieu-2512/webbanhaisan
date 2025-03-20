<div class="container">
    <h2>Đặt lại mật khẩu</h2>

    @if (session('status'))
        <div class="alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required>
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu mới</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Đặt lại mật khẩu</button>
    </form>

    <a href="{{ route('login') }}" class="back-link">Quay lại đăng nhập</a>
</div>
