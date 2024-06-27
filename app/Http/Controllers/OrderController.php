<?php

namespace App\Http\Controllers;

use App\Http\Services\Processing\MonoPay;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Notifications\OrderConfirmationNotification;
use App\Notifications\TelegramOrderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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

            if ($data['bonus'] == \Cart::getTotal()) {
                $entityToDb['is_paid'] = true;
            }
        }

        $opt_amount = 0;

        foreach ($cart as $product) {
            $opt_amount = (intval($opt_amount) + intval($product->attributes->opt_price)) * $product['quantity'];
        }

        $entityToDb['user_id'] = $data['user_id'] ?? null;
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
        $entityToDb['opt_amount'] = $opt_amount;
        $entityToDb['pay_with_bonus'] = isset($data['bonus']) ?: 0;
        $entityToDb['delivery_address'] = $data['city'].', '.$data['street'].' '.$data['house'].', '.$data['flat'];


        DB::beginTransaction();

        $order = Order::create($entityToDb);
        foreach ($cart as $product) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $product->quantity,
                'price' => $product->price,
                'opt_price' => $product->attributes->opt_price
            ]);

            $productRating = Product::find($product->id);
            if ($product->quantity <= $productRating->quantity) {
                $productRating->rating += 1;
                $productRating->quantity -= $product->quantity;
                $productRating->save();
            }
        }

        if ($order->payment_method === Order::PAYMENT_METHOD_BANK) {
            $response = MonoPay::create($order->amount);

            if (isset($response['pageUrl'])) {
                $order->invoice_id = $response['invoiceId'];
                $order->save();
                DB::commit();
                \Cart::clear();
                return redirect($response['pageUrl']);
            } else {
                Log::info($response);
                DB::rollBack();
                return redirect()->back()->with('error', 'Виникла помилка, спробуйте ще раз');
            }
        }

        DB::commit();

        if ($order) {
            Mail::to($entityToDb['email'])->send(new OrderConfirmationNotification($order));
            Notification::route('telegram', -4219102586)
                ->notify(new TelegramOrderNotification($order));

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

    public function webhook(Request $request)
    {
        $data = $request->all();
        Log::info('Request:', $data);
        if ($data['status'] === 'success') {
            $order = Order::where('invoice_id', $data['invoiceId'])->first();
            $order->is_paid = true;
            $order->save();

            Notification::route('telegram', -4219102586)
                ->notify(new TelegramOrderNotification($order));
//            Mail::to($order->email)->send(new OrderConfirmationNotification($order));

        }

    }
}
