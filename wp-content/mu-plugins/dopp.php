<?php

/**
 *
 * Plugin Name: 2020 Client DOPP
 * Plugin URI: http://2020creative.com/
 * Description: 2020 Development
 * Version: 1.0.0
 * Author: 2020 Creative, Inc.
 * Author URI: http://www.2020creative.com/
 *
*/

// 2020 Admin plugin must be installed for site to function

// Add shortcode - news [area_info_full]
add_shortcode('tt_bizlist', 'tt_bizlist_1');
function tt_bizlist_1() {
        global $post;
        
    $business_name = get_post_meta($post->ID, "business_name", true);
    
        return $business_name;
         
}