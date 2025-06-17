<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Count;
use App\Models\Log;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalCompletedOrderMoney = Order::where('status', 'completed')
            ->sum('total_cost');

        $totalSmsCount = Count::sum('count');

        $todaySmsCount = Log::whereDate('created_at', Carbon::today())->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCompletedOrderMoney',
            'totalSmsCount',
            'todaySmsCount'
        ));
    }
}