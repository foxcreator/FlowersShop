document.addEventListener('DOMContentLoaded', function () {


var dropdownToggles = document.querySelectorAll('.custom-header__dropdown-toggle');
var dropdowns = document.querySelectorAll('.custom-header__dropdown');

// Функция для закрытия всех дропдаунов
function closeAllDropdowns() {
    dropdowns.forEach(function (dropdown) {
        dropdown.classList.remove('open');
    });

}

dropdownToggles.forEach(function (toggle) {
    toggle.addEventListener('click', function (event) {
        event.preventDefault(); // Предотвращаем переход по ссылке
        var dropdown = this.parentNode; // Родительский элемент с классом .dropdown
        dropdown.classList.toggle('open'); // Добавляем или удаляем класс .open для показа/скрытия дропдауна
        event.stopPropagation(); // Остановить всплытие события, чтобы клик на кнопке не вызывал закрытие всех дропдаунов
    });
});

document.addEventListener('click', function (event) {
    closeAllDropdowns();
});
})
