<?php

namespace App\Http\Services;

use App\Models\Cart;
use App\Models\DeliveryProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\TemporaryCheckout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Spatie\FlareClient\FlareMiddleware\CensorRequestBodyFields;

class CartService
{
    public function addProductToCart(Product $product, $quantity)
    {
        // Получаем товары из открытого чека в сессии
        $cart = session()->get('cart', []);

        $totalQuantity = 0;

        // Вычисляем доступное количество товара на складе
        $availableQuantity = $product->quantity - $totalQuantity;

        // Проверяем, достаточно ли товара на складе
        if ($availableQuantity < $quantity) {
            $cartQnt = $totalQuantity;
            return redirect()->back()->with('error', "Невозможно добавить! Остаток - $availableQuantity штук(и). Количество в открытом чеке - $cartQnt");
        }

        // Добавляем товар в чек
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $cart[$product->id]['quantity'] + $quantity;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->title_uk,
                'price' => $product->price,
                'opt_price' =>$product->opt_price,
                'quantity' => $quantity,
            ];
        }

        // Обновляем данные в сессии
        session()->put('cart', $cart);

        return redirect()->route('home')->with('status', "Товар $product->name добавлен в чек");
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function checkoutProductToDb()
    {
        $cart = session()->get('cart', []);

        $order = Order::create([
            'user_id' => \auth()->user()->id,
            'email' => 'thelotus@gmail.com',
            'customer_name' => \auth()->user()->full_name ? \auth()->user()->full_name : 'Сотрудник',
            'customer_phone' => \auth()->user()->phone,
            'recipient_name' => '',
            'recipient_phone' => '',
            'delivery_option' => Order::DELIVERY_SELF,
            'delivery_address' => '',
            'delivery_date' => Carbon::now()->format('Y-m-d'),
            'delivery_time' => Carbon::now()->format('H:i'),
            'payment_method' => Order::PAYMENT_METHOD_CASH,
            'is_paid' => true,
            'amount' => $this->getTotal(),
            'opt_amount' => $this->getTotalOptPrice(),
            'status' => Order::ORDER_STATUS_EXECUTED,
        ]);


        foreach ($cart as $item) {
//            dd($item);
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'opt_price' => $item['opt_price']
            ]);


            $product = Product::findOrFail($item['product_id']);
            $product->quantity -= intval($item['quantity']);
            $product->save();
        }

        session()->forget('cart');

        return $order;
    }

    public function getTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    public function getTotalOptPrice()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['opt_price'] * $item['quantity'];
        }

        return $total;
    }
}

