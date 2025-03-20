<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\Payment;

class VnpayController extends Controller
{
    public function createPayment(Request $request)
{
    $total = (int) str_replace(['.', ','], '', $request->input('total_amount'));

    if ($total < 5000 || $total > 999999999) {
        return redirect()->route('cart.index')->with('error', 'Số tiền phải từ 5,000 đến dưới 1 tỷ đồng!');
    }

    // Lấy thông tin khách hàng từ form
    $customerInfo = json_encode([
        'customer_name' => $request->input('customer_name'),
        'address' => $request->input('address'),
        'phone' => $request->input('phone'),
    ]);

    // Cấu hình VNPay
    $vnp_TmnCode = config('vnpay.vnp_TmnCode');
    $vnp_HashSecret = config('vnpay.vnp_HashSecret');
    $vnp_Url = config('vnpay.vnp_Url');
    $vnp_ReturnUrl = route('vnpay.return');

    // Tạo dữ liệu thanh toán
    $vnp_TxnRef = time();
    $vnp_Amount = $total * 100;
    $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef . " | " . base64_encode($customerInfo);
    $vnp_IpAddr = request()->ip();

    $inputData = [
        "vnp_Version"    => "2.1.0",
        "vnp_TmnCode"    => $vnp_TmnCode,
        "vnp_Amount"     => $vnp_Amount,
        "vnp_Command"    => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode"   => "VND",
        "vnp_IpAddr"     => $vnp_IpAddr,
        "vnp_Locale"     => "vn",
        "vnp_OrderInfo"  => $vnp_OrderInfo,
        "vnp_OrderType"  => "other",
        "vnp_ReturnUrl"  => $vnp_ReturnUrl,
        "vnp_TxnRef"     => $vnp_TxnRef,
    ];

    ksort($inputData);

    // Tạo query string
    $query = [];
    foreach ($inputData as $key => $value) {
        $query[] = urlencode($key) . "=" . urlencode($value);
    }
    $queryString = implode("&", $query);

    // Tạo Secure Hash
    $vnp_SecureHash = hash_hmac('sha512', $queryString, $vnp_HashSecret);
    $queryString .= '&vnp_SecureHash=' . $vnp_SecureHash;

    // Ghi log kiểm tra
    Log::info("VNPay Request", ['query' => $queryString]);

    return redirect()->away($vnp_Url . '?' . $queryString);
}


public function vnpayReturn(Request $request)
{
    $vnp_HashSecret = config('vnpay.vnp_HashSecret');
    $inputData = $request->all();

    if (!isset($inputData['vnp_SecureHash'])) {
        return view('vnpay.result', [
            'status' => 'Lỗi bảo mật',
            'status_class' => 'error',
            'message' => 'Thiếu mã bảo mật!',
            'txn_id' => 'N/A',
            'amount' => 0,
            'time' => now()->format('d/m/Y H:i:s')
        ]);
    }

    $vnp_SecureHash = $inputData['vnp_SecureHash'];
    unset($inputData['vnp_SecureHash']);
    ksort($inputData);

    $query = [];
    foreach ($inputData as $key => $value) {
        $query[] = urlencode($key) . "=" . urlencode($value);
    }
    $queryString = implode("&", $query);
    $secureHash = hash_hmac('sha512', $queryString, $vnp_HashSecret);

    if ($secureHash === $vnp_SecureHash) {
        if ($inputData['vnp_ResponseCode'] == '00') {
            DB::beginTransaction();
            try {
                // ✅ Kiểm tra và lấy thông tin khách hàng
                preg_match('/\| (.+)$/', $inputData['vnp_OrderInfo'], $matches);
                $customerInfo = isset($matches[1]) ? json_decode(base64_decode($matches[1]), true) : [];
                
                // ✅ Tạo đơn hàng
                $order = new Order();
                $order->user_id = auth()->id() ?? null;
                $order->total_price = $inputData['vnp_Amount'] / 100;
                $order->status = 'Đang xử lý';
                $order->customer_name = $customerInfo['customer_name'] ?? 'Không có tên';
                $order->address = $customerInfo['address'] ?? 'Không có địa chỉ';
                $order->phone = $customerInfo['phone'] ?? 'Không có SĐT';
                $order->save();

                // ✅ Lấy giỏ hàng từ CSDL
                $cartItems = Cart::where('user_id', auth()->id())->get();
                
                foreach ($cartItems as $item) {
                    OrderDetail::create([
                        'order_id'   => $order->id,
                        'product_id' => $item->product_id,
                        'quantity'   => $item->quantity,
                        'price'      => $item->price,
                    ]);
                }

                // ✅ Lưu thông tin thanh toán
                Payment::create([
                    'order_id'       => $order->id,
                    'payment_method' => 'VNPay',
                    'payment_status' => 'Thành công',
                    'transaction_id' => $inputData['vnp_TxnRef'] ?? null,
                    'payment_date'   => now(),
                ]);

                // ✅ Xóa giỏ hàng khỏi CSDL
                Cart::where('user_id', auth()->id())->delete();

                DB::commit();

                return view('vnpay.result', [
                    'status' => 'Thanh toán thành công',
                    'status_class' => 'success',
                    'message' => 'Đơn hàng đã được tạo thành công!',
                    'txn_id' => $inputData['vnp_TxnRef'] ?? 'Không xác định',
                    'amount' => $inputData['vnp_Amount'] / 100,
                    'time' => now()->format('d/m/Y H:i:s')
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return view('vnpay.result', [
                    'status' => 'Lỗi hệ thống',
                    'status_class' => 'error',
                    'message' => 'Lưu đơn hàng thất bại: ' . $e->getMessage(),
                    'txn_id' => 'N/A',
                    'amount' => 0,
                    'time' => now()->format('d/m/Y H:i:s')
                ]);
            }
        }
    }
}
}
