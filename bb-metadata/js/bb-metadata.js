(function($){

    var button = '<span class="fl-builder-metadata-button fl-builder-button">Details</span>';
    $('.fl-builder-add-content-button').before(button);

    $('.fl-builder-bar-actions .fl-builder-button, .fl-module').on('click', function() {
        if (!$(this).hasClass('fl-builder-metadata-button')) {
            $('.fl-metadata-panel').removeClass('active');
        }
    });

    $('.fl-builder-metadata-button').on('click', function() {
        $('.fl-metadata-panel').toggleClass('active');
        FLBuilder._closePanel();
    });

    $('.fl-builder-add-content-button').on('click', function() {
        $('.fl-metadata-panel').removeClass('active');
    });

    $('.fl-builder-metadata-close').on('click', function() {
        $('.fl-metadata-panel').removeClass('active');
    });

    $('.fl-metadata-tabs a').on('click', function() {
        $('.fl-metadata-tabs a.fl-active').removeClass('fl-active');
        $(this).addClass('fl-active');
        var tab = $(this).data('tab');
        console.log("set tab to", tab);
        $('.fl-metadata-panel-content .active').removeClass('active');
        $('.fl-metadata-panel-content [data-tab="' + tab + '"]').addClass('active');
    });

    $('input[name=post_title], input[name=post_name]').on('change', function() {
        BB_Metadata.last_indicator = $(this).closest('.field').find('.indicator');
        BB_Metadata.last_indicator.css('display', 'inline-block');
        var val = $(this).val();
        var name = $(this).attr('name');
        $.post(
            BB_Metadata.ajaxurl,
            {
                action: "bb_metadata_update_post",
                update_post: BB_Metadata.post_id,
                update_property: name,
                update_value: val
            },
            on_update_success
        );
    });

    function on_update_success(data) {
        BB_Metadata.last_indicator.text('saved!');
        console.log(data);
    }

})(jQuery);
