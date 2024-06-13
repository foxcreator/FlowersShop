@extends('admin.layouts.admin')
@section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 d-flex justify-content-between">
                    <div class="col-sm-6">
                        <h1 class="m-0">Обзор</h1>
                    </div>
                    <div class="col-sm-4">
                        <form action="{{ route('sales.index') }}" class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control float-right"
                                   placeholder="Поиск">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-2">
                        <img src="{{ asset('dist/img/boxed-bg.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Букет Красные глазки</h5>
                            <p class="card-text">Цена: <span class="text-success">100</span> грн</p>
                            <a href="#" class="btn btn-primary">В чек</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
@endsection
