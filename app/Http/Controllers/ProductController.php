<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Weight;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::paginate(3);
        return view('products.index', compact('products'));
    }

    // Hiển thị form tạo sản phẩm mới
    public function create()
{
    $categories = Category::all(); 
    $weights = Weight::all(); // Lấy danh sách kích cỡ từ bảng weights
    return view('products.create', compact('categories', 'weights'));
}
    

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'discount_start_date' => 'nullable|date|after_or_equal:today',
            'discount_end_date' => 'nullable|date|after_or_equal:discount_start_date',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'certification_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'weight_id' => 'required|exists:weights,id', // Validate kích cỡ
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $path = $image->store('product_images', 'public');
            $data['image_url'] = $path;
        }
    
        if ($request->hasFile('certification_image_url')) {
            $certificationImage = $request->file('certification_image_url');
            $path = $certificationImage->store('certification_images', 'public');
            $data['certification_image_url'] = $path;
        }
    
        Product::create($data);
        
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo thành công!');
    }
    

    public function edit(Product $product)
    {
        $categories = Category::all(); // Lấy danh sách danh mục
        $weights = Weight::all(); // Lấy danh sách cân nặng
    
        return view('products.edit', compact('product', 'categories', 'weights'));
    }
    
public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'discount_percentage' => 'nullable|integer|min:0|max:100',
        'discount_start_date' => 'nullable|date|after_or_equal:today',
        'discount_end_date' => 'nullable|date|after_or_equal:discount_start_date',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'certification_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
    ], [
        'discount_start_date.after_or_equal' => 'Ngày bắt đầu giảm giá không được là ngày trong quá khứ.',
        'discount_end_date.after_or_equal' => 'Ngày kết thúc giảm giá phải sau hoặc bằng ngày bắt đầu.',
    ]);

    $data = $request->all();

    if ($request->hasFile('image_url')) {
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }
        $image = $request->file('image_url');
        $path = $image->store('product_images', 'public');
        $data['image_url'] = $path;
    }

    if ($request->hasFile('certification_image_url')) {
        if ($product->certification_image_url) {
            Storage::disk('public')->delete($product->certification_image_url);
        }
        $certificationImage = $request->file('certification_image_url');
        $path = $certificationImage->store('certification_images', 'public');
        $data['certification_image_url'] = $path;
    }

    $product->update($data);
    
    return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
}
    
    // Xóa sản phẩm
    public function destroy(Product $product)
    {
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }
        if ($product->certification_image_url) {
            Storage::disk('public')->delete($product->certification_image_url);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }

    // Tìm kiếm sản phẩm
    public function search(Request $request) 
    { $query = $request->input('query'); 
        $products = Product::where('name', 'LIKE', "%{$query}%")->paginate(10); 
        return view('products.index', compact('products')); 
    }
    
    public function show(Product $product)
{
    // Hiển thị chi tiết sản phẩm nếu cần
    return view('products.show', compact('product'));
}

public function showuser($id) { 
    $product = Product::findOrFail($id); 
    return view('user.show', compact('product')); }

}



