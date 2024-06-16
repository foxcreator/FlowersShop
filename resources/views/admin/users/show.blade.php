@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $user->name }} {{ $user->last_name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Основная информация</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row justify-content-between">
                                        <div class="col-md-3 d-flex flex-column">
                                            @if($user->id !== auth()->user()->id)
                                                <form action="{{ route('admin.users.change-role') }}" method="POST">
                                                    @csrf
                                                    <label for="role">Роль пользователя</label>
                                                    <select class="form-control custom-select" name="role" id="role">
                                                        @foreach(\App\Models\User::ROLES as $key => $role)
                                                            <option value="{{ $key }}" @if($key == $user->role) selected @endif>{{ $role }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" value="{{ $user->id }}" name="id">
                                                    <button type="submit" class="btn btn-success btn-sm w-100 mt-3">Изменить роль</button>
                                                </form>
                                            @endif

                                            @if($user->id === auth()->user()->id)
                                                <form action="{{ route('admin.users.update.password') }}" method="POST">
                                                    @csrf
                                                    <h3>Изменение пароля</h3>
                                                    <div class="form-group">
                                                        <label for="old_password">Старый пароль</label>
                                                        <input type="password"
                                                               class="form-control @error('old_password') is-invalid @enderror"
                                                               name="old_password"
                                                               id="old_password"
                                                               placeholder="Введите текущий пароль"
                                                               value="{{ old('old_password') }}"
                                                               required
                                                        >

                                                        @error('old_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Новый пароль</label>
                                                        <input type="password"
                                                               class="form-control @error('password') is-invalid @enderror"
                                                               name="password"
                                                               id="password"
                                                               placeholder="Введите новый пароль"
                                                               value="{{ old('password') }}"
                                                               required
                                                        >

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_confirmed">Подтверждение пароля</label>
                                                        <input type="password"
                                                               class="form-control"
                                                               name="password_confirmation"
                                                               id="password_confirmed"
                                                               placeholder="Подтвердите пароль"
                                                               required
                                                        >
                                                    </div>
                                                    <input type="hidden" value="{{ $user->id }}" name="id">

                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        Изменить пароль
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="post col-md-8" style="border: none">
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Email</p>
                                                <h5 class="text-gray-dark">{{ $user->email }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Имя</p>
                                                <h5 class="text-gray-dark">{{ $user->name }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Фамилия</p>
                                                <h5 class="text-gray-dark">{{ $user->last_name }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Телефон</p>
                                                <h5 class="text-gray-dark">{{ $user->phone }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Дата регистрации</p>
                                                <h5 class="text-gray-dark">{{ \Carbon\Carbon::make($user->created_at)->format('d-m-Y') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

