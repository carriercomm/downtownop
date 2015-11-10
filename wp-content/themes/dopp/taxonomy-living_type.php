<?php get_header(); ?>
<div class="twocolumns">
<div class="map hidden-xs">
<?php echo do_shortcode ('[codepeople-post-map tag="living" width="100%"]'); ?>
</div>
	<div id="business-content">
	
				<?php 
				$defaults = array(
	'theme_location'  => '',
	'menu'            => 'Living Types',
	'container'       => 'div',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'menu-living',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );

echo '<div class="clearfix"></div>';
				         
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); 
			//
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
	        $living_contact_phone_1 = get_post_meta($post->ID, "living_contact_phone_1", true);
	        $living_contact_email = get_post_meta($post->ID, "living_contact_email", true);
	        $living_contact_website = get_post_meta($post->ID, "living_contact_website", true);
			
			// Post Content here
			echo '<div class="business-list">'.
 		'<div class="row">'.
		  '<div class="col-md-4 col-xs-12"><div class="business-list-photo-wrap hidden-xs"><div class="business-list-photo"><a href="' . $permalink . '"><img width="150" height="150" src="' . $living_img1 . '"</a></div></div>'.
		  '<a href="' . $permalink . '"><div class="living-name">' . $living_name . '</div></a></div>'.
		  '<div class="col-md-3"><div class="address-living-line hidden-xs">' . $living_add1 . '</div></div>'.
		  '<div class="col-md-2"><span class="pull-left medium">' . $living_phone_1 . '</span> <span class="living-type small hidden-xs">  ' . 
		  //$living_property_type . 
		  '</span></div>'.
		  '<div class="col-md-1"><span class="edit pull-right hidden-xs"><a class="post-edit-link" href="/wp-admin/post.php?post=' . $post_id . '&amp;action=edit">Edit</a></span></div>'.
		'</div>'.
 		'</div>';
 		
			//
		} // end while
	} // end if
?>


		</div>
	
<?php get_footer(); ?>
</div>
</div>