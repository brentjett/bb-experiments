<?php
class BB_Metadata {

    function __construct() {

        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        add_action('wp_footer', array($this, 'print_footer'));
        add_action('wp_ajax_bb_metadata_update_post', array($this, 'ajax_handle_update'));
    }

    function enqueue() {
        global $post;

        wp_enqueue_script('bb-metadata', plugins_url('/bb-metadata/js/bb-metadata.js', dirname(__FILE__)), false, false, true);
        wp_enqueue_style('bb-metadata', plugins_url('/bb-metadata/css/bb-metadata.css', dirname(__FILE__)) );

        $data = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'post_id' => $post->ID
        );
        wp_localize_script('bb-metadata', 'BB_Metadata', $data);
    }

    function print_footer() {
        global $post;
        ?>
        <div class="fl-metadata-panel">
            <div class="fl-metadata-tabs">
                <i class="fl-builder-metadata-close fa fa-times"></i>
				<a data-tab="current-page" class="fl-active">Page Details</a>
				<a data-tab="pages">Pages</a>
			</div>
            <div class="fl-metadata-panel-content">
                <form data-tab="current-page" class="active" action="">
                    <div class="cell">
                        <div class="field">
                            <div class="input-wrap">
                                <input name="post_title" value="<?php echo $post->post_title ?>">
                            </div>
                            <label>Title</label>
                            <span class="indicator">Saving...</span>
                        </div>
                        <div class="field">
                            <div class="input-wrap">
                                <span class="input-prefix">../</span><input name="post_name" class="inline-input" value="<?php echo $post->post_name ?>">
                            </div>
                            <label>Slug</label>
                            <span class="indicator">Saving...</span>
                        </div>
                    </div>
                    <?php /*
                    <div class="panel-footer">
                        <input type="submit" value="submit">
                    </div>
                    */ ?>
                </form>
                <div data-tab="pages">
                    <?php
                    $types = get_post_types(array(
                        'public' => true
                    ), 'objects');
                    foreach($types as $handle => $type) {
                        $posts = get_posts(array(
                            'post_type' => $handle
                        ));
                    ?>
                    <div class="fl-builder-blocks-section">
    					<span class="fl-builder-blocks-section-title"><?php echo $type->label ?> <i class="fa fa-chevron-down"></i>
    					</span>
						<div class="fl-post-list-section-content">
                            <?php foreach($posts as $post) { ?>
								<a href="<?php echo FLBuilderModel::get_edit_url($post->ID) ?>" class="fl-post-link-block"><span><?php echo $post->post_title ?></span></a>
                            <?php } ?>
						</div>
					</div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <?php
    }

    function ajax_handle_update() {
        $post_id = $_REQUEST['update_post'];
        $prop = $_REQUEST['update_property'];
        $val = $_REQUEST['update_value'];
        $args = array(
            'ID' => $post_id
        );
        $args[$prop] = $val;
        $success = wp_update_post($args);
        if ($success) {
            $message = 'saved';
        } else {
            $message = 'nope';
        }
        print $message;
        die();
    }
}
new BB_Metadata();
?>
