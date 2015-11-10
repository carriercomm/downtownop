<?php

// TT Functions
require_once('tt-lib/tt-functions.php');

//staging restrictions
if (file_exists(sys_get_temp_dir().'/staging-restrictions.php')) {
	define('STAGING_RESTRICTIONS', true);
	require_once sys_get_temp_dir().'/staging-restrictions.php';
}


include( get_template_directory() .'/constants.php' );
include( get_template_directory() .'/classes.php' );
include( get_template_directory() .'/widgets.php' );

add_theme_support( 'automatic-feed-links' );

if ( ! isset( $content_width ) ) $content_width = 900;

//remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');

add_action( 'after_setup_theme', 'theme_localization' );
function theme_localization () {
	load_theme_textdomain( 'base', get_template_directory() . '/languages' );
}


if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'id' => 'default-sidebar',
		'name' => __('Default Sidebar', 'base'),
		'before_widget' => '<div class=" %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'id' => 'social-bar-sidebar',
		'name' => __('Social Bar Sidebar', 'base'),
		'before_widget' => '<div class="social-bar %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
	add_image_size( 'page_thumbnail', 981, 452, true );
	add_image_size( 'news_post_thumbnail', 264, 67, true );
	add_image_size( 'events_post_thumbnail', 264, 144, true );
}

register_nav_menus( array(
	'top_nav' => __( 'Header Top Navigation', 'base' ),
) );
register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'base' ),
) );


//add [email]...[/email] shortcode
function shortcode_email($atts, $content) {
	$result = '';
	for ($i=0; $i<strlen($content); $i++) {
		$result .= '&#'.ord($content{$i}).';';
	}
	return $result;
}
add_shortcode('email', 'shortcode_email');

// register tag [template-url]
function filter_template_url($text) {
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}
add_filter('the_content', 'filter_template_url');
add_filter('get_the_content', 'filter_template_url');
add_filter('widget_text', 'filter_template_url');

// register tag [site-url]
function filter_site_url($text) {
	return str_replace('[site-url]',get_bloginfo('url'), $text);
}
add_filter('the_content', 'filter_site_url');
add_filter('get_the_content', 'filter_site_url');
add_filter('widget_text', 'filter_site_url');


/* Replace Standart WP Menu Classes */
function change_menu_classes($css_classes) {
        $css_classes = str_replace("current-menu-item", "active", $css_classes);
        $css_classes = str_replace("current-menu-parent", "active", $css_classes);
        return $css_classes;
}
add_filter('nav_menu_css_class', 'change_menu_classes');


//allow tags in category description
$filters = array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description');
foreach ( $filters as $filter ) {
    remove_filter($filter, 'wp_filter_kses');
}


//Make WP Admin Menu HTML Valid
function wp_admin_bar_valid_search_menu( $wp_admin_bar ) {
	if ( is_admin() )
		return;

	$form  = '<form action="' . esc_url( home_url( '/' ) ) . '" method="get" id="adminbarsearch"><div>';
	$form .= '<input class="adminbar-input" name="s" id="adminbar-search" tabindex="10" type="text" value="" maxlength="150" />';
	$form .= '<input type="submit" class="adminbar-button" value="' . __('Search', 'base') . '"/>';
	$form .= '</div></form>';

	$wp_admin_bar->add_menu( array(
		'parent' => 'top-secondary',
		'id'     => 'search',
		'title'  => $form,
		'meta'   => array(
			'class'    => 'admin-bar-search',
			'tabindex' => -1,
		)
	) );
}
function fix_admin_menu_search() {
	remove_action( 'admin_bar_menu', 'wp_admin_bar_search_menu', 4 );
	add_action( 'admin_bar_menu', 'wp_admin_bar_valid_search_menu', 4 );
}
add_action( 'add_admin_bar_menus', 'fix_admin_menu_search' );

function remove_category_list_rel( $output ) {
    // Remove rel attribute from the category list
    return str_replace( ' rel="category"', '', $output ); 
}
 
add_filter( 'wp_list_categories', 'remove_category_list_rel' );
add_filter( 'the_category', 'remove_category_list_rel' );

// loopbuddy
add_theme_support('loop-standard');
//
if ( ! function_exists( 'dynamic_loop' ) ) {
	function dynamic_loop() {
		global $dynamic_loop_handlers;
		if ( empty( $dynamic_loop_handlers ) || ! is_array( $dynamic_loop_handlers ) )
			return false;
		ksort( $dynamic_loop_handlers );
		foreach ( (array) $dynamic_loop_handlers as $handlers ) {
			foreach ( (array) $handlers as $function ) {
				if ( is_callable( $function ) && ( false != call_user_func( $function ) ) ) {
					return true;
				}
			}
		}
		return false;
	}
}
if ( ! function_exists( 'register_dynamic_loop_handler' ) ) {
	function register_dynamic_loop_handler( $function, $priority = 10 ) {
		global $dynamic_loop_handlers;
		if ( ! is_numeric( $priority ) )
			$priority = 10;
		if ( ! isset( $dynamic_loop_handlers ) || ! is_array( $dynamic_loop_handlers ) )
			$dynamic_loop_handlers = array();
		if ( ! isset( $dynamic_loop_handlers[$priority] ) || ! is_array( $dynamic_loop_handlers[$priority] ) )
			$dynamic_loop_handlers[$priority] = array();
		$dynamic_loop_handlers[$priority][] = $function;
	}
}
function bgmpShortcodeCalled()
{
    global $post;
    
    $shortcodePageSlugs = array(
        'business-directory',
        '83rd-street-liquor-2'
    );
    
    if( $post )
        if( in_array( $post->post_name, $shortcodePageSlugs ) )
            add_filter( 'bgmp_map-shortcode-called', '__return_true' );
}
add_action( 'wp', 'bgmpShortcodeCalled' );
// 2020 Custom image sizes
add_image_size( 'business-photo', 560, 560, true );
add_image_size( 'home-news', 330, 330, true );
add_image_size( 'list-img', 50, 50, true );
// 2020 Excerpt Length
function custom_excerpt_length( $length ) {
	return 88;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
////////////////////////////////////////////////////////////////////////// restrict media access for authors
//restrict authors to only being able to view media that they've uploaded
function ik_eyes_only( $wp_query ) {
	//are we looking at the Media Library or the Posts list?
	if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) !== false
	|| strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
		//user level 5 converts to Editor
		if ( !current_user_can( 'level_5' ) ) {
			//restrict the query to current user
			global $current_user;
			$wp_query->set( 'author', $current_user->id );
		}
	}
}
////////////////////////////////////////////////////////// filter media library & posts list for authors
add_filter('parse_query', 'ik_eyes_only' );

add_action('pre_get_posts','ml_restrict_media_library');

function ml_restrict_media_library( $wp_query_obj ) {
    global $current_user, $pagenow;
    if( !is_a( $current_user, 'WP_User') )
    return;
    if( 'admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments' )
    return;
    if( !current_user_can('manage_media_library') )
    $wp_query_obj->set('author', $current_user->ID );
    return;
}
///////////////////////////////////////////////////////// remove pods add shortcode button in editor
add_action( 'admin_init', 'remove_pods_shortcode_button', 14 );

function remove_pods_shortcode_button () {
    remove_action( 'media_buttons', array( PodsInit::$admin, 'media_button' ), 12 );
}
////////////////////////////////////////////////////////////// removes quick edit from custom post type list
function remove_row_actions( $actions )
{
    if( get_post_type() === 'business_directory' or 'living_directory' )
        unset( $actions['edit'] );
        unset( $actions['view'] );
        unset( $actions['trash'] );
        unset( $actions['inline hide-if-no-js'] );
    return $actions;
}
if ( is_user_logged_in() && current_user_can( 'author' ) ) {
	add_filter( 'post_row_actions', 'remove_row_actions', 10, 1 );
}
////////////////////////////////////////////////////////////// removes add new button from Business Dir
function hide_that_stuff() {
    if('business_directory' == get_post_type())
  echo '<style type="text/css">
    #favorite-actions {display:none;}
    .add-new-h2{display:none;}
    .tablenav{display:none;}
    </style>';
}
if ( is_user_logged_in() && current_user_can( 'author' ) ) {
	add_action('admin_head', 'hide_that_stuff');
}
////////////////////////////////////////////////////////////// button Shortcode
add_shortcode( 'dopp_btn', 'dopp_btn' );
function dopp_btn ( $atts, $content = null ) {

// Attributes
	extract( shortcode_atts(array(
			'name' => '',
			'link' => '',
			'bgcolor' => '#147000',
			'color' => '#ffffff',
			'icon' => '',
			'target' => '_self',
		), $atts ));
// code
return '<a class="btn" style="background-color:' . $bgcolor . ';color:' . $color . ';" href="' . $link . '" target="' . $target . '"><span class="glyphicon glyphicon-' . $icon .'"></span> ' . $content . '</a>';
}












