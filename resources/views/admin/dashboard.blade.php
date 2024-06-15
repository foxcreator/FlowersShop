@extends('admin.layouts.admin')
@section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Обзор</h1>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ \App\Models\Order::count() }}</h3>
                                <p>Всего заказов</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Детальнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    {{ \App\Models\Order::whereDate(
                                        'created_at',
                                        \Illuminate\Support\Carbon::today()
                                    )->count() }}
                                </h3>
                                <p>Заказов за сегодня</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Детальнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    {{ \App\Models\User::count() }}
                                </h3>

                                <p>Регистраций пользователей</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="small-box-footer">Детальнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ \App\Models\Order::whereNotIn('status', ['executed'])->count() }}</h3>
                                <p>Заказов в обработке</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Детальнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-gradient-green">
                            <div class="inner">
                                <h3>
                                    {{ $todayProfit }} грн
                                </h3>
                                <p>Прибыль за сегодня</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.reports.daily') }}" class="small-box-footer">Детальнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-gradient-info">
                            <div class="inner">
                                <h3>
                                    {{ $todayCash }} грн
                                </h3>
                                <p>Касса за сегодня</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.reports.daily') }}" class="small-box-footer">Детальнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-gradient-blue">
                            <div class="inner">
                                <h3>
                                    {{ $bouquetsSale }} шт
                                </h3>
                                <p>Продано букетов</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Детальнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-indigo">
                            <div class="inner">
                                <h3>
                                    {{ $flowersSale }} шт
                                </h3>
                                <p>Продано цветов</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Детальнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
@endsection
