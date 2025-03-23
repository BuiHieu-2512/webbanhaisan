@extends('layouts.admin')

@section('content')
<style>
        /* Căn chỉnh tiêu đề "Thêm cân nặng" sang bên phải */
        h2 {
            text-align: right;
            margin-right:520px;
            font-size: 24px;
            font-weight: bold;
            color: #333;        
        }
        /* Định dạng form */
        form {
            max-width: 500px;
            margin: 20px auto;
            
            border-radius: 10px;
           
        }

        /* Bo góc và style cho input */
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: 0.3s;
        }

        /* Hiệu ứng focus */
        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            outline: none;
        }
        /* Nút Lưu */
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Hiệu ứng hover */
        button:hover {
            background: #0056b3;
        }

        </style>
    <h2>Sửa cân nặng</h2>
    <form action="{{ route('weights.update', $weight->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="value">Giá trị cân nặng:</label>
        <input type="text" name="value" value="{{ $weight->value }}" required>

        <button type="submit">Cập nhật</button>
    </form>
@endsection
