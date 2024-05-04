@extends('front.layouts.app')
@section('content')
    <div class="container profile" style="padding-top: 150px">
        <h1>{{ __('profile.account') }}</h1>

        <div class="profile__wrapper">
            <div class="profile__tabs">
                <div class="tab active" data-tab="profile"><span>{{ __('profile.profile') }}</span></div>
                <div class="tab" data-tab="orders"><span>{{ __('profile.orders') }}</span></div>
                <div class="tab" data-tab="favorite"><span>{{ __('profile.favorite') }}</span></div>
                <div class="tab" data-tab="bonus"><span>{{ __('profile.bonus') }}</span></div>
                <div class="tab" data-tab="logout"><span>{{ __('profile.logout') }}</span></div>
            </div>
            <form action="{{ route('front.update.profile', auth()->user()->getAuthIdentifier()) }}"
                  method="POST"
                  class="profile__current-tab active"
                  id="profile"
                  autocomplete="off"
            >
                <div class="profile__inner">
                    @csrf

                    <div class="change-data">
                        <h4>{{ __('profile.my_data') }}</h4>
                        <input type="text"
                               class="default-input {{ $errors->has('full_name') ? 'is-invalid' : '' }}"
                               name="full_name"
                               placeholder="{{ __('placeholders.name') }}"
                               value="{{ old('full_name') ?: auth()->user()->full_name }}"
                               required
                        >
                        @if ($errors->has('full_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('full_name') }}</strong>
                            </span>
                        @endif

                        <input type="text"
                               class="default-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                               name="phone"
                               placeholder="{{ __('placeholders.phone') }}"
                               value="{{ old('phone') ?: auth()->user()->phone }}"
                               required
                        >
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif

                        <input type="text"
                               class="default-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               name="email"
                               placeholder="{{ __('placeholders.email') }}"
                               value="{{ old('email') ?: auth()->user()->email }}"
                               required
                               autocomplete="new-password"
                        >
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="change-password">
                        <h4>{{ __('profile.change_password') }}</h4>
                        <input type="password"
                               class="default-input {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                               name="current_password"
                               placeholder="{{ __('placeholders.current_password') }}"
                               required
                        >
                        @if ($errors->has('current_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('current_password') }}</strong>
                            </span>
                        @endif

                        <input type="password"
                               class="default-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               name="password"
                               placeholder="{{ __('placeholders.password') }}"
                               required
                        >
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <input type="password"
                               class="default-input"
                               name="password_confirmation"
                               placeholder="{{ __('placeholders.password_confirmation') }}"
                               required
                        >
                    </div>

                </div>
                <button type="submit" class="default-btn">{{ __('placeholders.save') }}</button>

            </form>
            <div class="profile__current-tab" id="orders">
                @if(auth()->user()->orders->isEmpty())
                    <h4>У вас еще не было офрмлено ни одного заказа</h4>
                    <a href="{{ route('front.catalog') }}" class="default-btn">Просмотр товаров</a>
                @else
                    <h4>Мои заказы</h4>
                    <div class="profile__order-inner">
                        @foreach(auth()->user()->orders as $order)
                            <div class="profile__order">
                                <div class="col-md-6">
                                    <p>№ {{ $order->id }} от {{ \Carbon\Carbon::create($order->created_at)->format('d.m.y') }}</p>
                                    @foreach($order->orderProducts as $item)
                                        <h5>{{ $item->product->title }}</h5>
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <p>Сумма заказа</p>
                                    <h5>₴ {{ intval($order->amount) }}</h5>
                                </div>
                                <div class="col-md-2">
                                    <p>Статус</p>
                                    <h5>{{ $order->statusNameMultiLang }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="profile__current-tab" id="favorite">
                @include('front.pages.favorites.parts.favorites', ['products' => auth()->user()->favoriteProducts()->get()])

                <a href="{{ route('front.catalog') }}" class="default-btn">Просмотр товаров</a>
            </div>
            <div class="profile__current-tab" id="bonus">
                <h4>Мои бонусы</h4>
                <div class="profile__inner">
                    <h1 class="profile__balance">₴ {{ auth()->user()->balance }}</h1>
                </div>
            </div>
            <div class="profile__current-tab" id="logout">
                <h4>Вы уверены что хотите выйти из личного кабинета?</h4>
                <a href="{{ route('logout') }}" class="default-btn logout-btn">Выйти @svg('logout')</a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.tab').click(function () {
                var currentTabId = $(this).data('tab');

                $('.profile__current-tab').hide();
                $('#' + currentTabId).fadeIn();

                $('.tab').removeClass('active');
                $(this).addClass('active');
            });
        });

    </script>
@endsection
