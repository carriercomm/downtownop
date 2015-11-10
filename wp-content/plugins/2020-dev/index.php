<?php

/**
 *
 * Plugin Name: 2020 Client Dev
 * Plugin URI: http://2020creative.com/
 * Description: 2020 Development
 * Version: 1.0.0
 * Author: 2020 Creative, Inc.
 * Author URI: http://www.2020creative.com/
 *
*/

// 2020 Admin plugin

// remove dashboard widgets

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
//Right Now - Comments, Posts, Pages at a glance
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
//Recent Comments
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
//Incoming Links
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
//Plugins - Popular, New and Recently updated Wordpress Plugins
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
//Wordpress Development Blog Feed
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
//Other Wordpress News Feed
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
//Quick Press Form
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
//Recent Drafts List
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}
// unregister all default WP Widgets
function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    //unregister_widget('WP_Widget_Search');
    //unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    //unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    //unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

/*remove menu items
function remove_menu_items(){
    global $menu;
    $restricted = array(
        __('Links'),
        __('Comments'),
        __('Media'),
        __('Plugins'),
        __('Tools'),
        __('Users')
        );
    end ($menu);
    while (prev($menu)){
        $value = explode('', $menu[key($menu)[0]);
		if (in_array($value[0] != NULL ? $value[0]: '', $restricted));{
			unset($menu[key($menu)]);
 		}
}
}*/
add_action('admin_menu', 'remove_menu_items');
                                   
// remove sub-menu items
function remove_submenus(){
    global $submenu;
    unset($submenu['index.php'][10]); // Removes Updates
    unset($submenu['themes.php'][5]); // Removes Themes
    unset($submenu['options-general.php'][15]); // Removes Writing
    unset($submenu['options-general.php'][25]); // Removes Discussion
    unset($submenu['edit.php'][16]); // Removes Tags
}
add_action('admin_menu', 'removes_submenus');
                                   
// REMOVE META BOXES FROM DEFAULT POSTS SCREEN
function remove_default_post_screen_metaboxes() {
 remove_meta_box( 'postcustom','post','normal' ); // Custom Fields Metabox
 remove_meta_box( 'postexcerpt','post','normal' ); // Excerpt Metabox
 remove_meta_box( 'commentstatusdiv','post','normal' ); // Comments Metabox
 remove_meta_box( 'trackbacksdiv','post','normal' ); // Talkback Metabox
 remove_meta_box( 'slugdiv','post','normal' ); // Slug Metabox
 remove_meta_box( 'authordiv','post','normal' ); // Author Metabox
}
add_action('admin_menu','remove_default_post_screen_metaboxes');
// REMOVE META BOXES FROM DEFAULT PAGES SCREEN
function remove_default_page_screen_metaboxes() {
 remove_meta_box( 'postcustom','page','normal' ); // Custom Fields Metabox
 remove_meta_box( 'postexcerpt','page','normal' ); // Excerpt Metabox
 remove_meta_box( 'commentstatusdiv','page','normal' ); // Comments Metabox
 remove_meta_box( 'trackbacksdiv','page','normal' ); // Talkback Metabox
 remove_meta_box( 'slugdiv','page','normal' ); // Slug Metabox
 remove_meta_box( 'authordiv','page','normal' ); // Author Metabox
}
add_action('admin_menu','remove_default_page_screen_metaboxes');                                   
                                   
// 2020 custom footer admin
function my_custom_footer_admin () {
	echo 'Theme designed and developed by <a href="http://www.2020creative.com" target="_blank">2020 Creative, Inc.</a>';
}
add_filter('admin_footer_text', 'my_custom_footer_admin');                                   
                                   
// 2020 admin login
function tt_custom_login_css(){
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/2020-custom-login.css"/>';
}
add_action('login_head', 'tt_custom_login_css');