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
                            <a href="{{ route('admin.products.create') }}" class="btn btn-info btn-sm">Добавить
                                товар</a>

                            <div class="card-tools d-flex col-6">
                                <form id="filter-sort-form" method="GET" action="{{ route('admin.products.index') }}" class="d-flex col-6">
                                    <div class="input-group input-group-sm col-6">
                                        <select class="form-control" id="filter" name="filter" onchange="this.form.submit()">
                                            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Весь товар</option>
                                            <option value="out_in_stock" {{ request('filter') == 'out_in_stock' ? 'selected' : '' }}>Нет в наличии</option>
                                            <option value="flower" {{ request('filter') == 'flower' ? 'selected' : '' }}>Цветы</option>
                                        </select>
                                    </div>

                                    <div class="input-group input-group-sm col-6">
                                        <select class="form-control" id="sort" name="sort" onchange="this.form.submit()">
                                            <option value="title_uk:asc" {{ request('sort') == 'title_uk:asc' ? 'selected' : '' }}>По наименованию</option>
                                            <option value="price:asc" {{ request('sort') == 'price:asc' ? 'selected' : '' }}>По цене (возрастание)</option>
                                            <option value="price:desc" {{ request('sort') == 'price:desc' ? 'selected' : '' }}>По цене (убывание)</option>
                                            <option value="article:asc" {{ request('sort') == 'article:asc' ? 'selected' : '' }}>По артиклю (возрастание)</option>
                                            <option value="article:desc" {{ request('sort') == 'article:desc' ? 'selected' : '' }}>По артиклю (убывание)</option>
                                            <option value="quantity:asc" {{ request('sort') == 'quantity:asc' ? 'selected' : '' }}>По количеству (возрастание)</option>
                                            <option value="quantity:desc" {{ request('sort') == 'quantity:desc' ? 'selected' : '' }}>По количеству (убывание)</option>
                                        </select>
                                    </div>
                                </form>


                                <form action="{{ route('admin.products.index') }}" class="input-group input-group-sm col-6">
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

                        <div id="products-table" class="card-body table-responsive p-0">
                            @include('admin.products.blocks.table')
                        </div>

                        <div class="mt-3 d-flex justify-content-center">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
