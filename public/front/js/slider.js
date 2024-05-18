const mobileSlider = document.getElementById('mobileSlider');
const slider = document.getElementById('slider');

noUiSlider.create(slider, {
    start: [0, 5000],
    step: 20,
    connect: true,
    range: {
        'min': 0,
        'max': 5000
    }
});

noUiSlider.create(mobileSlider, {
    start: [0, 5000],
    step: 20,
    connect: true,
    range: {
        'min': 0,
        'max': 5000
    }
});

