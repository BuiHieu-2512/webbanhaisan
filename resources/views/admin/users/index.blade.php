@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-end">
    <h1 class="fw-bold text-primary" style="text-align: right; width: 60%;">Quản lý Người Dùng</h1>
</div>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mt-3" style="margin-top: 40px;">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
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
                                <span class="badge bg-danger">🔒 Đã khóa</span>
                            @else
                                <span class="badge bg-success">✅ Hoạt động</span>
                            @endif
                        </td>
                        <td>
                            @if (auth()->user()->role === 'admin')
                                <form action="{{ route('admin.users.lock', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm">
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
    </div>
</div>
<div class="pagination">
    {{ $users->links('vendor.pagination.custom') }}
</div>
    </div>
<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a, .pagination span {
        margin: 0 5px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        color: #007bff;
        text-decoration: none;
        border-radius: 5px;
    }

    .pagination a:hover {
        background: #007bff;
        color: white;
    }
</style>
@endsection
