<div class="cart-nav container">
    <a href="{{ route('front.catalog') }}" class="cart-nav__btn-back">
        @svg('arrow-back')
        <span>{{ __('cart.continue_buying') }}</span>
    </a>
    <div class="cart-nav__logo">
        <img src="{{ asset('front/images/logo.png') }}" alt="">
    </div>
    <div class="cart-nav__contacts">
        <a href="tel:0679776075" class="number">+38 067 977 60 75</a>
        <a href="tel:0732163409" class="number">+38 073 216 34 09</a>
        <p class="worktime">пн-пт 8:30 – 20:00 <br>
            сб-нд 9:00 – 20:00</p>
    </div>
</div>
