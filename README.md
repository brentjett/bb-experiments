# Beaver Builder Experiments

This is a set of experiments and ideas to extend Beaver Builder. This code is free to use but is experimental and not supported in any way. Please do not use this plugin on a production site.

## Experiment 1: UI Color Schemes
This plugin adds "User Interface" tab to the Global Settings panel in page builder (Tools > Edit Global Settings). This new tab allows you to select from alternate color schemes for the Beaver Builder UI.

Additional UI themes can be added with a filter:
```php
<?php
function demo_add_color_themes($themes) {
    $themes['my_colors'] = array(
        'name' => __('My Color Scheme', 'bb-experiments'),
        'url' => '/path/to/your/stylesheet.css'
    )
    return $themes;
}
add_filter('bb_experiments_get_ui_themes', 'demo_add_color_themes');
?>
```

Upcoming Feature:
* Select "Custom" and create your own color settings for beaver builder's UI.

## Experiment 2: Minimap
This is a concept for a small control to let you see your layout at a glance, navigate to various rows and rearrange them. Reorder coming soon.

## Experiment 3: Tutorials Base Plugin
This is a base plugin to create tutorial pages. It defines a custom post type and allows you to create a set of tutorial posts on activation.

## Experiment 4: Store Kit
This is a stub for some modules to allow someone to create a template store site.
