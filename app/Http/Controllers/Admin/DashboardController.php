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
        event(new Registered(auth()->user()));
//        $client = new Client();
//        $url = 'http://192.168.0.102:8100/api/cart-add';
//
//        $headers = [
//            'Content-Type' => 'application/json',
//        ];
//
//        $order = Order::where('payment_method', Order::PAYMENT_METHOD_BANK)->first();
//        $data = [];
//        foreach ($order->orderProducts()->with('product')->get() as $orderProduct) {
//            if ($orderProduct->product->article !== '0000009') {
//                continue;
//            }
//            $data[] = [
//                'user_id' => 1,
//                'article' => $orderProduct->product->article,
//                'quantity' => $orderProduct->quantity
//            ];
//        }
//
//        $response = $client->request('POST', $url, [
//            'headers' => $headers,
//            'json' => ['data' => $data]
//        ]);
//
//
//        $responseData = json_decode($response->getBody(), true);
//        dd($responseData);
        return view('admin.dashboard');
    }

    public function test()
    {
        $client = new Client();
        $url = 'http://192.168.0.102:8100/api/test';

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $data = Product::all();

        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'data' => $data
        ]);

//        $responseData = json_decode($response->getBody(), true);
//        dd($responseData);
    }
}
