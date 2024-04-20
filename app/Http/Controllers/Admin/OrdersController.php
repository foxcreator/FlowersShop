<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        //ToDo make functionality for add order and get this order to crm
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
        return redirect()->back()->with(['status' => 'Статус изменен']);
    }
}
