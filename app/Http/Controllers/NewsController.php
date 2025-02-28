<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
   // 1. Hiển thị danh sách tin
   public function index()
   {
       $news = News::orderBy('created_at', 'desc')->get();
       return view('admin.news.index', compact('news'));
   }

   // 2. Hiển thị form thêm tin mới
   public function create()
   {
       return view('admin.news.create');
   }

   // 3. Lưu tin mới vào DB
   public function store(Request $request)
   {
       $request->validate([
           'title' => 'required|string|max:255',
           'content' => 'required',
       ]);

       // Nếu có upload ảnh
       $imagePath = null;
       if ($request->hasFile('image')) {
           $imagePath = $request->file('image')->store('news_images', 'public');
       }

       News::create([
           'title' => $request->input('title'),
           'content' => $request->input('content'),
           'image' => $imagePath,
           'is_published' => $request->has('is_published'),
       ]);

       return redirect()->route('news.index')->with('success', 'Thêm tin tức thành công!');
   }

   // 4. Hiển thị chi tiết 1 tin (nếu cần)
   public function show(News $news)
   {
       return view('admin.news.show', compact('news'));
   }

   // 5. Hiển thị form sửa tin
   public function edit(News $news)
   {
       return view('admin.news.edit', compact('news'));
   }

   // 6. Cập nhật tin trong DB
   public function update(Request $request, News $news)
   {
       $request->validate([
           'title' => 'required|string|max:255',
           'content' => 'required',
       ]);

       $imagePath = $news->image; // Giữ nguyên ảnh cũ

       // Nếu có upload ảnh mới
       if ($request->hasFile('image')) {
           $imagePath = $request->file('image')->store('news_images', 'public');
       }

       $news->update([
           'title' => $request->input('title'),
           'content' => $request->input('content'),
           'image' => $imagePath,
           'is_published' => $request->has('is_published'),
       ]);

       return redirect()->route('news.index')->with('success', 'Cập nhật tin tức thành công!');
   }

   // 7. Xóa tin
   public function destroy(News $news)
   {
       $news->delete();
       return redirect()->route('news.index')->with('success', 'Xóa tin tức thành công!');
   }
}
