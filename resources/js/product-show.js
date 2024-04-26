$(document).ready(function() {
    $('.product-show__preview').click(function() {
        var newSrc = $(this).attr('src');
        $('.product-show__thumbnail').addClass('fade-out');
        setTimeout(function() {
            $('.product-show__thumbnail').attr('src', newSrc).removeClass('fade-out');
        }, 300);
    });

    var maxQuantity = parseInt("{{ $product->quantity }}");
    var pricePerUnit = parseInt("{{ $product->price }}");

    $('.minus-btn').click(function() {
        var currentValue = parseInt($('.quantity-field').val());
        if (currentValue > 1) {
            $('.quantity-field').val(currentValue - 1);
            $('.plus-btn').removeClass('disabled');
        }
        if ($('.quantity-field').val() === "1") {
            $(this).addClass('disabled');
        }
        updateTotalPrice();
    });

    $('.plus-btn').click(function() {
        var currentValue = parseInt($('.quantity-field').val());
        if (currentValue < maxQuantity) {
            $('.quantity-field').val(currentValue + 1);
            $('.minus-btn').removeClass('disabled');
        }
        if ($('.quantity-field').val() === maxQuantity.toString()) {
            $(this).addClass('disabled');
        }
        updateTotalPrice();
    });

    $('.quantity-field').on('input', function() {
        var currentValue = parseInt($(this).val());
        if (isNaN(currentValue) || currentValue < 1) {
            $(this).val(1);
        } else if (currentValue > maxQuantity) {
            $(this).val(maxQuantity);
        }
        if ($(this).val() === "1") {
            $('.minus-btn').addClass('disabled');
            $('.plus-btn').removeClass('disabled');
        } else if ($(this).val() === maxQuantity.toString()) {
            $('.plus-btn').addClass('disabled');
            $('.minus-btn').removeClass('disabled');
        } else {
            $('.minus-btn, .plus-btn').removeClass('disabled');
        }
        updateTotalPrice();
    });

    $('.tab').click(function() {
        var tabId = $(this).data('tab');
        $(this).addClass('active').siblings().removeClass('active');
        $('#' + tabId).addClass('active').siblings().removeClass('active');
    });

    $(document).on('click', '.custom-pagination__page-link', function(event) {
        event.preventDefault();
        var page = $(this).text();
        fetchComments(page);
    });

    function fetchComments(page = 1) {
        var url = `/product/{{$product->id}}?page=${page}`;
        $.ajax({
            url: url,
            method: 'GET',
            contentType: 'application/json',
            success: function(data) {
                updateCommentsList(data);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function updateCommentsList(data) {
        $('.all-comments').html(data.html.comments);
        $('.comments-paginate').html(data.html.paginate);
    }

    function updateTotalPrice() {
        var quantity = parseInt($('.quantity-field').val());
        $('.price').text(quantity * pricePerUnit);
    }
});
