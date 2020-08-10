jQuery(document).ready(function () {

    jQuery("#menu-btn").click(function (e) {
        e.preventDefault();
        jQuery(".site-header").toggleClass('open');
        jQuery("body").toggleClass('noscroll');
    });

    var obj = jQuery('#slider-post');
    if (obj.find('.swiper-slide').length > 1) {
        new Swiper(obj.find('.swiper-container'), {
            navigation: {
                nextEl: obj.find('.swiper-button-next'),
                prevEl: obj.find('.swiper-button-prev')
            },
            pagination: {
                el: obj.find('.swiper-pagination'),
                clickable: true
            }
        });
    }

    jQuery('body:not(.woocommerce-page) table').each(function (i, e) {
        var headers = [];

        if (jQuery(this).find('tr:nth-child(1) th').length > 0) {
            jQuery(this).find('tr:nth-child(1) th').each(function () {
                var text = jQuery(this).text();
                if (jQuery(this).attr('colspan')) {
                    for (var j = 0; j < jQuery(this).attr('colspan'); j++) {
                        headers.push(text + ':');
                    }
                } else {
                    headers.push(text + ':');
                }
            });
        }
        if (headers.length > 0) {
            jQuery(this).find('tr').each(function (i, e) {
                var colCount = 0;
                jQuery(this).find('td').each(function (i) {
                    jQuery(this).attr('data-title', headers[colCount]);
                    if (jQuery(this).attr('colspan')) {
                        for (var j = 0; j < jQuery(this).attr('colspan'); j++) {
                            colCount++;
                        }
                    } else {
                        colCount++;
                    }
                });
            });
        }
    });

    jQuery("article.front-page .featured").each(function () {
        var buttons = jQuery(this).find('.button-primary');
        buttons.css('min-width', '0');
        var wbutton_max_w = [];
        buttons.each(function () {
            wbutton_max_w.push(jQuery(this).outerWidth());
        });
        var max = Math.max.apply(null, wbutton_max_w);
        if (max) {
            buttons.each(function () {
                jQuery(this).css('min-width', max);
            });
        }
    });

    jQuery(window).resize();

});

jQuery(window).scroll(function () {

    var scroll = jQuery(window).scrollTop();
    if (scroll > 0) {
        jQuery(".site-header").addClass("scroll");
    } else {
        jQuery(".site-header").removeClass("scroll");
    }

});

jQuery(window).resize(function () {
    var h = jQuery('.site-header.fixed').outerHeight();
    if (h > 0) {
        var extra = 0;
        if (jQuery(".page-template-front-page").length === 0) {
            extra = 40;
        }
        jQuery('.site-inner.fixed').css('padding-top', (h + extra) + 'px');
    }
});