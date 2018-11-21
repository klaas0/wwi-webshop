$(document).ready(function () {
    $("body").on('click', '.add-to-shoppingcart', function () {
        var productId = $(this).attr('product-id');
        var amount = 1;
        if($('.product-amount').length){
            amount = $('.product-amount').val();
        }
        $.post('https://wwi-webshop.fifarenderz.com/external/cart.php', {type: 'add', productId: productId, quantity: amount}, function (data) {
            if (!data.error) {
                $('.navbar-cart-amount').html(parseInt($(".navbar-cart-amount").html()) + 1);
            }
            else{
                 alert(data.message);
            }
        }, 'json');
    });
});