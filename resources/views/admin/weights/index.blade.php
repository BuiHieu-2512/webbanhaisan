@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 mb-5" style="width: 90%; margin-left:  -25%;">
    <h2 class="text-primary" style="text-align: right; margin-right: 80px;">Danh sách cân nặng</h2>
</div>
</div>
<style>
    .table-container {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
    table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #dee2e6;
    padding: 10px;
    text-align: center;
    font-weight: bold;
}

th {
    background-color: #007bff;
    color: white;
}

td {
    background-color: #f8f9fa;
    color: black;
}


    .btn-sm {
        padding: 5px 10px;
        font-size: 14px;
    }

    .alert {
        margin-bottom: 15px;
    }
</style>
<div style="display: flex; justify-content: flex-end; margin-bottom: 16px;">
    <a href="{{ route('weights.create') }}" 
       style="background-color: #28a745; 
              color: white; 
              padding: 8px 12px; 
              border-radius: 5px; 
              text-decoration: none; 
              font-weight: bold; 
              font-size: 14px;
              display: inline-flex;
              align-items: center;
              gap: 5px;
              transition: background 0.3s ease-in-out;">
       ➕ Thêm cân nặng
    </a>
</div>


    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <div class="table-responsive">
        <table class="table table-bordered table-hover">
        <thead>
    <tr>
        <th style="background-color: #007bff; color: white; padding: 10px; text-align: center; border: 1px solidrgb(3, 4, 4);">
            ID
        </th>
        <th style="background-color: #007bff; color: white; padding: 10px; text-align: center; border: 1px solid #dee2e6;">
            Kích cỡ
        </th>
        <th style="background-color: #007bff; color: white; padding: 10px; text-align: center; border: 1px solid #dee2e6;">
            Hành động
        </th>
    </tr>
</thead>

    <tbody>
        @foreach($weights as $weight)
            <tr>
                <td>{{ $weight->id }}</td>
                <td>{{ $weight->value }}</td>
                <td>
                    <a href="{{ route('weights.edit', $weight->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('weights.destroy', $weight->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>

@endsection
