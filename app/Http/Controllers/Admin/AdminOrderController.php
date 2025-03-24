<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }

    // Hiển thị chi tiết đơn hàng
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    // Duyệt đơn hàng (Chỉ cho phép nếu đơn hàng đang ở trạng thái "Đang xử lý")
    public function approve(Order $order)
    {
        if ($order->status === 'Đang xử lý') {
            $order->update(['status' => 'Đã duyệt']);
            return redirect()->back()->with('success', 'Đơn hàng đã được duyệt.');
        }
        return redirect()->back()->with('error', 'Đơn hàng không thể duyệt.');
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        $order->update(['status' => $validated['status']]);
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
    }
}
