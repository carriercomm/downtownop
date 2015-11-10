<?php
/**
 *
 * Plugin Name: 2020 Client Admin
 * Plugin URI: http://2020creative.com/
 * Description: 2020 Admin Plugin
 * Version: 1.0.0
 * Author: 2020 Creative, Inc.
 * Author URI: http://www.2020creative.com/
 *
*/
/*Add Custom CSS*/
//add_action('wp_enqueue_scripts','tt_custom_admin_style');
//add_action('admin_enqueue_scripts','tt_custom_admin_style');
//function tt_custom_admin_style() {
//	wp_register_style('tt_menu_tb_style', plugins_url('style.css', __FILE__));
//	wp_enqueue_style('tt_menu_tb_style');
//}
add_action('admin_bar_menu', 'tt_custom_tbmenu', 100);
function tt_custom_tbmenu($admin_bar) {
	$admin_bar->add_menu(array(
		'id'	=>	'2020creative',
		'title'	=>	'2020 Creative',
		'href'	=>	'http://2020creative.com',
		'meta'	=>	array(
			'title'	=>	__('2020 Creative'),
		),
	));
	$admin_bar->add_menu(array(
		'id'	=>	'support',
		'parent' =>	'2020creative',
		'title'	=>	'Contact Support',
		'href'	=>	'http://2020creative.com/contact',
		'meta'	=> array(
			'title'	=>	__('Contact Support'),
			'target' =>	'_blank',
			'class'	=>	'2020_support_link'
		),
	));
	$admin_bar->add_menu(array(
		'id'	=>	'billing',
		'parent'=>	'2020creative',
		'title'	=>	'Pay Your Bill',
		'href'	=>	'http://2020creative.com/payments',
		'meta'	=> array(
			'title'	=>	__('Pay Your Bill'),
			'target' =>	'_blank',
			'class'	=>	'2020_billing_link'
		),
	));
	$admin_bar->add_menu(array(
		'id'	=>	'news',
		'parent' =>	'2020creative',
		'title'	=>	'Latest News',
		'href'	=>	'http://2020creative.com/news',
		'meta' 	=> array(
			'title'	=>	__('Latest News'),
			'target' =>	'_blank',
			'class'	=>	'2020_news_link'
		),
	));
	$admin_bar->add_menu(array(
		'id'	=>	'cap',
		'parent' =>	'2020creative',
		'title'	=>	'Client CAP',
		'href'	=>	'http://2020creative.com/cap',
		'meta' 	=> array(
			'title'	=>	__('Client CAP'),
			'target' =>	'_blank',
			'class'	=>	'2020_cap_link'
		),
	));
	$admin_bar->remove_menu('wp-logo');
}