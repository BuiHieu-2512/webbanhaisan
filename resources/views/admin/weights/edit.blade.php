<h2>Sửa cân nặng</h2>
<form action="{{ route('weights.update', $weight->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="value">Giá trị cân nặng:</label>
    <input type="text" name="value" value="{{ $weight->value }}" required>

    <button type="submit">Cập nhật</button>
</form>

