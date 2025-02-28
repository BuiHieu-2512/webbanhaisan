<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;

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

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as revenue')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return view('admin.dashboard', compact('orders', 'startDate', 'endDate'));
    }
}
