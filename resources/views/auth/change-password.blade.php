
<div class="container">
    <h2>Đổi Mật Khẩu</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('password.change') }}">
        @csrf
        <div class="form-group">
            <label for="current_password">Mật khẩu hiện tại</label>
            <input type="password" name="current_password" required>
            @error('current_password') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" name="new_password" required>
            @error('new_password') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
            <input type="password" name="new_password_confirmation" required>
        </div>

        <button type="submit">Cập nhật mật khẩu</button>
    </form>
</div>

