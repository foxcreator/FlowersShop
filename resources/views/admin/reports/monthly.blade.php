@extends('admin.layouts.admin')
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-header">Отчет с {{ $from }} по {{ $to }}</div>
                    <div class="card-body">
                        <form class="row justify-content-center mt-3" action="{{ route('admin.reports.monthly') }}"
                              method="GET">
                            @csrf
                            <div class="col-auto">
                                <input type="date" class="form-control"
                                       data-target="#reservationdate"
                                       id="from" name="from" value="{{ \Carbon\Carbon::create($from)->format('Y-m-d') }}"
                                       max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control"
                                       data-target="#reservationdate"
                                       id="to" name="to" value="{{ \Carbon\Carbon::create($to)->format('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-dark mb-3">Выбрать период</button>
                            </div>
                        </form>
                        <table class="table table-hover text-nowrap">
                            <tr>

                                <th scope="col">Продаж за период</th>
                                <th scope="col">Доход</th>
                            </tr>
                            <tr>
                                <td class="align-top" rowspan="{{ count($combinedProducts) }}"><h2
                                        class="text-primary">{{ $totalSales }} грн</h2></td>
                                <td rowspan="{{ count($combinedProducts) }}"><h2
                                        class="text-success">{{ $totalSales - $totalOptSales }} грн</h2></td>
                            </tr>
                        </table>
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th scope="col" class="text-left">Наименование</th>
                                <th scope="col">Текущая цена (розница)</th>
                                <th scope="col">Текущая оптовая цена</th>
                                <th scope="col">Продано(шт)</th>
                                <th scope="col">Остаток(шт)</th>
                                <th scope="col">Сумма продаж</th>
                                <th scope="col">Валовая прибыль</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($combinedProducts as $product)
                                <tr>
                                    <td class="text-left">{{ $product->product->title_ru }}</td>
                                    <td>{{ $product->product->price }} грн</td>
                                    <td>{{ $product->product->opt_price }} грн</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->product->quantity }}</td>
                                    <td>{{ $product->total_sales_price }} грн</td>
                                    <td>{{ $product->total_sales_price - $product->total_opt_price }} грн</td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        <a href="{{ route('admin.reports.download') }}" class="btn btn-info mt-5">Скачать отчет в CSV</a>
                    </div>
                </div>
            </div>
        </div>
@endsection


