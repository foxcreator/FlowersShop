@extends('front.layouts.app')
@section('content')
    <div class="container profile">
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
                <div class="profile__inner row">
                    @csrf

                    <div class="change-data col-md-9 col-lg-6">
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

                    <div class="change-password col-md-9 col-lg-5">
                        <h4>{{ __('profile.change_password') }}</h4>
                        <input type="password"
                               class="default-input {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                               name="current_password"
                               placeholder="{{ __('placeholders.current_password') }}"
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
                        >
                    </div>

                </div>
                <button type="submit" class="default-btn align-self-start col-12 col-md-9 col-lg-6">{{ __('placeholders.save') }}</button>

            </form>
            <div class="profile__current-tab" id="orders">
                @if(auth()->user()->orders->isEmpty())
                    <h4>{{ __('profile.not_order_history') }}</h4>
                    <a href="{{ route('front.catalog') }}" class="default-btn">{{ __('profile.show_products') }}</a>
                @else
                    <h4>{{ __('profile.my_orders') }}</h4>
                    <div class="profile__order-inner">
                        @foreach(auth()->user()->orders()->orderByDesc('id', 'DESC')->limit(10)->get() as $order)
                            <div class="profile__order">
                                <div class="col-md-6">
                                    <p>№ {{ $order->id }} от {{ \Carbon\Carbon::create($order->created_at)->format('d.m.y') }}</p>
                                    @foreach($order->orderProducts as $item)
                                        <h5>{{ $item->product->title }}</h5>
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <p>{{ __('profile.order_amount') }}</p>
                                    <h5>₴ {{ intval($order->amount) }}</h5>
                                </div>
                                <div class="col-md-2">
                                    <p>{{ __('profile.status') }}</p>
                                    <h5>{{ $order->statusNameMultiLang }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="profile__current-tab" id="favorite">
                @include('front.pages.favorites.parts.favorites', ['products' => auth()->user()->favoriteProducts()->get()])

                <a href="{{ route('front.catalog') }}" class="default-btn col-md-6">{{ __('profile.show_products') }}</a>
            </div>
            <div class="profile__current-tab" id="bonus">
                <h4>{{ __('profile.my_bonuses') }}</h4>
                <div class="profile__inner">
                    <h1 class="profile__balance">₴ {{ auth()->user()->balance }}</h1>
                </div>
            </div>
            <div class="profile__current-tab" id="logout">
                <h4>{{ __('profile.exit_from_your_account') }}</h4>
                <a href="{{ route('logout') }}" class="default-btn logout-btn col-md-6">{{ __('profile.logout') }} @svg('logout')</a>
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
