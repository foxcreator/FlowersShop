@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between w-100">
                    <h1 class="m-0">Тематики</h1>
                    <form action="{{ route('admin.subjects.index') }}" method="GET" class="form-inline w-25">
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
                            <a href="{{ route('admin.subcategories.create') }}" class="btn btn-info btn-sm">Добавить подкатегорию</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Название UA</th>
                                    <th>Название RU</th>
                                    <th>Основная категория</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory->name_uk }}</td>
                                        <td>{{ $subcategory->name_ru }}</td>
                                        <td>{{ $subcategory->category->title_ru }}</td>

                                        <td class="text-right d-flex justify-content-end align-content-center">
                                            <div class="mr-2">
                                                <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" class="btn btn-info btn-xs">Редактировать</a>
                                            </div>
                                            <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs">Удалить навсегда</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $subcategories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
