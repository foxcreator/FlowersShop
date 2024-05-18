<div class="cart-nav container">
    <a href="{{ route('front.catalog') }}" class="cart-nav__btn-back">
        @svg('arrow-back')
        <span>{{ __('cart.continue_buying') }}</span>
    </a>
    <div class="cart-nav__logo">
        @svg('logo-min')
    </div>
    <div class="cart-nav__contacts">
        <a href="tel:0637875888" class="number">+38 (063) 787 5888</a>
        <p class="worktime">{{ __('cart.work_time') }}</p>
    </div>
</div>
