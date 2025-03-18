
    <h2>Danh sách cân nặng</h2>
    <a href="{{ route('weights.create') }}">+ Thêm cân nặng</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kích cỡ</th>
            <th>Hành động</th>
        </tr>
        @foreach($weights as $weight)
            <tr>
                <td>{{ $weight->id }}</td>
                <td>{{ $weight->value }}</td>
                <td>
                    <a href="{{ route('weights.edit', $weight->id) }}">Sửa</a>
                    <form action="{{ route('weights.destroy', $weight->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
