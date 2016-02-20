window.onload = function() {
    $('.bottom-ads').popover({
        container: 'body',
        html: true,
        animation: true,
        placement: 'bottom',
        content: function () {
            return $('.popover-content').html();
        }
    });
}