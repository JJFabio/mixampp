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

    var page = 2;
    var loading = false;

    jQuery('body').on('click', '.load-more', function () {

        if (!loading) {

            loading = true;
            jQuery(this).remove();
            jQuery('.ajax-loader').css('display', 'table');
            var data = {
                action: 'be_ajax_load_more',
                nonce: beloadmore.nonce,
                page: page,
                query: beloadmore.query
            };
            jQuery.post(beloadmore.url, data, function (res) {
                if (res.success) {
                    page = page + 1;
                    loading = false;
                    jQuery('.ajax-loader').remove();
                    jQuery('.post-listing').append(res.data);
                }
            });
        }
    });

});