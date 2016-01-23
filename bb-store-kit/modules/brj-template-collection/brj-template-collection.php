<?php
class BRJ_TemplateCollectionModule extends FLBuilderModule {

    function __construct() {
        parent::__construct(array(
			'name'          => __('Template Collection', 'fl-builder'),
			'description'   => __('Display a collection of templates', 'fl-builder'),
			'category'      => FL_STORE_MODULE_CATEGORY,
			'dir'           => FL_STORE_PLUGIN_DIR . 'modules/brj-template-collection/',
            'url'           => FL_STORE_PLUGIN_URL . 'modules/brj-template-collection/',
		));
    }

    function get_templates() {
        /*
        $user_templates = get_posts( array(
			'post_type' 				=> 'fl-builder-template',
			'orderby' 					=> 'menu_order title',
			'order' 					=> 'ASC',
			'posts_per_page' 			=> -1,
			'fl-builder-template-type'	=> 'layout'
		));
        */

        // Temp
        $template_data = FLBuilderModel::get_templates();
        return $template_data;
    }

}
/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('BRJ_TemplateCollectionModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
		'sections'      => array(
            'general' => array(
                'title' => '',
                'fields' => array(
                    'name' => array(
                        'label' => 'Name',
                        'type' => 'text'
                    )
                )
            )
        )
    )
));
?>
