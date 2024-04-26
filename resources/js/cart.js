function addToCart(productId) {
    let cartCount = parseInt($('.cart-count').text());

    $('.cart-count').text(cartCount += 1);

    $.ajax({
        url: "{{ route('front.addToCart') }}",
        type: "POST",
        data: {
            id: productId,
            quantity: 1
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {

        }
    })
}
