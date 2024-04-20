@extends('front.layouts.app')
@section('content')
    @php
        $banners = \App\Models\Banner::where('is_active', true)->get();
		$bannersArray = $banners->map(function($banner) {
			return [
				'image' => $banner->imageUrl,
				'title' => $banner->title,
				'btn_text' => $banner->btnText,
				'link' => $banner->link,
			];
		});
    @endphp
    <section class="banner">
        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($banners as $index => $banner)
                    <div class="carousel-item position-relative {{ $index === 0 ? ' active' : '' }}" data-bs-interval="7000">
                        <div class="position-relative">
                            <div class="overlay"></div>
                            <img id="banner-image-{{ $index }}" src="{{ $banner->imageUrl }}" alt="{{ $banner->title }}">
                        </div>
                        <div class="banner__text">
                            <h1 id="banner-heading-{{ $index }}" class="text-uppercase user-select-none">{{ $banner->title }}</h1>
                            <a id="banner-btn-{{ $index }}" href="{{ url($banner->link) }}" class="banner__btn">
                                <span>{{ $banner->btnText }}</span>
                                @svg('arrow-circle-right')
                            </a>
                            <div class="banner__social">
                                <a href=""><img src="{{ asset('front/icons/instagram.svg') }}" alt=""></a>
                                <a href=""><img src="{{ asset('front/icons/facebook.svg') }}" alt=""></a>
                                <a href=""><img src="{{ asset('front/icons/telegram.svg') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('front.parts.delimiter')
    @include('front.parts.novelty')
    @include('front.parts.categories')
    @include('front.parts.quote')

@endsection
