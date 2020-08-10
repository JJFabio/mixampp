jQuery(window).load(function () {

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
});