@php
$ordersCount = \App\Models\Order::where('status', 'received')->count();
$outProductCount = \App\Models\Product::where('quantity', 0)->count();
$notificationCount = $ordersCount + $outProductCount;

$productText = $outProductCount == 1 ? 'товар закончился' : ($outProductCount > 1 && $outProductCount < 5 ? 'товара закончилось' : 'товаров закончилось');
$orderText = $ordersCount == 1 ? 'новый заказ' : ($ordersCount > 1 && $ordersCount < 5 ? 'новых заказа' : 'новых заказов');

@endphp

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link" target="_blank">Магазин</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Поиск" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{ $notificationCount ?: '' }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $notificationCount }} Уведомлений</span>
                @if($outProductCount >= 1)
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.products.index', ['sort' => 'outInStock']) }}" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> {{ $outProductCount }} {{ $productText }}
                </a>
                @endif
                @if($ordersCount >= 1)
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.orders.index') }}" class="dropdown-item">
                    <i class="fas fa-file mr-3"></i> {{ $ordersCount }} {{ $orderText }}
                </a>
                @endif
                <div class="dropdown-divider"></div>
            </div>
        </li>
    </ul>
</nav>
