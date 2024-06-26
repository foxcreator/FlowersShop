@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between w-100">
                    <h1 class="m-0">Категории</h1>
                    <form action="{{ route('admin.categories.index') }}" method="GET" class="form-inline w-25">
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
                        <div class="card-header">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-info btn-sm">Добавить категорию</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Изображение</th>
                                    <th>Название UA</th>
                                    <th>Название RU</th>
                                    <th class="text-center">На главной</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="table-image">
                                            <img class="img-thumbnail" src="{{ $category->thumbnailUrl }}" alt="" style="width: 70px;">
                                        </td>
                                        <td>{{ $category->title_uk }}</td>
                                        <td>{{ $category->title_ru }}</td>
                                        <td class="text-center">
                                            @if($category->is_show_on_homepage)
                                                <i class="fas fa-check-square text-success"></i>
                                            @else
                                                <i class="fas fa-window-close text-danger"></i>
                                            @endif
                                        </td>

                                        <td class="text-right">
                                            <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-secondary btn-xs">Информация</a>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-info btn-xs">Редактировать</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
