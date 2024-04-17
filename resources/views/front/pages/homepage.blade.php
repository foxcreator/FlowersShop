@extends('front.layouts.app')
@section('content')
    @php
        $banners = \App\Models\Banner::all();
    @endphp
    <section class="banner">
        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($banners as $index => $banner)
                <div class="carousel-item position-relative {{ $index === 0 ? ' active' : '' }}" data-bs-interval="8000">
                    <div class="position-relative">
                        <div class="overlay"></div>
                        <img src="{{ $banner->imageUrl }}" alt="">
                    </div>
                    <div class="banner__text">
                        <h1 class="text-uppercase">С{{ $banner->title_ua }}</h1>
                        <a href="{{ url($banner->link) }}" class="banner__btn">
                            {{ $banner->btn_text_ua }}
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var bannerImage = document.getElementById('banner-image');
            var bannerHeading = document.getElementById('banner-heading');
            var bannerBtn = document.getElementById('banner-btn');
            var bannerSocial = document.getElementById('banner-social');

            var banners = @json($banners);
            var currentIndex = 0;

            function updateBanner() {
                var currentBanner = banners[currentIndex];

                // Обновляем изображение, текст заголовка, текст кнопки
                bannerImage.src = currentBanner.image;
                bannerHeading.textContent = currentBanner.text;
                bannerBtn.textContent = currentBanner.buttonText;

                // Очищаем содержимое bannerSocial и добавляем новые ссылки
                bannerSocial.innerHTML = '';
                currentBanner.socialLinks.forEach(function (link) {
                    var a = document.createElement('a');
                    a.href = link.href;
                    var img = document.createElement('img');
                    img.src = link.icon;
                    img.alt = link.alt;
                    a.appendChild(img);
                    bannerSocial.appendChild(a);
                });

                currentIndex++;
                if (currentIndex >= banners.length) {
                    currentIndex = 0;
                }
            }

            setInterval(updateBanner, 5000);
            updateBanner();
        });
    </script>

@endsection
