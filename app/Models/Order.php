<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'email',
        'delivery_address',
        'delivery_option',
        'delivery_date',
        'delivery_time',
        'payment_method',
        'amount',
        'status',
        'recipient_name',
        'recipient_phone',
    ];

    const DELIVERY_SELF = 'self';
    const DELIVERY_COURIER = 'courier';

    const DELIVERIES = [
        self::DELIVERY_SELF => 'Самовывоз',
        self::DELIVERY_COURIER => 'Доставка'
    ];

    const PAYMENT_METHOD_CASH = 'cash';
    const PAYMENT_METHOD_BANK = 'bank';

    const PAYMENTS = [
        self::PAYMENT_METHOD_BANK => 'Банковская карта',
        self::PAYMENT_METHOD_CASH => 'При получении'
    ];

    const ORDER_STATUS_RECEIVED = 'received';
    const ORDER_STATUS_PROGRESS = 'progress';
    const ORDER_STATUS_AWAITING = 'awaiting';
    const ORDER_STATUS_EXECUTED = 'executed';

    const ORDER_STATUSES = [
        self::ORDER_STATUS_RECEIVED => 'Получен',
        self::ORDER_STATUS_PROGRESS => 'В работе',
        self::ORDER_STATUS_AWAITING => 'Ожидает доставки',
        self::ORDER_STATUS_EXECUTED => 'Выполнен',
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getStatusNameAttribute(): string
    {
        return self::ORDER_STATUSES[$this->attributes['status']] ?? '';
    }

    public function getPaymentMethodNameAttribute(): string
    {
        return self::PAYMENTS[$this->attributes['payment_method']] ?? '';
    }

    public function getDeliveryOptionNameAttribute(): string
    {
        return self::DELIVERIES[$this->attributes['delivery_option']] ?? '';
    }
}
