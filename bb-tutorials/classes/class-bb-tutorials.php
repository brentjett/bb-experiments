<?php
class BB_Tutorials {

    static function init() {
        $handle = 'bb-tutorial';
        $labels = array(
    		'name' => __('Tutorials', 'bb-tutorials'),
    		'singular_name' => __('Tutorial', 'bb-tutorials'),
            'add_new_item' => __('Add New Tutorial', 'bb-tutorials'),
    	);
        $args = array(
    		'label' => __('Tutorial', 'bb-tutorials'),
            'labels' => $labels,
    		'hierarchical' => false,
    		'public' => true,
    		'show_ui' => true,
    		'menu_icon' => 'dashicons-art',
    		'show_in_admin_bar' => false,
    		'show_in_nav_menus' => true,
    		'can_export' => true,
    		'has_archive' => true,
    		'exclude_from_search' => true,
    		'publicly_queryable' => true,
            'supports' => array('title', 'revisions'),
            'rewrite' => array(
                'with_front' => false,
                'slug'       => 'tutorials'
            ),
            'menu_position' => 100
    	);
        register_post_type($handle, $args);

        // Enable Beaver Builder for Workspace Post Type
        $types = get_option('_fl_builder_post_types');
        if (!in_array($handle, $types)) {
            $types[] = $handle;
            update_option('_fl_builder_post_types', $types);
        }
    }

    static function activate() {
        self::init();
        flush_rewrite_rules();

        self::populate_posts();
    }

    static function enqueue() {
        global $post;
        if ($post->post_type == 'bb-tutorial') {
            wp_enqueue_style('bb-tutorials', plugins_url('/css/tutorials.css', dirname(__FILE__)), array('open-sans'));
        }
    }

    static function get_template($template) {
        global $post;
        if ($post->post_type == 'bb-tutorial') {
            $template = BB_TUTORIALS_DIR . 'includes/single-tutorial.php';
        }
        return $template;
    }

    static function populate_posts() {
        $tutorials = array(
            array(
                'post_title' => 'Intro To Text Modules',
                'post_status' => 'publish',
                'post_type' => 'bb-tutorial',
                'layout_data' => 'text-intro.dat'
            )
        );
        foreach($tutorials as $post) {
            if ($id = wp_insert_post($post)) {
                $data = file_get_contents(BB_TUTORIALS_DIR . '/data/' . $post['layout_data']);
                $layout = unserialize($data);
                update_post_meta($id, '_fl_builder_enabled', 1);
                update_post_meta($id, '_fl_builder_draft', $layout);
                update_post_meta($id, '_fl_builder_data', $layout);
            }
        }
    }
}
?>
