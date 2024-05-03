@extends('front.layouts.app')
@section('content')
    <div class="container profile" style="padding-top: 150px">
        <h1>{{ __('profile.account') }}</h1>

        <div class="profile__wrapper">
            <div class="profile__tabs">
                <div class="tab active" data-tab="profile"><span>{{ __('profile.profile') }}</span></div>
                <div class="tab" data-tab="orders"><span>{{ __('profile.orders') }}</span></div>
                <div class="tab" data-tab="favorite"><span>{{ __('profile.favorite') }}</span></div>
                <div class="tab" data-tab="logout"><span>{{ __('profile.logout') }}</span></div>
            </div>
            <form action="{{ route('front.update.profile', auth()->user()->getAuthIdentifier()) }}" method="POST" class="profile__current-tab active" id="profile">
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
                <div class="profile__inner">
                    <h4>Мои заказы</h4>
                    @foreach(auth()->user()->orders as $order)
                        @dd($order->orderProducts)
                    @endforeach
                </div>
            </div>
            <div class="profile__current-tab" id="favorite">3</div>
            <div class="profile__current-tab" id="logout">4</div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.tab').click(function () {
                // Знаходимо ID поточного таба
                var currentTabId = $(this).data('tab');

                // Приховуємо всі поточні вкладки
                $('.profile__current-tab').hide();

                // Відображаємо поточну вкладку, пов'язану з вибраним табом
                $('#' + currentTabId).fadeIn();

                // Позначаємо вибраний таб як активний
                $('.tab').removeClass('active');
                $(this).addClass('active');
            });
        });

    </script>
@endsection
