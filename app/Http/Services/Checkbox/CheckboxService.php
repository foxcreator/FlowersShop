<?php

namespace App\Http\Services\Checkbox;

use App\Models\Order;
use App\Models\OrderProduct;
use igorbunov\Checkbox\CheckboxJsonApi;
use igorbunov\Checkbox\Config;
use igorbunov\Checkbox\Errors\EmptyResponse;
use igorbunov\Checkbox\Models\Receipts\Delivery;
use igorbunov\Checkbox\Models\Receipts\Goods\GoodItemModel;
use igorbunov\Checkbox\Models\Receipts\Goods\GoodModel;
use igorbunov\Checkbox\Models\Receipts\Goods\Goods;
use igorbunov\Checkbox\Models\Receipts\Payments\CardPaymentPayload;
use igorbunov\Checkbox\Models\Receipts\Payments\CashPaymentPayload;
use igorbunov\Checkbox\Models\Receipts\Payments\Payments;
use igorbunov\Checkbox\Models\Receipts\SellReceipt;

class CheckboxService
{
    protected $config;
    protected $api;
    protected $user;

//    public function __construct($user)
//    {
////        $user = auth()->user();
//        dd($user);
//
//        $this->config = new Config([
//            Config::API_URL => $user->checkbox_login ?? config('checkbox.api_url'),
//            Config::LOGIN => $user->checkbox_login ?? config('checkbox.login'),
//            Config::PASSWORD => $user->checkbox_password ?? config('checkbox.password'),
//            Config::PINCODE => $user->checkbox_pincode ?? config('checkbox.pincode'),
//            Config::LICENSE_KEY => $user->checkbox_key_id ?? config('checkbox.license_key'),
//        ]);
//
//        $this->api = new CheckboxJsonApi($this->config);
//    }

    public function setUser($user)
    {
        $this->user = $user;
        $this->config = new Config([
            Config::API_URL => config('checkbox.api_url'),
            Config::LOGIN => $user->checkbox_login ?? config('checkbox.login'),
            Config::PASSWORD => $user->checkbox_password ?? config('checkbox.password'),
            Config::PINCODE => $user->checkbox_pincode ?? config('checkbox.pincode'),
            Config::LICENSE_KEY => $user->checkbox_key_id ?? config('checkbox.license_key'),
        ]);

        $this->api = new CheckboxJsonApi($this->config);
    }
    /**
     * @throws EmptyResponse
     */
    public function signInCashier()
    {
        $this->api->signInCashier();
    }

    public function getCashierProfile()
    {
        return $this->api->getCashierProfile();
    }

    /**
     * @throws \Exception
     */
    public function receipt($cashierName, $products, $customerMail, $totalPrice, $paymentMethod)
    {
        if ($paymentMethod === Order::PAYMENT_METHOD_BANK) {
            $payments = new CardPaymentPayload(intval($totalPrice) * 100);
        } elseif ($paymentMethod === Order::PAYMENT_METHOD_CASH) {
            $payments = new CashPaymentPayload(intval($totalPrice) * 100);
        }
        $receipt = new SellReceipt(
            $cashierName, // кассир
            'Отдел продаж', // отдел
            new Goods($this->goodsArray($products)),
            new Delivery([$customerMail, 'foxcreatorg@gmail.com']),
            new Payments([$payments]),
        );

        $this->api->createSellReceipt($receipt);
    }

    public function goodsArray($products): array
    {
        $goods = [];
        foreach ($products as $product) {
            $goods[] = new GoodItemModel(
                new GoodModel($product->id, intval($product->price) * 100, $product->product_name),
                $product->quantity * 1000
            );
        }

        return $goods;
    }

    public function getCashierShift()
    {
        return $this->api->getCashierShift();
    }

    public function createShift()
    {
        return $this->api->createShift();
    }

    public function closeShift()
    {
        return $this->api->closeShift();
    }
}
