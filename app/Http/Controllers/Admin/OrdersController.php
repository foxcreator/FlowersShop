<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::query()->orderBy('created_at', 'DESC')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = Order::find($id);
        return view('admin.orders.show', compact('order'));
    }

    public function changeStatus(Request $request, string $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        if ($order->user_id && $order->status === Order::ORDER_STATUS_EXECUTED) {
            $user = User::find($order->user_id);
            $user->balance =+ ($order->amount / 100) * 3;
            $user->save();
        }
        return redirect()->back()->with(['status' => 'Статус изменен']);
    }
}
