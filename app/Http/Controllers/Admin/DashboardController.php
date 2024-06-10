<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', Order::ORDER_STATUS_EXECUTED)->get();

        $cost = 0;
        foreach ($orders as $order) {
            $cost += $order->amount - $order->opt_amount;
        }
        return view('admin.dashboard', compact('cost'));
    }
}
