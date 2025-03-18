<h2>Thêm cân nặng</h2>
<form action="{{ route('weights.store') }}" method="POST">
    @csrf
    
    <label for="name">Tên:</label>
    <input type="text" name="name" required>

    <label for="value">Kích cỡ (kg):</label>
    <input type="number" name="value" step="0.01" required>

    <button type="submit">Lưu</button>
</form>
