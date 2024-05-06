<nav>
    <ul class="custom-breadcrumb">
        <li class="custom-breadcrumb__item"><a href="{{ route('home') }}">{{ __('homepage.home') }}</a></li>
        <li>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="#D0D1D0" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </li>
        <li class="custom-breadcrumb__item active" aria-current="page">{{ $pageName }}</li>
    </ul>
</nav>
