<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Danh Mục</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    header {
        background-color: #2c3e50;
        color: white;
        text-align: center;
        padding: 1em 0;
    }
    .container {
        width: 80%;
        margin: 20px auto;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid #dddddd;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    img {
        display: block;
        margin: 0 auto;
    }
    a {
        color: #2c3e50;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    .actions {
        display: flex;
        gap: 10px;
    }
    .actions form {
        display: inline;
    }
    .btn {
        display: inline-block;
        padding: 6px 12px;
        color: white;
        background-color: #2c3e50;
        text-decoration: none;
        border-radius: 4px;
    }
    .btn:hover {
        background-color: #1a252f;
    }
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.4); 
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 80%; 
        max-width: 500px;
        text-align: center;
    }
    .modal-content .btn {
        margin-top: 10px;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .pagination a, .pagination span {
        margin: 0 5px;
        padding: 8px 16px;
        text-decoration: none;
        background-color: #2c3e50;
        color: white;
        border-radius: 4px;
    }
    .pagination a:hover, .pagination span.current {
        background-color: #1a252f;
    }
    </style>
</head>
<body>
    <header>
        <h1>Danh Sách Danh Mục</h1>
    </header>
    <div class="container">
        <a class="btn" href="{{route('admin.dashboard')}}"   >Quay lại</a> <!-- Nút lùi lại -->
        <a class="btn" href="{{ route('categories.create') }}">Tạo Mới Danh Mục</a>
        <table>
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Mô Tả</th>
                    <th>Hình Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td><img src="{{ asset('storage/' . $category->img) }}" alt="Image" width="50" height="50"></td>
                        <td class="actions">
                            <a class="btn" href="{{ route('categories.edit', $category->id) }}">Chỉnh Sửa</a>
                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}" onsubmit="return false">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="button" onclick="openModal(this)">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Liên kết phân trang -->
        <div class="pagination">
            {{ $categories->links('vendor.pagination.custom') }}
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Bạn có chắc chắn muốn xóa danh mục này?</p>
            <button class="btn" onclick="confirmDelete()">Xóa</button>
            <button class="btn" onclick="closeModal()">Hủy</button>
        </div>
    </div>

    <script>
        let formToSubmit;

        function openModal(button) {
            formToSubmit = button.closest("form");
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        function confirmDelete() {
            formToSubmit.submit();
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById("myModal")) {
                closeModal();
            }
        }
    </script>
</body>
</html>
