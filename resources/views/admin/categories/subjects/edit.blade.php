@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Редактирование тематики - {{ $subject->name_uk }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST" class="col-md-6" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name_uk">Наименование UA</label>
                        <input type="text"
                               class="form-control @error('name_uk') is-invalid @enderror"
                               id="name_uk"
                               name="name_uk"
                               value="{{ old('name_uk', $subject->name_uk) }}"
                               placeholder="Введите наименование тематики на украинском"
                               required
                        >
                        @error('name_uk')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name_ru">Наименование RU</label>
                        <input type="text"
                               class="form-control @error('name_ru') is-invalid @enderror"
                               id="name_ru"
                               name="name_ru"
                               value="{{ old('name_ru', $subject->name_ru) }}"
                               placeholder="Введите наименование тематики на русском"
                        >
                        @error('name_ru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between gap-2">
                    <div class="col-md-6">
                        <a href="{{ route('admin.subjects.index') }}" class="btn btn-dark">Назад</a>
                    </div>
                    <div class="d-flex justify-content-end col-md-6 w-100">
                        <button type="submit" class="btn btn-success w-100">Сохранить</button>
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection
