<?php

/*
Author: 2020 Creative
URL: htp://2020creative.com
*/

////////////////////////////////////////////////////////////// Commercial Directory
add_shortcode( 'commercial_directory', 'commercial_directory1' );
function commercial_directory1 ( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => '',
			'list' => 'n',
		), $atts )
	);

// code
	
// The Query
$args = array(
	'post_type' => 'living_directory',
	'post_status' => 'published',
	'posts_per_page'=> -1,
	'meta_key' => 'living_square_feet',
	'orderby' => 'meta_value_num',
	'tax_query' => array(
		array(
			'taxonomy' => 'living_type',
			'field' => 'slug',
			'terms' => array( 'commercial' ),
	)));

$the_query = new WP_Query( $args );

global $post;
// top

// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		// pull meta for each post
		$post_id = get_the_ID();
		$permalink = get_permalink( $id );
		$living_name = get_post_meta($post->ID, "living_name", true);
        $living_img1 = get_post_meta($post->ID, "living_image_1.guid", true);
        $living_img2 = get_post_meta($post->ID, "living_image_2.guid", true);
        $living_img3 = get_post_meta($post->ID, "living_image_3.guid", true);
        $living_img4 = get_post_meta($post->ID, "living_image_4.guid", true);
        $living_img5 = get_post_meta($post->ID, "living_image_5.guid", true);
		$living_desc = get_the_content();
		$living_add1 = get_post_meta($post->ID, "living_add_1", true);
        $living_add2 = get_post_meta($post->ID, "living_add_2", true);
        $living_city = get_post_meta($post->ID, "living_city", true);
        $living_state = get_post_meta($post->ID, "living_state", true);
        $living_zip = get_post_meta($post->ID, "living_zip", true);
		$living_property_type = get_post_meta($post->ID, "living_property_type.name", true);
		$living_phone_1_label = get_post_meta($post->ID, "living_phone_1_label", true);
		$living_phone_1 = get_post_meta($post->ID, "living_phone_1", true);
		$living_phone_2_label = get_post_meta($post->ID, "living_phone_2_label", true);
		$living_phone_2 = get_post_meta($post->ID, "living_phone_2", true);
		$living_email = get_post_meta($post->ID, "living_email", true);
        $living_website = get_post_meta($post->ID, "living_website", true);
        $living_price_label = get_post_meta($post->ID, "living_price_label", true);
        $living_price = get_post_meta($post->ID, "living_price", true);
        $living_price_term = get_post_meta($post->ID, "living_price_term", true);
        $living_contact_photo = get_post_meta($post->ID, "living_contact_profile_photo.guid", true);
        $living_contact_name = get_post_meta($post->ID, "living_contact_name", true);
        $living_contact_phone_1_label = get_post_meta($post->ID, "living_contact_phone_1_label", true);
        $living_contact_phone_1 = get_post_meta($post->ID, "living_contact_phone", true);
        $living_contact_email = get_post_meta($post->ID, "living_contact_email", true);
        $living_contact_website = get_post_meta($post->ID, "living_contact_website", true);
        $living_square_feet = get_post_meta($post->ID, "living_square_feet", true);
        
        $edit_link_url = get_edit_post_link($post->ID);      
        $edit_link = '<span class="edit-pencil-link"><a href="' . $edit_link_url . '"><i class="fa fa-pencil"></i></a></span>';
		
		// set variables
				
		if( empty( $edit_link_url ) ) {
        	$edit_link = "";
				};
		
// display html
 		$output .= '<div class="list-view">'.
 		'<div class="row">'.
		  '<div class="col-sm-10 col-md-5"> <a class="list-name no-underline" href="' . $permalink . '">' . $living_name . '</a>'. $edit_link . '</div>'.
		  '<div class="col-md-2 contact-name">' . $living_contact_name . '</div>'.
		  '<div class="col-sm-10 list-accent col-md-2">' . $living_contact_phone_1 . '</div>'.
		  '<div class="col-md-1">' . $living_square_feet . '<span class="sqft">SqFt</span></div>'.
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