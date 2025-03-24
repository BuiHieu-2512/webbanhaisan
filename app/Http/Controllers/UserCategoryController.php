<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    // Hiển thị danh sách danh mục cho người dùng
    public function index()
    {
        $categories = Category::paginate(3); // Lấy danh sách danh mục với phân trang
        return view('user.home', compact('categories'));
    }

    // Hiển thị danh sách sản phẩm theo danh mục
   
        // Hiển thị danh sách sản phẩm theo danh mục
        public function show($id)
        {
            $category = Category::findOrFail($id);
            $products = $category->products; // Giả sử bạn có thiết lập quan hệ giữa Category và Product
    
            return view('user.category', compact('category', 'products'));
        }
    }
    
