<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách liên hệ</title>
    <!-- Thêm Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">

<div class="container mt-4">
    <a class="btn btn-primary mb-3" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-home"></i> Quay lại Trang Chủ
    </a>

    <h1 class="mb-4">Danh sách liên hệ</h1>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($contacts->isEmpty())
        <div class="alert alert-warning">Chưa có liên hệ nào.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Nội dung</th>
                        <th>Ngày gửi</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->fullname }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($contact->message, 50) }}</td>
                            <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Xem
                                </a>
                                <a href="{{ route('admin.contacts.resend', $contact->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Gửi lại email này?')">
                                    <i class="fas fa-envelope"></i> Gửi lại
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa liên hệ này?')">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Phân trang --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $contacts->links() }}
        </div>
    @endif
</div>

<!-- Thêm Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
