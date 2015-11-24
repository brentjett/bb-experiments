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
            if ($ui_theme != '') {
                $theme = $themes[$ui_theme];
                wp_enqueue_style('bb-ui-theme', $theme['url']);
            }
            wp_enqueue_script('bb-ui-theme', plugins_url('/bb-ui-themes/js/settings.js', dirname(__FILE__)), false, false, true);

            $bb_ui = array();
            $bb_ui['themes'] = $themes;
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
                'preview' => array(
                    'type' => 'css',
                    'property' => 'background',
                    'selector' => array('.fl-builder-panel')
                    /*'.fl-builder-panel, .fl-builder-bar-content, .fl-lightbox, fl-lightbox-header'*/
                )
            ),
            'panel_color' => array(
                'type' => 'color',
                'label' => __('Panel Text Color', 'bb-experiments'),
                'show_reset'    => true,
                'preview' => array(
                    'type' => 'css',
                    'property' => 'color',
                    'selector' => array('.fl-builder-panel')
                    /*'.fl-builder-panel, .fl-builder-bar-content, .fl-lightbox, fl-lightbox-header'*/
                )
            )
        );
        return $selectors;
    }

}
new BB_UI_Themes();
?>
