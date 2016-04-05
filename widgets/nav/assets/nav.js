function windows_resize() {
    $('.catalog-subnav').css('width', parseInt($('.catalog-nav ul').width()+50)+'px');

    var ul = $('.catalog-nav ul');
    $('.catalog-nav ul li').each(function(){
        var li = $(this);
        var left = ul.offset().left - li.offset().left-25;
        $(li).children('.catalog-subnav').css('left', left+'px');
    });
}

jQuery(document).ready(function(){
    //$(window).load(function(){ windows_resize(); });
    $(window).on('load', function(){
        windows_resize();
    });
    $(window).resize(function(){windows_resize();});

    $('.tor-nav > ul > li').each(function() {
        $(this).on('hover', function(){
            alert(1);
        });
    });
});
