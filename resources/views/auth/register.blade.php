<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
        @keyframes colorChange {
            0% { background-color: #ffffff; }
            25% { background-color: #ff9999; }
            50% { background-color: #99ff99; }
            75% { background-color: #9999ff; }
            100% { background-color: #ffffff; }
        }
        body {
            background-image: url('https://lh5.googleusercontent.com/JdBlGLfDLKzTM0vJsNMpPG8gX0V1qVqcl2TtW4VnzAoi5rr2oKGy05FPV1PeEqgpf6zojObxtj5CTACNuWam7S2PdDfYoxl28yN8hHY59lkCPD5MmcFIRDziiaa3FHb2lieegyPpqMBSkgDkyCorRPh2b_wcpkcZ3pb87Kbf4-ZyehoNWYgTDWDN'); /* Thay thế bằng URL hình nền của bạn */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            font-family: Arial, sans-serif;
            color: #2E8B57;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: colorChange 10s infinite;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        label {
            font-size: 1.2em;
            color: #2E8B57;
            flex-basis: 30%;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            flex-basis: 65%;
            padding: 10px;
            border: 2px solid #2E8B57;
            border-radius: 5px;
        }
        button {
            background-color: #2E8B57;
            color: white;
            padding: 10px 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }
        button:hover {
            background-color: #1E5B37;
        }
        .login-link {
            display: block;
            margin-top: 20px;
            color: #2E8B57;
            text-decoration: none;
            text-align: center;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng ký</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="username">Tên</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}"  autofocus>
                @error('username')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" >
                @error('email')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" >
                @error('password')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <input id="password_confirmation" type="password" name="password_confirmation" >
            </div>

            <button type="submit">Đăng ký</button>
        </form>
        <a href="{{ route('login') }}" class="login-link">Đã có tài khoản? Đăng nhập tại đây</a>
    </div>
</body>
</html>
