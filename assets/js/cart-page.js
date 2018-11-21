$(document).ready(function () {
    var totalPrice = 0;

    $(".product-tr").each(function () {
        const price = parseFloat($(this).attr('product-unit-price'));
        const amount = parseInt($(this).attr('product-amount'));
        totalPrice += price * amount;
    });

    $("body").on('click', '.cart-product-remove', function () {
        var productId = $(this).attr('product-id');
        $.post('https://wwi-webshop.fifarenderz.com/external/cart.php', {type: 'delete', productId: productId}, function (data) {
            if (!data.error) {
                const product = $(".product-tr[product-id='"+productId+"']");
                const price = parseFloat(product.attr('product-unit-price'));
                const amount = parseInt(product.attr('product-amount'));
                totalPrice -= price * amount;
                product.remove();
                $('.navbar-cart-amount').html(parseInt($(".navbar-cart-amount").html()) - 1);
                if (totalPrice <= 0) {
                    $.post('https://wwi-webshop.fifarenderz.com/external/fetch_data.php', {data: data.data}, function(data2){
                        $(".cart-table-div").html(data2);
                    });
                } else {
                    $(".td-price").html("€" + totalPrice.toFixed(2));
                }
            } else {
                alert(data.message);
            }
        }, 'json');
    }).on('click', '.save-btn', function () {
        var sendStr = "";
        var totalPriceBackup = totalPrice;
        totalPrice = 0;
        $('.product-tr').each(function () {
            var productId = $(this).attr('product-id');
            var amount = $(this).find('.cart-product-amount').val();
            $(this).attr('product-amount', amount);
            sendStr += productId + ":" + amount + ",";
            const price = parseFloat($(this).attr('product-unit-price'));
            totalPrice += amount*price;
        });
        sendStr = sendStr.replace(/,\s*$/, "");
        $.post('https://wwi-webshop.fifarenderz.com/external/cart.php', {type: 'edit', productString: sendStr}, function (data) {
            if (!data.error) {
                $('.product-tr').each(function () {
                    var amount = $(this).find('.cart-product-amount').val();
                    $(this).attr('product-amount', amount);
                    const price = parseFloat($(this).attr('product-unit-price'));
                    const addPrice = amount*price;
                    $(this).find('.cart-product-totalprice').html("€" + addPrice.toFixed(2));
                });
                $(".td-price").html("€" + totalPrice.toFixed(2));
            } else {
                alert(data.message);
                totalPrice = totalPriceBackup;
            }
        }, 'json');
    });
});