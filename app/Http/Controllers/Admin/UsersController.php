<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Áp dụng cho tất cả hàm trong controller
    }
    
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::paginate(10); // Lấy tất cả người dùng
        return view('admin.users.index', compact('users'));
    }

   
    // Xử lý lưu người dùng mới vào DB
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được thêm.');
    }

    // Hiển thị form chỉnh sửa người dùng
   

    public function toggleLock(User $user)
{
    // Chỉ admin mới được khóa/mở khóa tài khoản
    if (auth()->user()->role !== 'admin') {
        return redirect()->route('admin.users.index')->with('error', 'Bạn không có quyền.');
    }

    $user->update(['is_locked' => !$user->is_locked]);

    return redirect()->route('admin.users.index')->with('success', 'Trạng thái tài khoản đã được cập nhật.');
}

}
