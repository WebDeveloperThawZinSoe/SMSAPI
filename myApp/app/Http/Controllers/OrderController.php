<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function userOrders()
    {
        $orders = Order::where("user_id",auth::user()->id)->latest()->paginate(10);
        return view('user.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.orders.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'total_sms' => 'required|integer|min:1',
            'rate'      => 'required|numeric|min:0',
            'status'    => 'required|string|in:pending,completed,cancelled',
        ]);

        $totalCost = $request->total_sms * $request->rate;
        $orderNumber = strtoupper(Str::random(10));

        Order::create([
            'user_id'      => $request->user_id,
            'order_number' => $orderNumber,
            'total_sms'    => $request->total_sms,
            'rate'         => $request->rate,
            'total_cost'   => $totalCost,
            'status'       => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        $users = User::all();
        return view('admin.orders.edit', compact('order', 'users'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'total_sms' => 'required|integer|min:1',
            'rate'      => 'required|numeric|min:0',
            'status'    => 'required|string|in:pending,completed,cancelled',
        ]);

        $order->user_id = $request->user_id;
        $order->total_sms = $request->total_sms;
        $order->rate = $request->rate;
        $order->total_cost = $request->total_sms * $request->rate;
        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
