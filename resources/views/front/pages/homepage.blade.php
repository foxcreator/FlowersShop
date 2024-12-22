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
                        <div class="position-relative banner__img-block">
                            <div class="overlay"></div>
                            <img id="banner-image-{{ $index }}" src="{{ $banner->imageUrl }}" alt="{{ $banner->title }}">
                        </div>
                        <div class="banner__text container">
                            <h1 id="banner-heading-{{ $index }}"
                                class="text-uppercase user-select-none"
                                @if(!$banner->title) style="margin-top: 250px" @endif
                            >{!! $banner->title !!}</h1>

                            <div class="d-flex justify-content-between w-50 mb-5">
                            <div class="banner__social">
                                <a href="https://www.instagram.com/bright_flowers_dnipro/">@svg('instagram')</a>
                                <a href="https://www.facebook.com/profile.php?id=61560592424284">@svg('facebook')</a>
                                <a href="https://t.me/brightflowers_dnipro">@svg('telegram')</a>
                            </div>

                            <a id="banner-btn-{{ $index }}" href="{{ url($banner->link) }}" class="banner__btn">
                                <span>{{ $banner->btnText }}</span>
                                @svg('arrow-circle-right')
                            </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('front.parts.novelty')
    @include('front.parts.categories')
    @include('front.parts.quote')

@endsection
