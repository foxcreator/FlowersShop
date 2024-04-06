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
                                    <th>Название RU</th>
                                    <th>Ссылка</th>
                                    <th>Текст кнопки</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr>
                                        <td class="table-image">
                                            <img class="img-thumbnail" src="{{ $banner->image }}" alt="" style="width: 70px;">
                                        </td>
                                        <td>{{ $banner->title_ua }}</td>
                                        <td>{{ $banner->title_ru }}</td>
                                        <td>{{ $banner->link }}</td>
                                        <td>{{ $banner->btn_text }}</td>
                                        <td>
                                            @if($banner->is_active)
                                                Показываеться
                                            @else
                                                Не показывается
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
