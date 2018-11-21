$(document).ready(function () {
    $("body").on('click', '#reviewSubmit', function () {
    
        var reviewTitle = $("#reviewTitle").val();
        var reviewRating = $("#reviewRating").val();
        var reviewMessage = $("#reviewMessage").val();
        var productID = $("#reviewItemID").val();

        $.post('https://wwi-webshop.fifarenderz.com/external/review.php', {type: 'add', reviewTitle: reviewTitle, reviewRating: reviewRating, reviewDescription: reviewMessage, reviewItemID: productID}, function (data) {
            if (!data.error) {
                console.log("nee rip");
            }
            else{
                console.log("ja rip");
                 alert(data.message);
            }
        }, 'json');
    });
});