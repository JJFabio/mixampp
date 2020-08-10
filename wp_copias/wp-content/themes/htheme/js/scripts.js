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
});