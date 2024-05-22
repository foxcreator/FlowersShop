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


                            {{--                                    <a href="{{ route('admin.products.index', ['sort' => 'outInStock']) }}" class="btn btn-secondary btn-sm">Нет в наличии</a>--}}
                            <div class="card-tools d-flex">
                                <div class="input-group input-group-sm mr-3">
                                    <select class="form-control"
                                            id="filter"
                                            name="filter"
                                    >
                                        <option value="all">Весь товар</option>
                                        <option value="out_in_stock">Нет в наличии</option>
                                    </select>
                                </div>

                                <div class="input-group input-group-sm mr-3">
                                    <select class="form-control"
                                            id="sort"
                                            name="sort"
                                    >
                                        <option value="title_uk:asc">По наименованию</option>
                                        <option value="price:asc">По цене (возрастание)</option>
                                        <option value="price:desc">По цене (убывание)</option>
                                        <option value="article:asc">По артиклю</option>
                                        <option value="quantity:asc">По количеству (возрастание)</option>
                                        <option value="quantity:desc">По количеству (убывание)</option>
                                    </select>
                                </div>

                                <form action="{{ route('admin.products.index') }}" class="input-group input-group-sm">
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
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        $('#sort').on('change', function () {
            fetchData();
        });
        $('#filter').on('change', function () {
            fetchData();
        });

        function fetchData() {
            var sort = $('#sort').val();
            var filter = $('#filter').val();
            console.log(sort)
            console.log(filter)

            $.ajax({
                url: '{{ route('admin.products.fetch') }}',
                type: 'GET',
                data: {sort: sort, filter: filter},
                success: function (response) {
                    // Обновляем данные на странице с помощью полученного ответа
                    $('#products-table').html(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchData(page);
        });

    </script>
@endsection
