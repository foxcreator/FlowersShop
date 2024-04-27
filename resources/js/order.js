$(document).ready(function() {
    $('.tab').on('click', function() {
        var tabId = $(this).data('tab');
        $('.tab-content').removeClass('show-tab');
        $('#' + tabId).addClass('show-tab');
        $('.tab').removeClass('current-tab');
        $(this).addClass('current-tab');
    });
});

$(document).ready(function() {
    $('.delivery-block').hide();
    $('.add-products').hide();
    $('.pay-block').hide();

    $('.submit-user').on('click', function() {
        var phone = $('[name="customer_phone"]').val();
        var name = $('[name="customer_name"]').val();
        console.log(name, phone)
        // Валидация формы
        if (phone && name) {
            $('.order__order-form-group').hide();
            $('.user-success').show();
            $('.delivery-success').hide();
            $('.order__tabs').hide();
            $('.delivery-block').show();
            $('.customer-name').text(name);
            $('.customer-phone').text(phone);
        } else {
            alert('Пожалуйста, заполните все поля');
        }
    });

    $('.submit-delivery').on('click', function() {
        var city = $('[name="city"]').val();
        var street = $('[name="street"]').val();
        var house = $('[name="house"]').val();
        var flat = $('[name="flat"]').val();
        var deliveryAddress = 'Самовывоз';

        if (city && street && house && flat) {
            deliveryAddress = city + ', ' + street + ', ' + house + ', ' + flat;
        }

        $('.delivery-block').hide();
        $('.delivery-success').show();
        $('.add-products').show();
        $('.gifts-success').hide();
        $('.delivery-address').text(deliveryAddress);

    });

    $('.submit-gifts').on('click', function() {
        var postcard = $('[name="text_postcard"]').val();

        $('.add-products').hide();
        $('.gifts-success').show();
        $('.pay-block').show();
        $('.pay-success').hide();
        $('.text-postcard').text(postcard);

    });

    $('.edit-btn').on('click', function() {
        $('.order__order-form-group').show();
        $('.user-success').hide();
        $('.order__tabs').show();
        $('.delivery-block').hide();
    });

    $('.edit-btn-delivery').on('click', function() {
        $('.delivery-block').show();
        $('.delivery-success').hide();
        $('.add-products').hide();
        $('.gifts-success').show();
    });

    $('#delivery').on('click', function () {
        $('#delivery-content').show()
        $('#self-delivery').removeClass('current-tab');
        $('#delivery').addClass('current-tab');
    })

    $('#self-delivery').on('click', function () {
        $('#delivery-content').hide()
        $('#self-delivery').addClass('current-tab');
        $('#delivery').removeClass('current-tab');
    })

    $('#recipient').on('click', function () {
        $('.recipient').show()
        $('#customer').removeClass('current-tab');
        $('#recipient').addClass('current-tab');
    })

    $('#customer').on('click', function () {
        $('.recipient').hide()
        $('#customer').addClass('current-tab');
        $('#recipient').removeClass('current-tab');
    })
});

