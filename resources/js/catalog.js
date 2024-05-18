$(document).ready(function () {
    $('.accordion-item > .accordion-header').click(function () {
        var item = $(this).parent();
        item.toggleClass('active');

        $('.accordion-item > .accordion-header').not(this).each(function () {
            $(this).parent().removeClass('active');
        });
    });

    const slider = document.getElementById('slider');

    slider.noUiSlider.on('update', function (values, handle) {
        $('#minPrice').text(parseInt(values[0]));
        $('#maxPrice').text(parseInt(values[1]));
    });

    slider.noUiSlider.on('change', function (values, handle) {
        const categoryId = getSelectedCategory('category');
        const flowerId = getSelectedCategory('flower');
        const subjectId = getSelectedCategory('subject');
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        fetchProducts(categoryId, minPriceValue, maxPriceValue, flowerId, subjectId);
    });

    const mobileSlider = document.getElementById('mobileSlider');

    mobileSlider.noUiSlider.on('update', function (values, handle) {
        $('#mobileMinPrice').text(parseInt(values[0]));
        $('#mobileMaxPrice').text(parseInt(values[1]));
    });

    mobileSlider.noUiSlider.on('change', function (values, handle) {
        const categoryId = getSelectedCategory('category');
        const flowerId = getSelectedCategory('flower');
        const subjectId = getSelectedCategory('subject');
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        fetchProducts(categoryId, minPriceValue, maxPriceValue, flowerId, subjectId);
    });

    $('input[name="category"]').change(function () {
        const categoryId = $(this).val();
        const flowerId = getSelectedCategory('flower');
        const subjectId = getSelectedCategory('subject');
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        fetchProducts(categoryId, minPriceValue, maxPriceValue, flowerId, subjectId);
    });

    $('input[name="flower"]').change(function () {
        const flowerId = $(this).val();
        const categoryId = getSelectedCategory('category');
        const subjectId = getSelectedCategory('subject');
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        fetchProducts(categoryId, minPriceValue, maxPriceValue, flowerId, subjectId);
    });

    $('input[name="subject"]').change(function () {
        const categoryId = getSelectedCategory('category');
        const flowerId = getSelectedCategory('flower');
        const subjectId = $(this).val();
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        fetchProducts(categoryId, minPriceValue, maxPriceValue, flowerId, subjectId);
    });

    $(document).on('click', '.custom-pagination__page-link', function(event) {
        event.preventDefault();
        const page = $(this).text();
        const categoryId = getSelectedCategory('category');
        const flowerId = getSelectedCategory('flower');
        const subjectId = getSelectedCategory('subject');
        const minPrice = $('#minPrice').text();
        const maxPrice = $('#maxPrice').text();
        fetchProducts(categoryId, minPrice, maxPrice, flowerId, subjectId, page);
    });


    $('.filter-mobile-btn').click(function () {
        $('#mobile-filter').toggle();
    });
});

function fetchProducts(categoryId, minPrice, maxPrice, flowerId, subjectId, page = 1) {
    $('#loader').show();
    $('.overflow').show();
    $('body').toggleClass('fix');

    let url = `/catalog?page=${page}&category=${categoryId}&flower=${flowerId}&subject=${subjectId}`;

    if (minPrice && maxPrice) {
        url += `&min-price=${minPrice}&max-price=${maxPrice}`;
    }

    $.ajax({
        url: url,
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(data) {
            updateProductList(JSON.parse(data));
            $('#loader').hide();
            $('.overflow').hide();
            $('body').removeClass('fix');
        },
        error: function(error) {
            console.error(error);
        }
    });
}

function updateProductList(data) {
    $('.first-block').html(data.html.first);
    $('.second-block').html(data.html.second);
    $('.catalog__paginate').html(data.html.paginate);
}

function getSelectedCategory(filter) {
    const selectedFilter = $(`input[name="${filter}"]:checked`);
    return selectedFilter.length ? selectedFilter.val() : '';
}
