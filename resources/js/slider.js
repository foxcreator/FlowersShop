import noUiSlider from 'nouislider';

const slider = document.getElementById('slider');
const mobileSlider = document.getElementById('mobileSlider');

noUiSlider.create(slider, {
    start: [0, 50000],
    step: 100,
    connect: true,
    range: {
        'min': 0,
        'max': 50000
    }
});

noUiSlider.create(mobileSlider, {
    start: [0, 50000],
    step: 100,
    connect: true,
    range: {
        'min': 0,
        'max': 50000
    }
});

const minPriceDisplay = document.getElementById('minPrice');
const maxPriceDisplay = document.getElementById('maxPrice');

// Обновляем отображаемые значения при изменении положения ползунков
slider.noUiSlider.on('update', function (values, handle) {
    if (handle === 0) {
        minPriceDisplay.textContent = parseInt(values[handle]);
    } else {
        maxPriceDisplay.textContent = parseInt(values[handle]);
    }
});

const minPriceMobile = document.getElementById('mobileMinPrice');
const maxPriceMobile = document.getElementById('mobileMaxPrice');

// Обновляем отображаемые значения при изменении положения ползунков
slider.noUiSlider.on('update', function (values, handle) {
    if (handle === 0) {
        minPriceMobile.textContent = parseInt(values[handle]);
    } else {
        maxPriceMobile.textContent = parseInt(values[handle]);
    }
});
