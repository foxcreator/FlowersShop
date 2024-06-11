<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('is_paid', true)->get();

        $orderProducts = OrderProduct::all();
        $bouquetsSale = 0;
        $flowersSale = 0;
        foreach ($orderProducts as $orderProduct) {
            if ($orderProduct->product->type === Product::TYPE_BOUQUET) {
                $bouquetsSale += $orderProduct->quantity;
            }
            if ($orderProduct->product->type === Product::TYPE_FLOWER){
                $flowersSale += $orderProduct->quantity;
            }
        }

        $todayCash = Order::whereDate('created_at', \Illuminate\Support\Carbon::today())->sum('amount');
        $todayOptCash = Order::whereDate('created_at', \Illuminate\Support\Carbon::today())->sum('opt_amount');


        $todayProfit = $todayCash - $todayOptCash;
        $cost = 0;
        foreach ($orders as $order) {
            $cost += $order->amount - $order->opt_amount;
        }
        return view('admin.dashboard', compact(
            'cost',
            'todayCash',
            'todayProfit',
            'flowersSale',
            'bouquetsSale',
        ));
    }
}
