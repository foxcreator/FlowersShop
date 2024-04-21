@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Категории цветов</h1>
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
                            <a href="{{ route('admin.flowers.create') }}" class="btn btn-info btn-sm">Добавить категорию цветка</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Название UA</th>
                                    <th>Название RU</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($flowers as $flower)
                                    <tr>
                                        <td>{{ $flower->name_uk }}</td>
                                        <td>{{ $flower->name_ru }}</td>

                                        <td class="text-right d-flex justify-content-end align-content-center">
                                            <div class="mr-2">
                                                <a href="{{ route('admin.flowers.edit', $flower->id) }}" class="btn btn-info btn-xs">Редактировать</a>
                                            </div>
                                            <form action="{{ route('admin.flowers.destroy', $flower->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs">Удалить навсегда</button>
                                            </form>
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
