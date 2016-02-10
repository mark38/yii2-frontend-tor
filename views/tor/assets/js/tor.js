(function($) {
    $('input#torads-price').keyup(function(){
        var price = $('input#torads-price').val();
        var saleBacker = $('#sale-backer').html();
        $('#reward').html(price - (price*saleBacker)/100);
    });
})(jQuery);
