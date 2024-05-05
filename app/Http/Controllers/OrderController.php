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

        \Cart::session(session('cart_id'));
        $total = \Cart::getTotal();
        $cart = \Cart::getContent();
        if (isset($data['bonus'])) {
            $total = \Cart::getTotal() - $data['bonus'];
            $newBalance = auth()->user()->balance - $data['bonus'];
            auth()->user()->update(['balance' => $newBalance]);
        }
        if ($data['bonus'] == \Cart::getTotal()) {
            $entityToDb['is_paid'] = true;
        }

        $entityToDb['user_id'] = $data['user_id'];
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
        $entityToDb['pay_with_bonus'] = $data['bonus'];
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
            return redirect()->route('front.order.success')->with(['success' => __('statuses.order-create')]);
        }

        return redirect()->back();
    }

    public function payWithBonuses(Request $request)
    {
        $validatedData = $request->validate([
            'bonus' => 'required|numeric',
        ],
        [
            'bonus.required' => 'Поле сумма обязательно для заполнения.',
            'bonus.numeric' => 'Поле сумма должно быть числовым.',
        ]);

        $user = auth()->user();
        if ($user->balance < $validatedData['bonus']) {
            return response()->json(['message' => "Недостаточно бонусов для списания. Доступно: $user->balance"], 422);
        }

        return response()->json(['status' => 200]);
    }

    public function orderSuccess()
    {
        return view('front.purchase.order-success');
    }
}
