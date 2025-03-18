<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VnpayController extends Controller
{
    public function createPayment(Request $request)
    {
        $total = (int) str_replace(['.', ','], '', $request->input('total_amount'));

        if ($total < 5000 || $total > 999999999) {
            return redirect()->route('cart.index')->with('error', 'Số tiền phải từ 5,000 đến dưới 1 tỷ đồng!');
        }

        // Cấu hình VNPay
        $vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url = config('vnpay.vnp_Url');
        $vnp_ReturnUrl = route('vnpay.return');

        // Tạo dữ liệu thanh toán
        $vnp_TxnRef = time();
        $vnp_Amount = $total * 100;
        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef;
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

        ksort($inputData); // Bắt buộc sắp xếp theo key tăng dần

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
    unset($inputData['vnp_SecureHash']); // Xóa hash để tạo lại
    ksort($inputData);

    // Tạo lại query string
    $query = [];
    foreach ($inputData as $key => $value) {
        $query[] = urlencode($key) . "=" . urlencode($value);
    }
    $queryString = implode("&", $query);

    // Tạo Secure Hash mới
    $secureHash = hash_hmac('sha512', $queryString, $vnp_HashSecret);

    // Ghi log để debug
    Log::info("VNPay Response", [
        'response' => $inputData,
        'generated_hash' => $secureHash,
        'vnp_SecureHash' => $vnp_SecureHash
    ]);

    if ($secureHash === $vnp_SecureHash) {
        if ($inputData['vnp_ResponseCode'] == '00') {
            return view('vnpay.result', [
                'status' => 'Thanh toán thành công',
                'status_class' => 'success',
                'message' => 'Cảm ơn bạn đã mua hàng!',
                'txn_id' => $inputData['vnp_TxnRef'] ?? 'Không xác định',
                'amount' => $inputData['vnp_Amount'] ?? 0,
                'time' => now()->format('d/m/Y H:i:s')
            ]);
        } else {
            return view('vnpay.result', [
                'status' => 'Thanh toán thất bại',
                'status_class' => 'error',
                'message' => 'Có lỗi xảy ra trong quá trình thanh toán!',
                'txn_id' => $inputData['vnp_TxnRef'] ?? 'Không xác định',
                'amount' => $inputData['vnp_Amount'] ?? 0,
                'time' => now()->format('d/m/Y H:i:s')
            ]);
        }
    } else {
        return view('vnpay.result', [
            'status' => 'Lỗi xác thực',
            'status_class' => 'error',
            'message' => 'Xác thực giao dịch không thành công!',
            'txn_id' => 'N/A',
            'amount' => 0,
            'time' => now()->format('d/m/Y H:i:s')
        ]);
    }
}

}
