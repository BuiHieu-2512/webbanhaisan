<h1>Quản lý Người Dùng</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Vai Trò</th>
            <th>Trạng Thái</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    @if ($user->is_locked)
                        🔒 Đã khóa
                    @else
                        ✅ Hoạt động
                    @endif
                </td>
                <td>
                    @if (auth()->user()->role === 'admin')
                        <form action="{{ route('admin.users.lock', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-warning">
                                @if ($user->is_locked)
                                    🔓 Mở Khóa
                                @else
                                    🔒 Khóa
                                @endif
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
