@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Товары</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-info btn-sm">Добавить товар</a>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Изображение</th>
                                    <th>Артикул</th>
                                    <th>Название UA</th>
                                    <th>Название RU</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="table-image">
                                            <img class="img-thumbnail" src="{{ $product->thumbnailUrl }}" alt="">
                                        </td>
                                        <td>{{ $product->article }}</td>
                                        <td>{{ $product->title_ua }}</td>
                                        <td>{{ $product->title_ru }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>

                                        <td class="text-right">
                                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-secondary btn-xs">Информация</a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info btn-xs">Редактировать</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
