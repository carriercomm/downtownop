<?php

/*
Author: 2020 Creative
URL: htp://2020creative.com
*/

////////////////////////////////////////////////////////////////////////////////////////////// DOPP Directory
add_shortcode( 'dopp_directory', 'dopp_directory1' );
function dopp_directory1 ( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => 'all',
			'list' => 'n',
			'map' => 'n',
		), $atts )
	);

///////////////////////////////////////////////////////////////// All Query
if ($name == 'all') {
	// The Query
$args = array(
	'post_type' => 'business_directory',
	'post_status' => 'publish',
	'meta_key' => 'business_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'posts_per_page'=> -1
);
$the_query = new WP_Query( $args );
} else { 
	//nothing
	}
///////////////////////////////////////////////////////////////// Food Query
if ($name == 'food') {
	// The Query
$args = array(
	'post_type' => 'business_directory',
	'post_status' => 'publish',
	'meta_key' => 'business_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'posts_per_page'=> -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'business_type',
			'field' => 'slug',
			'terms' => array(
						'fooddrink',
						'restaurant', 
						'foodbeverage-retail', 
						'bakery' )
		)
	)
	
);
$the_query = new WP_Query( $args );
} else { 
	//nothing
	}
///////////////////////////////////////////////////////////////// Shops Query
if ($name == 'shops') {
	// The Query
$args = array(
	'post_type' => 'business_directory',
	'post_status' => 'publish',
	'meta_key' => 'business_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'posts_per_page'=> -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'business_type',
			'field' => 'slug',
			'terms' => array( 
						'shopping',
						)
		)
	)
	
);
$the_query = new WP_Query( $args );
} else { 
	//nothing
	}
///////////////////////////////////////////////////////////////// Parking Query
if ($name == 'parking') {
	// The Query
$args = array(
	'post_type' => 'business_directory',
	'post_status' => 'publish',
	'meta_key' => 'business_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'posts_per_page'=> -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'business_type',
			'field' => 'slug',
			'terms' => array( 
						'parking',
						)
		)
	)
	
);
$the_query = new WP_Query( $args );
} else { 
	//nothing
	}
///////////////////////////////////////////////////////////////// Professional Services Query
if ($name == 'proserv') {
	// The Query
$args = array(
	'post_type' => 'business_directory',
	'post_status' => 'publish',
	'meta_key' => 'business_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'posts_per_page'=> -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'business_type',
			'field' => 'slug',
			'terms' => array( 
						'professional-services',
						)
		)
	)
	
);
$the_query = new WP_Query( $args );
} else { 
	//nothing
	}


global $post;
// top
// menu
if ($map == 'n') {
	do_shortcode('[biz_nav]');
	do_shortcode('[search_bar2]');
	echo '<div class="clearfix"></div>';
};
// map - nav
if ($map == 'y') {
	do_shortcode('[map_nav]');
	echo '<div class="clearfix"></div>';
};
// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		// pull meta for each post
		$post_id = get_the_ID();
		$permalink = get_permalink( $id );
		$business_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'list-img', false, '');
		$business_img_url = $business_img[0];
		$business_name = get_post_meta($post->ID, "business_name", true);
		$business_add1 = get_post_meta($post->ID, "address_line_1", true);
        $business_add2 = get_post_meta($post->ID, "address_line_2", true);
		$business_type = get_post_meta($post->ID, "business_type_select.name", true);
		$business_phone_1 = get_post_meta($post->ID, "phone", true);
		
		$edit_link_url = get_edit_post_link($post->ID);
		$edit_link = '<span class="edit-pencil-link"><a href="' . $edit_link_url . '"><i class="fa fa-pencil"></i></a></span>';
		
		// set variables
        if( empty( $business_img_url ) ) {
        	$business_img_url = "/wp-content/themes/dopp/images/dopp-mark-img2.png";
				};
				
		if( empty( $edit_link_url ) ) {
        	$edit_link = "";
				};
		
// display html
 		$output .= '<div class="business-list">'.
 		'<div class="row">'.
		  '<div class="col-md-4 col-xs-12">'.
		  	'<a href="' . $permalink . '">'.
		  		'<div class="business-list-photo-wrap hidden-xs">'.
		  			'<div class="business-list-photo">'.
		  				'<img width="50" height="50" src="' . $business_img_url . '">'.
		  			'</div>'.
		  		'</div>'.
		  	'</a>'.
		  '<a href="' . $permalink . '"><div class="living-name">' . $business_name . '</div></a> '.
		  $edit_link.
		'</div>'.
		  '<div class="col-md-2"><div class="address-living-line hidden-xs">' . $business_add1 . '</div></div>'.
		  '<div class="col-md-2">' . $business_phone_1 . '</div>' . 
		  '<div class="living-type hidden-xs col-md-2">'. $business_type . '</div>'.
			  /*
'<span class="edit pull-right hidden-xs">'.
				  '<a class="post-edit-link" href="/wp-admin/post.php?post=' . $post_id . '&amp;action=edit">Edit</a>'.
			  '</span>'
			  
			  <span class="edit-pencil-link"><a class="post-edit-link" href="/wp-admin/post.php?post=' . $post_id . '&amp;action=edit"><i class="post-edit-link fa fa-pencil"></i></a></span>'.
		'</div>.
*/
		'</div>'.
 		'</div>';
	}
} else {
	// no posts found
	echo '<h2>No Listings found</h2>';
}
/* Restore original Post Data */
wp_reset_postdata();
return $output;
}