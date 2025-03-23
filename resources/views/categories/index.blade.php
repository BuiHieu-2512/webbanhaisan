@extends('layouts.admin')

@section('styles')
<style>
    .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 20px;
    }

    header {
        text-align: center;
        margin: 20px 0;
    }

    h1 {
        font-size: 24px;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        position: relative;
    }

    table thead {
        background-color: #007bff;
        color: white;
    }

    table thead th {
        text-align: left;
        padding: 10px;
        position: relative; /* Để định vị các nút */
    }

    table tbody tr {
        border-bottom: 1px solid #ddd;
        transition: background-color 0.3s;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    table tbody td {
        padding: 10px;
        text-align: left;
    }

    .btn {
        display: inline-block;
        padding: 6px 12px;
        background: #007bff;
        color: #fff;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background: #0056b3;
    }

    .btn-container {
        position: absolute;
    }

    .btn-quay-lai {
        position: absolute;
        top: -40px; /* Đưa nút lên trên cột "Tên" */
        left: 10px;
    }

    .btn-tao-moi {
        position: absolute;
        top: -40px; /* Đưa nút lên trên cột "Hành động" */
        right: 10px;
    }

    .actions a, .actions button {
        margin: 0 5px;
    }

    .actions button {
        background: #dc3545;
    }

    .actions button:hover {
        background: #c82333;
    }

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

    /* Modal styling */
    .modal {
        display: none;
        position: fixed;
        z-index: 10;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        width: 80%;
        max-width: 500px;
        text-align: center;
    }

    .modal-content p {
        font-size: 16px;
        margin-bottom: 20px;
    }

    .modal-content .btn {
        display: inline-block;
        width: 100px;
    }

    .close {
        float: right;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
        color: #000;
    }
</style>
@endsection

@section('content')
<header>
    <h1>Danh Sách Danh Mục</h1>
</header>
<div class="container">
    <table>
        <thead>
            <tr>
                <th>
                    Tên
                    <a class="btn btn-quay-lai" href="{{ route('admin.dashboard') }}">Quay lại</a>
                </th>
                <th>Mô Tả</th>
                <th>Hình Ảnh</th>
                <th>
                    Hành Động
                    <a class="btn btn-tao-moi" href="{{ route('categories.create') }}">Tạo Mới Danh Mục</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td><img src="{{ asset('storage/' . $category->img) }}" alt="Image" width="50" height="50" style="border-radius: 5px;"></td>
                    <td class="actions">
                        <a class="btn" href="{{ route('categories.edit', $category->id) }}">Chỉnh Sửa</a>
                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display:inline;" onsubmit="return false">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="button" onclick="openModal(this)">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
</div>

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
<div class="pagination">
        {{ $categories->links('vendor.pagination.custom') }}
    </div>
@endsection