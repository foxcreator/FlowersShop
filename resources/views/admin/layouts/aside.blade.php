<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.users.show', auth()->user()->getAuthIdentifier()) }}" class="d-block">
                    {{ auth()->user()->full_name }}
                </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Заказы</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Товары</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.banners.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Постеры</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Категории
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p> Основные категории</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.flowers.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p> Категории цветов</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.subjects.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p> Тематики</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Пользователи</p>
                    </a>
                </li>

                <li class="nav-header">Аккаунт</li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.show', auth()->user()->id) }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Настройки</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p class="text text-danger">Выйти</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
