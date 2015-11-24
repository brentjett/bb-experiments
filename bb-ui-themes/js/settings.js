(function($){

	//var form = $('.fl-builder-global-settings');
    //var theme = form.find('select[name=bb_ui_theme]');

    $('body').on('change', '.fl-builder-global-settings select[name=bb_ui_theme]', function() {
        var themes = BB_UI.themes;
        var handle = $(this).val();
        var theme = themes[handle];
        var stylesheet = $('#bb-ui-theme-css');
        if (!stylesheet.length) {
            var stylesheet = $('head').append('<link rel="stylesheet" id="bb-ui-theme-css" href="" type="text/css" media="all">');
        }
        if (handle == 'custom') {
            // handle custom colors
            stylesheet.prop('disabled', true);
            var form = $('.fl-builder-global-settings');
            var panel_color = form.find('input[name=panel_color]');
            console.log('handle custom colors');
        } else if (theme != undefined) {
            var css_url = theme.url;
            console.log(stylesheet);
            stylesheet.attr('href', css_url);
            stylesheet.prop('disabled', false);
            console.log('set theme to', handle, css_url);
        } else {
            console.log('reset to default styling');
            stylesheet.prop('disabled', true);
        }
    });

    $('body').on('mousedown', '.fl-builder-global-settings input[name=panel_background]', function() {
        $('.fl-lightbox-mask').css('opacity', 0);
        /*
        var form = $('.fl-builder-global-settings');
        var theme_selector = form.find('select[name=bb_ui_theme]').val();
        if (theme_selector == 'custom') {
            $('.fl-lightbox-mask').css('opacity', 0);

        }
        */
    });
    $('body').on('mouseup', '.fl-builder-global-settings input[name=panel_background]', function() {
        $('.fl-lightbox-mask').css('opacity', 1);
    });


})(jQuery);
