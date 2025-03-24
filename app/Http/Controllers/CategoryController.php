<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;


class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index() 
    { $categories = Category::paginate(3); 
      return view('categories.index', compact('categories'));
      } 
        
        

    // Hiển thị form tạo danh mục mới
    public function create()
    {
        return view('categories.create');
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate trường img
        ]);

        $data = $request->all();
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $path = $image->store('images', 'public');
            
            $data['img'] = $path;
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được tạo thành công!');
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate trường img
        ]);

        $data = $request->all();
        if ($request->hasFile('img')) {
            // Xóa hình ảnh cũ nếu có
            if ($category->img) {
                Storage::disk('public')->delete($category->img);
            }
            $image = $request->file('img');
            $path = $image->store('images', 'public');
            $data['img'] = $path;
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    // Xóa danh mục
    public function destroy(Category $category)
    {
        if ($category->img) {
            Storage::disk('public')->delete($category->img);
        }
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công!');
    }

    // Tìm kiếm danh mục
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::where('name', 'LIKE', "%$query%")
                              ->orWhere('description', 'LIKE', "%$query%")
                              ->get();

        return view('categories.index', compact('categories'));
    }

    public function show($id)
{
    $category = Category::findOrFail($id);
    $search = request('search');
    
    // Lấy sản phẩm trong danh mục và lọc theo từ khóa tìm kiếm
    $products = Product::where('category_id', $category->id)
                    ->where(function($query) use ($search) {
                        if ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        }
                    })
                    ->get();

    return view('user.category', compact('category', 'products'));
}

    
}
