<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    public function index()
{
    $categories = Category::paginate(3); // Lấy danh sách danh mục với phân trang
    $userName = auth()->check() ? auth()->user()->username : ''; // Lấy tên người dùng từ cột username
    return view('user.home', compact('categories', 'userName'));
}

    
    

    // Hiển thị danh sách sản phẩm theo danh mục
    public function show($id)
    {
        $category = Category::findOrFail($id); // Lấy danh mục theo ID
        return view('user.category', compact('category'));
    }
    public function destroy(Request $request) 
    { 
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect('/login'); 
    }

       
}
