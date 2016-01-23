
<h2 class="template-collection-title"><?php echo $settings->name ?></h2>
<div class="template-collection-content">
<?php
$templates = $module->get_templates();
if (!empty($templates)) {
    foreach($templates as $template) {
        if ($template->index == 0) continue;

        $image_url = FL_BUILDER_URL . 'img/templates/' . $template->image;
        ?>
        <div class="template-item">
            <div class="template-thumbnail">
                <div class="template-thumbnail-inside">
                    <img src="<?php echo $image_url ?>">
                </div>
            </div>
            <div class="template-title"><?php echo $template->name ?></div>
        </div>
        <?php
    }
}
?>
</div>
