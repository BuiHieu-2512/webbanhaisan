<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:500',
        ]);

        // Kiểm tra xem đơn hàng có thuộc về user không
        $order = Order::where('id', $request->order_id)
                      ->where('user_id', Auth::id())
                      ->where('status', 'Đã giao')
                      ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Bạn không thể đánh giá đơn hàng này.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->review_text, // Đổi từ review_text thành comment
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
}
