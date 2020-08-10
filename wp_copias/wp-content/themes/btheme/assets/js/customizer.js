jQuery(window).load(function () {

    jQuery('select[data-customize-setting-link="' + asitheme_customizer_slug + '_frontpage_featured_posts"]').select2({
        ajax: {
            url: ajaxurl,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    action: 'search'
                };
            },
            processResults: function (data) {
                var options = [];
                if (data) {
                    jQuery.each(data, function (index, text) {
                        options.push({id: text[0], text: text[1]});
                    });
                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 3
    });

    jQuery('textarea.wp-editor-area').each(function () {

        var tArea = jQuery(this);
        var id = tArea.attr('id');
        var input = jQuery('input[data-customize-setting-link="' + id + '"]');
        var editor = tinyMCE.get(id);
        var setChange;
        var content;

        if (editor) {
            editor.onChange.add(function (ed, e) {
                ed.save();
                content = editor.getContent();
                clearTimeout(setChange);
                setChange = setTimeout(function () {
                    input.val(content).trigger('change');
                }, 500);
            });
        }

        tArea.css({
            visibility: 'visible'
        }).on('keyup', function () {
            content = tArea.val();
            clearTimeout(setChange);
            setChange = setTimeout(function () {
                input.val(content).trigger('change');
            }, 500);
        });
    });

    //* Display fields by header position
    jQuery('select[data-customize-setting-link="' + asitheme_customizer_slug + '_header_position"]').change(function () {
        var id = jQuery(this).val();
        jQuery('#customize-control-' + asitheme_customizer_slug + '_header_transparency').hide();
        if (id === 'fixed') {
            jQuery('#customize-control-' + asitheme_customizer_slug + '_header_transparency').show();
        }
    });
    jQuery('select[data-customize-setting-link="' + asitheme_customizer_slug + '_header_position"]').change();

    //* Display fields by display posts
    jQuery('select[data-customize-setting-link="' + asitheme_customizer_slug + '_frontpage_display_posts"]').change(function () {
        var id = jQuery(this).val();
        jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_num_posts').hide();
        jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_featured_posts').hide();
        if (id === 'last') {
            jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_num_posts').show();
        } else if (id === 'featured') {
            jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_featured_posts').show();
        }
    });
    jQuery('select[data-customize-setting-link="' + asitheme_customizer_slug + '_frontpage_display_posts"]').change();

    //* Display image or video
    jQuery('select[data-customize-setting-link="' + asitheme_customizer_slug + '_frontpage_banner_left_show"]').change(function () {
        var id = jQuery(this).val();
        jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_banner_image').hide();
        jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_banner_image_link').hide();
        jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_banner_video').hide();
        if (id === 'image') {
            jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_banner_image').show();
            jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_banner_image_link').show();
        } else if (id === 'video') {
            jQuery('#customize-control-' + asitheme_customizer_slug + '_frontpage_banner_video').show();
        }
    });
    jQuery('select[data-customize-setting-link="' + asitheme_customizer_slug + '_frontpage_banner_left_show"]').change();

});