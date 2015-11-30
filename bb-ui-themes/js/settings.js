(function($){

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
            $('#bb-ui-theme-custom').prop('media', 'screen');
        } else if (theme != undefined) {
            // Set stylesheet url
            var css_url = theme.url;
            stylesheet.attr('href', css_url);
            stylesheet.prop('disabled', false);
            $('#bb-ui-theme-custom').prop('media', 'none');
            reset_custom_ui_styles();
        } else {
            // Reset to default styling
            $('#bb-ui-theme-custom').prop('media', 'none');
            reset_custom_ui_styles();
            stylesheet.prop('disabled', true);
        }
    });

    $('body').on('change', '.fl-builder-global-settings input.fl-color-picker-value', function() {

        var input = $(this);
        var name = input.attr('name');
        var color = input.val();
        var selectors = BB_UI.fields[name].selectors;
        var properties = BB_UI.fields[name].properties;
        console.log(selectors, properties);

        if (color != "") {

            $.each(properties, function(i, property)  {
                console.log("set", property, selectors);
                $.each(selectors, function(i, selector) {
                    $(selector).css(property, '#' + color).addClass('custom-ui-theme-' + property);
                });
            });

        } else {
            // clear the color
            console.log('clear css properties');
            $('.custom-ui-theme-' + property).css(property, "");
        }

    });

    function reset_custom_ui_styles() {
        console.log('reset custom styles');
        $('custom-ui-theme-color').css('color', '');
        $('custom-ui-theme-background').css('background', '');
        $('custom-ui-theme-background-color').css('background-color', '');
        $('custom-ui-theme-border-color').css('border-color', '');
    }

})(jQuery);
