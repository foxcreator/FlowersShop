@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="m-0">Заказ №{{ $order->id }}</h1>
                    <h1>
                        <span class="badge
                            @if($order->status === \App\Models\Order::ORDER_STATUS_EXECUTED)
                                text-success
                            @elseif($order->status === \App\Models\Order::ORDER_STATUS_DECLINE)
                                text-danger
                            @else
                                text-info
                            @endif "
                        >
                            {{ $order->statusName }}
                        </span>
                    </h1>

                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Информация
                                        о заказе</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-md-3 d-flex flex-column">
                                            <form action="{{ route('admin.orders.update.status', $order->id) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="status">Изменить статус заказа</label>
                                                    <select class="form-control select2bs4"
                                                            id="status"
                                                            name="status"
                                                            style="width: 100%;"
                                                    >
                                                        @foreach(\App\Models\Order::ORDER_STATUSES as $key => $status)
                                                            <option value="{{ $key }}"
                                                                    @if($order->status === $key) selected @endif>{{ $status }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-success btn-sm">Сохранить</button>
                                            </form>
                                        </div>
                                        <div class="post col-md-9" style="border: none">
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Имя клиента</p>
                                                <h5 class="text-gray-dark">{{ $order->customer_name }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Телефон клиента</p>
                                                <h5 class="text-gray-dark">{{ $order->customer_phone }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Имя получателя</p>
                                                <h5 class="text-gray-dark">{{ $order->recipient_name }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Телефон получателя</p>
                                                <h5 class="text-gray-dark">{{ $order->recipient_phone }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Способ доставки</p>
                                                <h5 class="text-gray-dark">{{ $order->deliveryOptionName }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Дата доставки</p>
                                                <h5 class="text-gray-dark">{{ \Carbon\Carbon::make($order->delivery_date)->format('d.m.Y') }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Время доставки</p>
                                                <h5 class="text-gray-dark">
                                                    {{ $order->delivery_time }}
                                                </h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Метод оплаты</p>
                                                <h5 class="text-gray-dark">{{ $order->paymentMethodName }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Всего к оплате</p>
                                                <h5 class="text-gray-dark">{{ $order->amount }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3"
                                                 style="border-bottom: 1px solid #4a5568">
                                                <p>Оплачено бонусами</p>
                                                <h5 class="text-gray-dark">{{ $order->pay_with_bonus }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                <tr>
                                                    <th>Артикул</th>
                                                    <th>Наименование продукта</th>
                                                    <th class="text-center">Цена</th>
                                                    <th class="text-center">Количество</th>
                                                    <th class="text-right">Сумма</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($order->orderProducts()->with('product')->get() as $orderProduct)
                                                    <tr>
                                                        <td>{{ $orderProduct->product->article }}</td>
                                                        <td>{{ $orderProduct->product->title_uk }}</td>
                                                        <td class="text-center">{{ $orderProduct->product->price }}</td>
                                                        <td class="text-center">{{ $orderProduct->quantity }}</td>
                                                        <td class="text-right text-bold">{{ $orderProduct->product->price * $orderProduct->quantity }}</td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

