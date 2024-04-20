<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Lotus</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
@include('front.layouts.nav')

@yield('content')
<footer class="footer">
    <div class="container">
        <div class="footer__logo">
            @svg('lotus-logo')
        </div>
        <div class="footer__info">
            <div class="footer__about">
                <h3>Про компанию</h3>
                <ul>
                    <li><a href="#">Про нас</a></li>
                    <li><a href="#">Услуги</a></li>
                    <li><a href="#">Контакты</a></li>
                    <li><a href="#">Обратная связь</a></li>
                    <li><a href="#">Политика конфеденциальности</a></li>
                </ul>
            </div>
            <div class="footer__catalog">
                <h3>Каталог</h3>
                <ul>
                    <li><a href="#">Свадебные букеты</a></li>
                    <li><a href="#">Троянды</a></li>
                    <li><a href="#">Цветы в горшках</a></li>
                    <li><a href="#">Эксклюзивные букеты</a></li>
                    <li><a href="#">Подарки</a></li>
                </ul>
            </div>
            <div class="footer__contacts">
                <h3>Контакты</h3>
                <ul>
                    <li>+38 (063) 787 5888</li>
                    <li>+38 (098) 220 0673</li>
                    <li>+38 (063) 787 5888</li>
                    <li>м. Київ, вул. Глибочицька 40г</li>
                    <li>відчинено з 09:00 до 20:00 щодня</li>
                </ul>
            </div>
        </div>

        <div class="footer__social">
            <a href="#">@svg('instagram')</a>
            <a href="#">@svg('facebook')</a>
            <a href="#">@svg('telegram')</a>
        </div>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownToggles = document.querySelectorAll('.custom-header__dropdown-toggle');
        var dropdowns = document.querySelectorAll('.custom-header__dropdown');

        // Функция для закрытия всех дропдаунов
        function closeAllDropdowns() {
            dropdowns.forEach(function(dropdown) {
                dropdown.classList.remove('open');
            });

        }

        dropdownToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(event) {
                event.preventDefault();
                var dropdown = this.parentNode;
                dropdown.classList.toggle('open');
                event.stopPropagation();
            });
        });

        document.addEventListener('click', function(event) {
            closeAllDropdowns();
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        var dropdownToggle = document.querySelector('.search-toggle');
        var dropdown = document.querySelector('.search');
        var close = document.querySelector('.close-icon');

        dropdownToggle.addEventListener('click', function (event) {
            event.preventDefault(); // Предотвращаем переход по ссылке
            dropdown.classList.toggle('open');
            document.body.classList.toggle('fix');
            event.stopPropagation(); // Остановить всплытие события, чтобы клик на кнопке не вызывал закрытие всех дропдаунов
        });

        // Обработчик события click на документе для закрытия всех дропдаунов при клике в любом месте страницы
        close.addEventListener('click', function (event) {
            dropdown.classList.remove('open');
            document.body.classList.remove('fix');
        });
    });
</script>
</body>
</html>
