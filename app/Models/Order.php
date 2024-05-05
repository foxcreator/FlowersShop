<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'email',
        'delivery_address',
        'delivery_option',
        'delivery_date',
        'delivery_time',
        'payment_method',
        'amount',
        'pay_with_bonus',
        'is_paid',
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
    const ORDER_STATUS_DECLINE = 'decline';

    const ORDER_STATUSES = [
        self::ORDER_STATUS_RECEIVED => 'Принят',
        self::ORDER_STATUS_PROGRESS => 'В обработке',
        self::ORDER_STATUS_AWAITING => 'Ожидает доставки',
        self::ORDER_STATUS_EXECUTED => 'Выполнен',
        self::ORDER_STATUS_DECLINE => 'Отменен',
    ];

    const ORDER_STATUSES_UA = [
        self::ORDER_STATUS_RECEIVED => 'Прийнятий',
        self::ORDER_STATUS_PROGRESS => 'Опрацьовується',
        self::ORDER_STATUS_AWAITING => 'Очикує доставки',
        self::ORDER_STATUS_EXECUTED => 'Виконаний',
        self::ORDER_STATUS_DECLINE => 'Відхилено',
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusNameAttribute(): string
    {
        return self::ORDER_STATUSES[$this->attributes['status']] ?? '';
    }

    public function getStatusNameMultiLangAttribute(): string
    {
        if (App::getLocale() === 'ru') {
            return self::ORDER_STATUSES[$this->attributes['status']] ?? '';
        }
        return self::ORDER_STATUSES_UA[$this->attributes['status']] ?? '';

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
