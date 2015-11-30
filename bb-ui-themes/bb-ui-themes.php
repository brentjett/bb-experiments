<?php
class BB_UI_Themes {

    function __construct() {


        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        add_filter('fl_builder_register_settings_form', array($this, 'add_settings'), 10, 2);
    }

    function enqueue() {
        if (class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active()) {
            $themes = self::get_themes();
            $settings = FLBuilderModel::get_global_settings();
            $ui_theme = $settings->bb_ui_theme;
            if ($ui_theme == 'custom') {
                // setup custom style block
                add_action('wp_head', array($this, 'print_custom_css'));

            } elseif ($ui_theme != '') {
                $theme = $themes[$ui_theme];
                wp_enqueue_style('bb-ui-theme', $theme['url']);
            }
            wp_enqueue_script('bb-ui-theme', plugins_url('/bb-ui-themes/js/settings.js', dirname(__FILE__)), false, false, true);

            $bb_ui = array();
            $bb_ui['themes'] = $themes;
            $bb_ui['fields'] = self::get_color_fields();
            wp_localize_script('bb-ui-theme', 'BB_UI', $bb_ui);
        }
    }

    function add_settings($form, $id) {

        if ($id == 'global') {
            $form['tabs']['ui'] = array(
                'title' => __('User Interface', 'bb-experiments'),
                'sections' => array(
                    'general' => array(
                        'title' => '',
                        'fields' => array(
                            'bb_ui_theme' => array(
                                'type' => 'select',
                                'label' => 'Color Scheme',
                                'options' => self::get_theme_options(),
                                'toggle' => array(
                                    'custom' => array(
                                        'sections' => array('custom_colors')
                                    )
                                )
                            )
                        )
                    ),
                    'custom_colors' => array(
                        'title' => __('Customize UI Colors', 'bb-experiments'),
                        'fields' => self::get_color_fields()
                    )
                )
            );
        }
        return $form;
    }

    static function get_theme_options() {
        $options = array(
            '' => __('Default', 'bb-experiments')
        );
        $themes = self::get_themes();
        if (!empty($themes)) {
            foreach ($themes as $handle => $args) {
                $options[$handle] = $args['name'];
            }
        }
        //$options['custom'] = __('Custom', 'bb-experiments');
        return $options;
    }

    static function get_themes() {
        $themes = array(
            'dark' => array(
                'name' => __('Beaver Builder Dark', 'bb-experiments'),
                'url' => plugins_url('/bb-ui-themes/css/dark.css', dirname(__FILE__) )
            ),
            'wordpress' => array(
                'name' => __('WordPress Dark', 'bb-experiments'),
                'url' => plugins_url('/bb-ui-themes/css/wordpress.css', dirname(__FILE__) )
            )
        );
        return apply_filters('bb_experiments_get_ui_themes', $themes);
    }

    static function get_color_fields() {
        $selectors = array(
            'panel_background' => array(
                'label' => __('Panel Background', 'bb-experiments'),
                'type' => 'color',
                'show_reset'    => true,
                'properties' => array('background'),
                'selectors' => array(
                    'body .fl-builder-panel',
                    'body .fl-builder-bar-content',
                    'body .fl-lightbox',
                    'body .fl-lightbox-header',
                    'body .fl-form-table th',
                    'body .fl-builder-settings-tabs a.fl-active'
                )
            ),
            'panel_color' => array(
                'type' => 'color',
                'label' => __('Panel Text Color', 'bb-experiments'),
                'show_reset'    => true,
                'properties' => array('color'),
                'selectors' => array(
                    'body .fl-lightbox *:not(i)'
                )
            )
        );
        return $selectors;
    }

    function print_custom_css() {
        $fields = self::get_color_fields();
        $settings = FLBuilderModel::get_global_settings();
        print "<style id='bb-ui-theme-custom'>\n";
        foreach($fields as $name => $field) {
            $color = '#' . $settings->{$name};
            $properties = $field['properties'];
            $selectors = $field['selectors'];
            foreach($selectors as $selector) {
                print $selector . "{\n";
                foreach ($properties as $property) {
                    print $property . " : " . $color;
                }
                print "}\n";
            }
        }
        ?>
        body .fl-builder-blocks-section .fl-builder-blocks-section-title:hover,
        body .fl-builder-blocks-section .fl-builder-blocks-section-title:hover i {
            background:transparent;
        }
        <?php
        print "</style>\n";
    }

}
new BB_UI_Themes();
?>
