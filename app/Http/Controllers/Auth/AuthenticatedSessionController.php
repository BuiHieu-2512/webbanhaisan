<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'Email hoặc mật khẩu không đúng.');
    }

    if ($user->is_locked) {
        return back()->with('error', 'Tài khoản của bạn đã bị khóa.');
    }

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        return redirect()->route('home'); // Chuyển hướng sau khi đăng nhập thành công
    }

    return back()->with('error', 'Email hoặc mật khẩu không đúng.');
}
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Điều hướng dựa trên vai trò của người dùng
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/user/dashboard');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function destroy(Request $request) 
    { 
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect('/login'); }

 protected function attemptLogin(Request $request)
    {
    $credentials = $request->only('email', 'password');

    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user && $user->is_locked) {
        return false; // Không cho đăng nhập nếu tài khoản bị khóa
    }

    return $this->guard()->attempt(
        $credentials, $request->filled('remember')
    );
}

}
