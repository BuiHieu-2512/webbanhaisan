<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment; // Thêm dòng này
use App\Models\OrderDetail;
use App\Models\Category;


class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
    }

    $product = Product::findOrFail($request->product_id);

    // 🛑 Kiểm tra nếu sản phẩm còn hàng
    if ($product->stock <= 0) {
        return redirect()->route('cart.index')->with('error', 'Sản phẩm đã hết hàng!');
    }

    // ✅ Tính giá sau giảm giá (nếu có)
    $discountAmount = ($product->discount_percentage > 0 && now()->between($product->discount_start_date, $product->discount_end_date)) 
                        ? ($product->price * $product->discount_percentage / 100) 
                        : 0;

    $finalPrice = $product->price - $discountAmount;

    $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();

    if ($cartItem) {
        // 🛑 Kiểm tra nếu số lượng trong kho đủ để tăng
        if ($product->stock < 1) {
            return redirect()->route('cart.index')->with('error', 'Số lượng sản phẩm trong kho không đủ.');
        }

        $cartItem->increment('quantity');
    } else {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $finalPrice  // Lưu giá đã giảm vào giỏ hàng
        ]);
    }

    // ✅ Giảm số lượng sản phẩm trong kho
    $product->decrement('stock');

    return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
}

    

    // Hiển thị giỏ hàng
    public function showCart()
{
    $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
    
    // Lấy danh sách danh mục nếu cần
    $categories = Category::all(); 

    return view('user.cart.index', compact('cartItems', 'categories'));
}


    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($id)
{
    $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    // ✅ Tìm sản phẩm tương ứng
    $product = Product::findOrFail($cartItem->product_id);

    // ✅ Cộng lại số lượng vào kho
    $product->increment('stock', $cartItem->quantity);

    // ✅ Xóa sản phẩm khỏi giỏ hàng
    $cartItem->delete();

    return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng và cập nhật lại số lượng trong kho!');
}


    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $product = Product::findOrFail($cartItem->product_id);
    
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
    
        $newQuantity = $request->quantity;
        $oldQuantity = $cartItem->quantity;
        $difference = $newQuantity - $oldQuantity; // Tính chênh lệch số lượng
    
        // Kiểm tra nếu tăng số lượng thì phải trừ kho
        if ($difference > 0) {
            if ($product->stock < $difference) {
                return back()->with('error', 'Không đủ hàng trong kho!');
            }
            $product->decrement('stock', $difference);
        } 
        // Nếu giảm số lượng thì cộng lại kho
        elseif ($difference < 0) {
            $product->increment('stock', abs($difference));
        }
    
        // Cập nhật số lượng trong giỏ hàng
        $cartItem->update(['quantity' => $newQuantity]);
    
        return redirect()->route('cart.index')->with('success', 'Đã cập nhật số lượng sản phẩm.');
    }
    

    // Hiển thị trang thanh toán
    public function checkoutForm()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        return view('user.cart.checkout', compact('cartItems'));
    }

    // Xử lý thanh toán và tạo đơn hàng
    public function checkout(Request $request)
{
    $user = Auth::user();
    $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
    }

    $request->validate([
        'customer_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|regex:/^0[0-9]{9}$/'
    ]);

    DB::beginTransaction();
    try {
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $product = $item->product;
            $discountAmount = ($product->discount_percentage > 0 &&
                               now()->between($product->discount_start_date, $product->discount_end_date))
                ? ($product->price * $product->discount_percentage / 100)
                : 0;
            $finalPrice = $product->price - $discountAmount;
            $totalPrice += $finalPrice * $item->quantity;
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'status' => 'Đang xử lý',
            'customer_name' => $request->customer_name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        $orderDetails = [];
        foreach ($cartItems as $item) {
            $product = $item->product;
            if ($product->stock < $item->quantity) {
                return back()->with('error', 'Sản phẩm ' . $product->name . ' không đủ hàng trong kho.');
            }

            // Giảm số lượng tồn kho
            $product->decrement('stock', $item->quantity);

            // Tính lại giá đã giảm
            $discountAmount = ($product->discount_percentage > 0 &&
                               now()->between($product->discount_start_date, $product->discount_end_date))
                ? ($product->price * $product->discount_percentage / 100)
                : 0;
            $finalPrice = $product->price - $discountAmount;

            $orderDetails[] = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item->quantity,
                'price' => $finalPrice,
            ];
        }

        // Lưu toàn bộ chi tiết đơn hàng một lần
        OrderDetail::insert($orderDetails);

        // Lưu thông tin thanh toán vào bảng payments
        Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'COD', // Thay bằng phương thức thanh toán thực tế (VNPay, PayPal, etc.)
            'payment_status' => 'Chưa thanh toán', // Cập nhật trạng thái sau khi thanh toán thành công
            'transaction_id' => null, // Đối với thanh toán online, có thể cập nhật sau
            'payment_date' => null, // Cập nhật khi thanh toán thành công
        ]);

        // Xóa giỏ hàng sau khi đặt hàng thành công
        Cart::where('user_id', $user->id)->delete();

        DB::commit();
        return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công!');
    } catch (\Exception $e) {
        DB::rollBack();
        dd($e->getMessage()); // Xem lỗi chi tiết
        return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt hàng.');
    }
}

    

    // Hủy đơn hàng và hoàn lại số lượng sản phẩm
    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->with('orderDetails')->firstOrFail();

        if ($order->status !== 'Đang xử lý') {
            return back()->with('error', 'Chỉ có thể hủy đơn hàng khi đang ở trạng thái "Đang xử lý".');
        }

        DB::beginTransaction();
        try {
            // Cập nhật trạng thái đơn hàng
            $order->update(['status' => 'Đã hủy']);

            // Hoàn lại số lượng sản phẩm vào kho
            foreach ($order->orderDetails as $detail) {
                Product::where('id', $detail->product_id)->increment('stock', $detail->quantity);
            }

            DB::commit();
            return back()->with('success', 'Đơn hàng đã bị hủy và số lượng sản phẩm được hoàn lại.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi hủy đơn hàng.');
        }
    }
}
