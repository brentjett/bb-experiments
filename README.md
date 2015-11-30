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


## Experiment 2: Fast Admin Panel
This feature adds a "Details" button to the Beaver Builder bar that toggles on a panel where you can change the title and slug of the current post, as well as navigate to other pages (NOT YET, oops!) directly into builder mode.
