@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between w-100">
                    <h1 class="m-0">Заказы</h1>
                    <form action="{{ route('admin.orders.index') }}" method="GET" class="form-inline w-25">
                        <div class="input-group input-group w-100">
                            <input class="form-control form-control-navbar w-100" name="search" type="search" placeholder="Поиск" aria-label="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID заказа</th>
                                    <th>Имя клиента</th>
                                    <th>Телефон</th>
                                    <th>Метод оплаты</th>
                                    <th>Статус заказа</th>
                                    <th>Оплачен</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->customer_phone }}</td>
                                        <td>{{ $order->payment_method_name }}</td>
                                        <td>{{ $order->statusName }}</td>
                                        @if($order->is_paid)
                                            <td>Оплачен</td>
                                        @else
                                            <td>Не оплачен</td>
                                        @endif

                                        <td class="text-right">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-xs">Информация</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
