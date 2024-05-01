<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return view('front.purchase.order');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        \Cart::session($_COOKIE['cart_id']);
        $total = \Cart::getTotal();
        $cart = \Cart::getContent();

        $entityToDb['customer_name'] = $data['customer_name'];
        $entityToDb['customer_phone'] = $data['customer_phone'];
        $entityToDb['email'] = $data['email'];
        $entityToDb['anonymously'] = isset($data['anonymously']);
        $entityToDb['call'] = isset($data['call']);
        $entityToDb['delivery_date'] = Carbon::create($data['date'])->format('Y-m-d');
        $entityToDb['delivery_time'] = $data['time'];
        $entityToDb['delivery_option'] = $data['delivery_option'];
        $entityToDb['recipient_name'] = $data['name'] ?: $data['customer_name'];
        $entityToDb['recipient_phone'] = $data['phone'] ?: $data['customer_phone'];
        $entityToDb['text_postcard'] = $data['text_postcard'];
        $entityToDb['payment_method'] = $data['payment_method'];
        $entityToDb['comment'] = $data['comment'] ?? '';
        $entityToDb['status'] = Order::ORDER_STATUS_RECEIVED;
        $entityToDb['amount'] = $total;
        $entityToDb['delivery_address'] = $data['city'].', '.$data['street'].' '.$data['house'].', '.$data['flat'];

        DB::beginTransaction();
        $order = Order::create($entityToDb);
        foreach ($cart as $product) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $product->quantity
            ]);
        }
        DB::commit();
        if ($order) {
            \Cart::clear();
            return redirect()->back()->with(['success' => 'Заказ в обработке']);
        }

        return redirect()->back();
    }
}
