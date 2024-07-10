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
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('sales.cart') }}" class="nav-link">
                Открытый чек
                <i class="fas fa-receipt"></i>
                @if(session()->get('cart', []))
                    <span class="badge badge-warning navbar-badge">{{ count(session()->get('cart')) }}</span>
                @endif
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li>
            <a href="{{ route('sales.close.shift') }}" class="nav-link">Закрыть смену</a>
        </li>
        @if(auth()->user()->isAdmin())
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
                        <a href="{{ route('admin.products.index', ['filter' => 'out_in_stock']) }}"
                           class="dropdown-item">
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
        @endif
    </ul>
</nav>
