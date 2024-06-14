@extends('admin.layouts.admin')
@section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 d-flex justify-content-between">
                    <div class="col-sm-6">
                        <h1 class="m-0">Продажа</h1>
                    </div>
                    <div class="col-sm-4">
                        <form action="{{ route('sales.index') }}" class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control float-right"
                                   placeholder="Поиск (По категории, артикулу или наименованию)">

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
                    @foreach($products as $product)
                        <div class="card col-4 bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                {{ $product->category?->title_uk }}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class=""><b>{{ $product->title_uk }}</b></h2>
                                    </div>
                                    <div class="col-7">
                                        <div class="description-block">
                                            <p class="text-muted text-sm text-left"><b>Артикул: </b> {{ $product->article }} </p>
                                        </div>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small">
                                                <h5>
                                                    <span class="fa-li"><i class="fas fa-warehouse text-info"></i></span>Остаток:
                                                    @if(!empty($cart) && isset($cart[$product->id]))
                                                        {{ $product->quantity - $cart[$product->id]['quantity'] }}
                                                    @else
                                                        {{ $product->quantity }} шт
                                                    @endif
                                                </h5>
                                            </li>
                                            <li class="small">
                                                <h5>
                                                    <span class="fa-li"><i class="fas fa-money-bill-alt text-success"></i></span>
                                                    {{ $product->price }}грн/шт
                                                </h5>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center m-auto">
                                        @if($product->thumbnailUrl !== '/storage/')
                                            <img src="{{ $product->thumbnailUrl }}" class="img-circle img-fluid" alt="...">
                                        @else
                                            <img src="{{ asset('assets/img/NoImage.png') }}" alt="user-avatar"
                                                 class="img-circle img-fluid">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($product->quantity > 0)
                            <div class="card-footer">
                                <form class="d-flex justify-content-between m-auto" action="{{ route('sales.cart.add', $product) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                        <input type="text" class="col-md-4" name="quantity" value="1"
                                               min="0" max="{{ $product->quantity }}">
                                        <!-- Поле для выбора количества продукта -->
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-shopping-basket"></i> Добавить в чек
                                        </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                {{ $products->links() }}
            </div>

        </section>
@endsection
