<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class UserNewsController extends Controller
{
    // Hiển thị danh sách tin
    public function index()
    {
        // Lấy tin đã xuất bản, sắp xếp mới nhất
        $news = News::where('is_published', true)
                    ->orderBy('created_at', 'desc')
                    ->paginate(5); // Mỗi trang 5 tin

        return view('user.news.index', compact('news'));
    }

    // Hiển thị chi tiết 1 tin
    public function show(News $news)
    {
        // Nếu tin chưa xuất bản, chặn truy cập
        if (!$news->is_published) {
            abort(404);
        }

        return view('user.news.show', compact('news'));
    }
}
