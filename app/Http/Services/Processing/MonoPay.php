<?php

namespace App\Http\Services\Processing;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MonoPay
{
    const API_URL = 'https://api.monobank.ua/api/merchant/invoice/create';

    public static function create($amount)
    {
        try {
            $response = Http::withHeader('X-Token', env('MONOPAY_API_KEY'))
                ->post(self::API_URL, [
                    'amount' => intval($amount * 100),
                    'redirectUrl' => url('/purchase/order-success'),
                    'webHookUrl' => url('api/purchase/webhook')
                ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return false;
    }
}
