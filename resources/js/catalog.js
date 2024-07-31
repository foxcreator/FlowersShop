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
        const subcategoryId = getSelectedCategory('subcategory');
        const selectedFlowers = $('input[name="flowers[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        const subjectId = getSelectedCategory('subject');
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        fetchProducts(categoryId, minPriceValue, maxPriceValue, selectedFlowers, subjectId, subcategoryId);
    });

    $('input[name="category"]').change(function () {
        $('.subcategories').hide()

        const categoryId = $(this).val();
        const selectedFlowers = $('input[name="flowers[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        const subjectId = getSelectedCategory('subject');
        const subcategoryId = 'all';
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        $('#subcategories_'+categoryId).show()

        fetchProducts(categoryId, minPriceValue, maxPriceValue, selectedFlowers, subjectId, subcategoryId);
    });

    $('input[name="subcategory"]').change(function () {
        const subcategoryId = $(this).val();
        const selectedFlowers = $('input[name="flowers[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        const categoryId = getSelectedCategory('category');
        const subjectId = getSelectedCategory('subject');
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        fetchProducts(categoryId, minPriceValue, maxPriceValue, selectedFlowers, subjectId, subcategoryId);
    });

    $('input[name="flowers[]"]').change(function () {
        const selectedFlowers = $('input[name="flowers[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        const categoryId = getSelectedCategory('category');
        const subjectId = getSelectedCategory('subject');
        const subcategoryId = getSelectedCategory('subcategory');
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        fetchProducts(categoryId, minPriceValue, maxPriceValue, selectedFlowers, subjectId, subcategoryId);
    });

    $('input[name="subject"]').change(function () {
        const categoryId = getSelectedCategory('category');
        const subcategoryId = getSelectedCategory('subcategory');
        const selectedFlowers = $('input[name="flowers[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        const subjectId = $(this).val();
        const minPriceValue = $('#minPrice').text();
        const maxPriceValue = $('#maxPrice').text();

        fetchProducts(categoryId, minPriceValue, maxPriceValue, selectedFlowers, subjectId, subcategoryId);
    });

    $(document).on('click', '.custom-pagination__page-link', function(event) {
        event.preventDefault();
        const page = $(this).text();
        const categoryId = getSelectedCategory('category');
        const selectedFlowers = $('input[name="flowers[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        const subcategoryId = getSelectedCategory('subcategory');
        const subjectId = getSelectedCategory('subject');
        const minPrice = $('#minPrice').text();
        const maxPrice = $('#maxPrice').text();
        fetchProducts(categoryId, minPrice, maxPrice, selectedFlowers, subjectId, subcategoryId, page);
    });



});

$('.filter-mobile-btn').click(function () {
    $('#desktop-filter').toggle();
});

function fetchProducts(categoryId, minPrice, maxPrice, flowerIds, subjectId, subcategoryId, page = 1) {
    $('#loader').show();
    $('.overflow').show();
    $('body').toggleClass('fix');
    $('#mobile-filter').hide();

    let url = `/catalog?page=${page}&category=${categoryId}&subject=${subjectId}&subcategory=${subcategoryId}`;

    if (minPrice && maxPrice) {
        url += `&min-price=${minPrice}&max-price=${maxPrice}`;
    }

    if (flowerIds.length > 0) {
        url += `&flowers=${flowerIds.join(',')}`;
    }
    console.log(123)
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
    $('.category-header').html(data.html.header);
}

function getSelectedCategory(filter) {
    const selectedFilter = $(`input[name="${filter}"]:checked`);
    return selectedFilter.length ? selectedFilter.val() : '';
}
