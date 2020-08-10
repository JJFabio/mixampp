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

    jQuery(window).resize();
});

jQuery(window).resize(function () {

    var w_width = jQuery(window).width();

    jQuery('.asi-table-columns').each(function () {
        var wrap = jQuery(this);
        var children = wrap.find('.asicolumn');
        if (children.length > 0) {

            var is_columns = false;
            var size = 3;

            if (w_width >= 650 && w_width <= 768) { //2 columns

                is_columns = true;
                var size = 2;

            } else if (w_width > 768) { //3 columns

                is_columns = true;
                var size = 3;
            }

            if (wrap.hasClass('asi-front-page')) {
                size = 3;
            }

            if (is_columns) {

                var arrays = [];
                while (children.length > 0)
                    arrays.push(children.splice(0, size));

                if (arrays.length > 0) {
                    var html = jQuery("<div />");
                    for (var i = 0; i < arrays.length; i++) {
                        var table = jQuery('<div class="asi-table" />');
                        var items = arrays[i];
                        for (var j = 0; j < size; j++) {
                            if (items[j]) {
                                var cell = jQuery('<div class="asi-cell" />');
                                cell.append(items[j]);
                            } else {
                                var cell = jQuery('<div class="asi-cell" />');
                            }
                            table.append(cell);
                        }
                        html.append(table);
                    }
                    if (html) {
                        wrap.html(html.html());
                    }
                }
            }
        }
    });
});