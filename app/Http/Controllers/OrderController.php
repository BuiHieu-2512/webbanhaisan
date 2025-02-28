<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Product;

class OrderController extends Controller
{
    // 1. Tạo đơn hàng từ giỏ hàng
    public function create()
    {
        $cartItems = CartItem::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Giỏ hàng của bạn trống!');
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'Đang xử lý' // Mặc định đơn hàng ở trạng thái này
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        CartItem::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->delete();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được tạo thành công!');
    }

    // 2. Danh sách đơn hàng của khách hàng
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('user.orders.index', compact('orders'));
    }

    // 3. Hủy đơn hàng
    public function cancel(Order $order)
    {
        if (!$this->canCancel($order)) {
            return back()->with('error', 'Không thể hủy đơn hàng này!');
        }
        
        $this->restoreProductQuantity($order);
        
        $order->status = 'Đã hủy'; // Cập nhật trạng thái thay vì 'canceled'
        $order->save();

        return back()->with('success', 'Đơn hàng đã được hủy!');
    }

    // 4. Kiểm tra đơn hàng có thể hủy không
    private function canCancel(Order $order)
    {
        return $order->user_id === Auth::id() && $order->status === 'Đang xử lý';
    }

    // 5. Hoàn lại số lượng sản phẩm khi hủy đơn
    private function restoreProductQuantity(Order $order)
    {
        foreach ($order->orderItems as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->stock += $item->quantity;
                $product->save();
            }
        }
    }

    // 6. Xóa đơn hàng đã hủy
    public function deleteCanceledOrder($orderId)
    {
        $order = Order::find($orderId);
        
        if (!$order) {
            return response()->json(['success' => false, 'error' => 'Đơn hàng không tồn tại.']);
        }

        if ($order->status !== 'Đã hủy') { // Thay đổi thành trạng thái mới
            return response()->json(['success' => false, 'error' => 'Đơn hàng không phải đã hủy.']);
        }

        $order->delete();

        return response()->json(['success' => true]);
    }

    // 7. Cập nhật trạng thái đơn hàng (Dành cho Admin)
    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return back()->with('error', 'Đơn hàng không tồn tại!');
        }

        $validated = $request->validate([
            'status' => 'required|in:Đang xử lý,Đã xác nhận,Đang giao,Đã giao,Đã hủy'
        ]);

        $order->status = $validated['status'];
        $order->save();

        return back()->with('success', 'Trạng thái đơn hàng đã được cập nhật!');
    }
}
