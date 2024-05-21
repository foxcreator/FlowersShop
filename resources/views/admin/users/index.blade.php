@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between w-100">
                    <h1 class="m-0">Пользователи</h1>
                    <form action="{{ route('admin.users.index') }}" method="GET" class="form-inline w-25">
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
                                    <th>Имя Фамилия</th>
                                    <th>Телефон</th>
                                    <th>Всего заказов</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @continue($user->id == auth()->user()->id)
                                    <tr>
                                        <td>{{ $user->name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ \App\Models\Order::query()->where('user_id', $user->id)->count() }}</td>

                                        <td class="text-right">
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary btn-xs">Информация</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <div class="mt-3 d-flex justify-content-center">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
