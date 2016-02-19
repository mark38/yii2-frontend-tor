window.onload = function() {
    $('.bottom-ads').popover({
        html: true,
        animation: true,
        placement: 'bottom',
        content: function () {
            return $(this).next('.popper-content').html();
        }
    });
}