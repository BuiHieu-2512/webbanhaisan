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
    <h2>Thêm cân nặng</h2>
    <form action="{{ route('weights.store') }}" method="POST">
        @csrf

        <label for="name">Tên:</label>
        <input type="text" name="name" required>

        <label for="value">Kích cỡ (kg):</label>
        <input type="number" name="value" step="0.01" required>

        <button type="submit">Lưu</button>
    </form>
@endsection
