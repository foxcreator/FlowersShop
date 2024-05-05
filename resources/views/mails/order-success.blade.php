@extends('mails.layout')
@section('content')
    <table class="content" style="width: 100%">
        <tr>
            <td>
                <h2 style="text-align: center">Спасибо за заказ!</h2>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size: 18px; text-align: center;">Номер заказа <span style="color: #909090">{{ $order->id }}</span>.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: center; font-size: 20px;">Ваш заказ:</p>
            </td>
        </tr>
        <tr style="height: 20px"></tr>
        <tr>
            <td>
                @foreach($order->orderProducts as $product)
                    <div style="margin-bottom: 20px">
                        <span style="font-size: 24px">{{ $product->product_name }}</span>
                        <span style="float: right; font-size: 24px;">{{ $product->quantity }} шт</span>
                    </div>
                @endforeach
            </td>
        </tr>

        <tr style="height: 20px"></tr>
        <tr>
            <td>
                    <div style="margin-bottom: 20px">
                        <span style="font-size: 24px">Сумма</span>
                        <span style="float: right; font-size: 24px;">{{ $order->amount }} грн</span>
                    </div>
            </td>
        </tr>
        <tr style="height: 20px"></tr>
        <tr>
            <td>
                <div style="margin-bottom: 20px">
                    <span style="font-size: 20px">Доставка: </span>
                    <span style="float: right; font-size: 24px;">
                        @if($order->delivery_option === \App\Models\Order::DELIVERY_SELF)
                            {{ $order->deliveryOptionName }}
                        @else
                            {{ $order->delivery_address }}
                        @endif
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="margin-bottom: 20px">
                    <span style="font-size: 20px">Время доставки: </span>
                    <span style="float: right; font-size: 24px;">
                        {{ \Carbon\Carbon::create($order->delivery_date)->format('d.m.Y') }}, {{ $order->delivery_time }}
                    </span>
                </div>
            </td>
        </tr>

    </table>
@endsection
