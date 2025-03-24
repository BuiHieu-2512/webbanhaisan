<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail; // Đảm bảo import đúng model


class AdminController extends Controller
{
    // public function dashboard()
    // {
    //     return view('admin.dashboard');
    // }

    public function dashboard(Request $request)
{
    $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
    $endDate = $request->input('end_date', Carbon::now()->toDateString());

    // Dữ liệu biểu đồ đường (doanh thu theo ngày)
    $orders = Order::whereBetween('created_at', [$startDate, $endDate])
        ->selectRaw('DATE(created_at) as date, SUM(total_price) as revenue')
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

    // Dữ liệu biểu đồ cột (lượt mua sản phẩm)
    $topProducts = OrderDetail::selectRaw('product_id, COUNT(*) as purchase_count')
        ->whereHas('order', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->groupBy('product_id')
        ->orderByDesc('purchase_count')
        ->take(10) // Giới hạn top 10 sản phẩm bán chạy
        ->with('product') // Lấy thông tin sản phẩm
        ->get();

    // Dữ liệu biểu đồ tròn (số lượng đánh giá)
    $reviewCounts = Product::withCount('reviews')
        ->orderByDesc('reviews_count')
        ->get()
        ->pluck('reviews_count', 'name');

    return view('admin.dashboard', compact('orders', 'topProducts', 'reviewCounts', 'startDate', 'endDate'));
}
}
