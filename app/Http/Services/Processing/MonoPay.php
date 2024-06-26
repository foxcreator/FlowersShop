<?php

namespace App\Http\Services\Processing;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MonoPay
{
    const API_URL = 'https://api.monobank.ua/api/merchant/invoice/create';
    public static function create($amount)
    {
        $response = Http::withHeader('X-Token', env('MONOPAY_API_KEY'))
          ->post(self::API_URL, [
            'amount' => intval($amount * 100),
            'redirectUrl' => url('/purchase/order-success'),
            'webHookUrl' => url('/purchase/webhook')
        ]);

        if ($response->successful()) {
            Log::info($response->json());
        }
    }

    public static function webhook($data)
    {
        Log::info($data);
        dd($data);
    }
}
