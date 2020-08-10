jQuery(document).ready(function () {

    jQuery("#menu-btn").click(function (e) {
        e.preventDefault();
        jQuery(".site-header").toggleClass('open');
        jQuery("body").toggleClass('noscroll');
    });

    jQuery('.nav-primary').find('.menu-primary').each(function () {
        if (jQuery(this).children().length > 3) {
            jQuery(this).addClass('columns');
        }
    });

    jQuery("table").each(function (i, e) {
        jQuery(this).find("thead th").each(function (i, e) {
            var text = jQuery(this).text();
            jQuery(this).parents("table").find("td:nth-of-type(" + (i + 1) + ")").attr('data-content', text);
        });
    });

});

jQuery(window).scroll(function () {

    var scroll = jQuery(window).scrollTop();
    if (scroll > 0) {
        jQuery(".site-header").addClass("scroll");
    } else {
        jQuery(".site-header").removeClass("scroll");
    }

});