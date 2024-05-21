$(document).ready(function() {
    $('.tab').on('click', function() {
        var tabId = $(this).data('tab');
        $('.tab-content').removeClass('show-tab');
        $('#' + tabId).addClass('show-tab');
        $('.tab').removeClass('current-tab');
        $(this).addClass('current-tab');
    });

    $('#comment-text').click(function() {

        var input = $('<input>').attr({
            type: 'text',
            name: 'comment',
            class: 'default-input'
        });

        $(this).replaceWith(input);

        input.focus();
    });
});

$(document).ready(function() {
    $('.delivery-block').hide();
    $('.add-products').hide();
    $('.pay-block').hide();
    $('.delivery-success').hide();
    $('.gifts-success').hide();

    $('.submit-user').on('click', function() {
        var phone = $('[name="customer_phone"]').val();
        var name = $('[name="customer_name"]').val();
        var email = $('[name="email"]').val();

        if (phone && name && email) {
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
        $('.delivery-header').hide();
        $('.delivery-address').text(deliveryAddress);

    });

    $('.submit-gifts').on('click', function() {
        var postcard = $('[name="text_postcard"]').val();

        $('.add-products').hide();
        $('.gifts-success').show();
        $('.pay-block').show();
        $('.pay-success').hide();
        $('.gifts-header').hide();
        $('.text-postcard').text(postcard);

    });

    $('.edit-btn').on('click', function() {
        $('.user-data').show();
        $('.user-success').hide();
        $('.order__tabs').show();
        $('.delivery-block').hide();
        $('.add-products').hide();
        $('.pay-block').hide();
    });

    $('.edit-btn-delivery').on('click', function() {
        $('.delivery-block').show();
        $('.user-data').hide();
        $('.delivery-success').hide();
        $('.add-products').hide();
        $('.gifts-success').show();
        $('.pay-block').hide();
    });

    $('.edit-btn-gifts').on('click', function() {
        $('.delivery-block').hide();
        $('.user-data').hide();
        $('.delivery-success').hide();
        $('.add-products').show();
        $('.gifts-success').hide();
        $('.pay-block').hide();
    });

    $('#delivery').on('click', function () {
        $('#delivery-content').show();
        $('#self-delivery').removeClass('current-tab');
        $('#delivery').addClass('current-tab');

        // Перевірка наявності прихованого поля і видалення його
        if ($('#delivery_option').length > 0) {
            $('#delivery_option').remove();
        }
    });

    $('#self-delivery').on('click', function () {
        $('#delivery-content').hide();
        $('#self-delivery').addClass('current-tab');
        $('#delivery').removeClass('current-tab');

        // Перевірка наявності прихованого поля і видалення його
        if ($('#delivery_option').length > 0) {
            $('#delivery_option').remove();
        }

        // Створення та додавання нового прихованого поля для варіанту доставки "Самовивіз"
        var hiddenInput = $('<input>').attr({
            type: 'hidden',
            id: 'delivery_option',
            name: 'delivery_option',
            value: 'self' // Значення для варіанту "Самовивіз"
        });

        $('#delivery-content').append(hiddenInput);
    });

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

