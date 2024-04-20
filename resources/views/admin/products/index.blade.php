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
                            <a href="{{ route('admin.products.create') }}" class="btn btn-info btn-sm">Добавить товар</a>


                            {{--                                    <a href="{{ route('admin.products.index', ['sort' => 'outInStock']) }}" class="btn btn-secondary btn-sm">Нет в наличии</a>--}}
                            <div class="card-tools d-flex">
                                <div class="input-group input-group-sm mr-3">
                                    <select class="form-control"
                                            id="sort"
                                            name="sort"
                                    >
                                        <option value="all">Весь товар</option>
                                        <option value="out_in_stock">Нет в наличии</option>
                                    </select>
                                </div>

                                <div class="input-group input-group-sm mr-3">
                                    <select class="form-control"
                                            id="count_on_page"
                                            name="count_on_page"
                                    >
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div id="products-table" class="card-body table-responsive p-0">
                            @include('admin.products.blocks.table')
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        $('#sort').on('change', function() {
            fetchData();
        });

        // Событие изменения селектора для количества на странице
        $('#count_on_page').on('change', function() {
            fetchData();
        });

        function fetchData() {
            var sort = $('#sort').val();
            var countOnPage = $('#count_on_page').val();

            // Отправляем AJAX запрос на сервер
                $.ajax({
                    url: '{{ route('admin.products.fetch') }}',
                    type: 'GET',
                    data: { sort: sort, count: countOnPage },
                    success: function(response) {
                        // Обновляем данные на странице с помощью полученного ответа
                        $('#products-table').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
    </script>
@endsection
