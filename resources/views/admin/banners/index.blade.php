@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Постеры</h1>
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
                            <a href="{{ route('admin.banners.create') }}" class="btn btn-info btn-sm">Добавить постер</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Изображение</th>
                                    <th>Название UA</th>
                                    <th>Ссылка</th>
                                    <th class="text-center">Отображаеться</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr>
                                        <td class="table-image">
                                            <img class="img-thumbnail" src="{{ $banner->imageUrl }}" alt="" style="width: 120px;">
                                        </td>
                                        <td class="custom-text-overflow">{{ $banner->title_ua }}</td>
                                        <td>
                                            <a target="_blank" class="list-link" href="
                                            @if($banner->product_id)
                                                {{ route('admin.products.show', $banner->product_id) }}
                                            @else
                                                {{ $banner->link }}
                                            @endif"
                                            >
                                                Перейти
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            @if($banner->is_active)
                                                <i class="fas fa-check-square text-success"></i>
                                            @else
                                                <i class="fas fa-window-close text-danger"></i>
                                            @endif
                                        </td>

                                        <td class="text-right">
                                            <a href="{{ route('admin.banners.show', $banner->id) }}" class="btn btn-secondary btn-xs">Информация</a>
                                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-info btn-xs">Редактировать</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
