<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Banner; // Thêm dòng này!
use App\Models\Product;
use App\Models\Review;

class UserController extends Controller
{
   
    public function index()
    {
        $categories = Category::paginate(3); // Lấy danh sách danh mục với phân trang
        $userName = auth()->check() ? auth()->user()->username : ''; // Lấy tên người dùng từ cột username
        $banners = Banner::where('status', 1)->get(); // Chỉ lấy banner đang hiển thị
        $products = Product::with(['reviews' => function ($query) {
            $query->latest()->limit(5); // Lấy 5 đánh giá mới nhất
        }, 'reviews.user'])->get(); // Lấy danh sách sản phẩm kèm đánh giá
    
        return view('user.home', compact('categories', 'userName', 'banners', 'products'));
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