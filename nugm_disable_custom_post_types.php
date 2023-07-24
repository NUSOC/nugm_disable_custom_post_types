<?php
/**
 * Plugin Name:     NUGM Disable Custom Post Types
 * Plugin URI:      
 * Description:     Disableds NUGM Cusom Post types if not needed
 * Author:          NuSOC
 * Author URI:      NUSOC
 * Text Domain:     soc
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         SoC
 */

// Your code starts here.
add_action('init', function () {

	$options = get_option('nugm_disable_custom_post_types_settings');


	if ($options['nugm_disable_custom_post_types_checkbox_nu_gm_directory_item']) {
		unregister_post_type('nu_gm_directory_item');
	};

	// if ($options['nugm_disable_custom_post_types_checkbox_nu_gm_news']) {
	if ( isset( $options['nugm_disable_custom_post_types_checkbox_nu_gm_news'] ) && $options['nugm_disable_custom_post_types_checkbox_nu_gm_news'] ) {
		unregister_post_type('nu_gm_news');
	};

	if ($options['nugm_disable_custom_post_types_checkbox_nu_gm_event']) {
		unregister_post_type('nu_gm_event');
	};

	// TODO: catch this error which WARNS in php 8.x
	if (isset($options['nugm_disable_custom_post_types_checkbox_nu_gm_project'])) {
		if ($options['nugm_disable_custom_post_types_checkbox_nu_gm_project']) {
			unregister_post_type('nu_gm_project');
		};
	}
}, 10000);

add_action('admin_menu', 'nugm_disable_custom_post_types_add_admin_menu');
add_action('admin_init', 'nugm_disable_custom_post_types_settings_init');

function nugm_disable_custom_post_types_add_admin_menu()
{

    add_options_page('NUGM Disable Custom Post Types', 'NUGM Disable Custom Post Types', 'manage_options', 'nugm_disable_custom_post_types', 'nugm_disable_custom_post_types_options_page');

}

function nugm_disable_custom_post_types_settings_init()
{

    register_setting('nugm_disable_custom_post_typesPage', 'nugm_disable_custom_post_types_settings');

    add_settings_section(
        'nugm_disable_custom_post_types_nugm_disable_custom_post_typesPage_section',
        __('Disable Custom Post Types', 'soc'), 
        'nugm_disable_custom_post_types_settings_section_callback',
        'nugm_disable_custom_post_typesPage'
    );

	// nu_gm_news
    add_settings_field(
        'nugm_disable_custom_post_types_checkbox_nu_gm_news',
        __('Disable GM News', 'soc'),
        'nugm_disable_custom_post_types_checkbox_nu_gm_news_render',
        'nugm_disable_custom_post_typesPage',
        'nugm_disable_custom_post_types_nugm_disable_custom_post_typesPage_section'
    );

	// nu_gm_project
    add_settings_field(
        'nugm_disable_custom_post_types_checkbox_nu_gm_project',
        __('Disable GM Project', 'soc'),
        'nugm_disable_custom_post_types_checkbox_nu_gm_project_render',
        'nugm_disable_custom_post_typesPage',
        'nugm_disable_custom_post_types_nugm_disable_custom_post_typesPage_section'
    );

	// nu_gm_directory_item
    add_settings_field(
        'nugm_disable_custom_post_types_checkbox_nu_gm_directory_item',
        __('Disable GM Directory', 'soc'),
        'nugm_disable_custom_post_types_checkbox_nu_gm_directory_item_render',
        'nugm_disable_custom_post_typesPage',
        'nugm_disable_custom_post_types_nugm_disable_custom_post_typesPage_section'
    );

	// nu_gm_event
    add_settings_field(
        'nugm_disable_custom_post_types_checkbox_nu_gm_event',
        __('Disable GM Event', 'soc'),
        'nugm_disable_custom_post_types_checkbox_nu_gm_event_render',
        'nugm_disable_custom_post_typesPage',
        'nugm_disable_custom_post_types_nugm_disable_custom_post_typesPage_section'
    );

}

function nugm_disable_custom_post_types_checkbox_nu_gm_news_render()
{

    $options = get_option('nugm_disable_custom_post_types_settings');
    ?>
	<input type='checkbox' name='nugm_disable_custom_post_types_settings[nugm_disable_custom_post_types_checkbox_nu_gm_news]' <?php checked($options['nugm_disable_custom_post_types_checkbox_nu_gm_news'], 1);?> value='1'>
	<?php

}

function nugm_disable_custom_post_types_checkbox_nu_gm_project_render()
{

    $options = get_option('nugm_disable_custom_post_types_settings');
    ?>
	<input type='checkbox' name='nugm_disable_custom_post_types_settings[nugm_disable_custom_post_types_checkbox_nu_gm_project]' <?php checked($options['nugm_disable_custom_post_types_checkbox_nu_gm_project'], 1);?> value='1'>
	<?php

}

function nugm_disable_custom_post_types_checkbox_nu_gm_directory_item_render()
{

    $options = get_option('nugm_disable_custom_post_types_settings');
    ?>
	<input type='checkbox' name='nugm_disable_custom_post_types_settings[nugm_disable_custom_post_types_checkbox_nu_gm_directory_item]' <?php checked($options['nugm_disable_custom_post_types_checkbox_nu_gm_directory_item'], 1);?> value='1'>
	<?php

}

function nugm_disable_custom_post_types_checkbox_nu_gm_event_render()
{

    $options = get_option('nugm_disable_custom_post_types_settings');
    ?>
	<input type='checkbox' name='nugm_disable_custom_post_types_settings[nugm_disable_custom_post_types_checkbox_nu_gm_event]' <?php checked($options['nugm_disable_custom_post_types_checkbox_nu_gm_event'], 1);?> value='1'>
	<?php

}

function nugm_disable_custom_post_types_settings_section_callback()
{

   // echo __('Unchecked boxes will unregisters custom post types. ', 'soc');

}

function nugm_disable_custom_post_types_options_page()
{

    ?>
	<form action='options.php' method='post'>

		<h2>nugm_disable_custom_post_types</h2>

		<?php
settings_fields('nugm_disable_custom_post_typesPage');
    do_settings_sections('nugm_disable_custom_post_typesPage');
    submit_button();
    ?>

	</form>
	<?php

}
