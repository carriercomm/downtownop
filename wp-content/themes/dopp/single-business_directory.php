<?php get_header(); ?>


<div class="visual">
	
<div class="twocolumns">
<div class="row">
	<div id="content" class="col-md-8">
		<div class="columns-holder">
		<?php
			global $post;
			$permalink = get_permalink( $id );
			$business_name = get_post_meta($post->ID, "business_name", true);
			//$business_img = the_post_thumbnail('business-photo');
			$business_photo = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'business-photo');
			$business_www = get_post_meta($post->ID, "website", true);
			$business_fb = get_post_meta($post->ID, "facebook_link", true);
			$business_desc = get_post_meta($post->ID, "business_description", true);
			$business_more = get_post_meta($post->ID, "more_details", true);
			$address_line_1 = get_post_meta($post->ID, "address_line_1", true);
			$address_line_2 = get_post_meta($post->ID, "address_line_2", true);
			$city = get_post_meta($post->ID, "city", true);
			$state = get_post_meta($post->ID, "state", true);
			$zip = get_post_meta($post->ID, "zip", true);
			$phone = get_post_meta($post->ID, "phone", true);
			$business_type_select = get_post_meta($post->ID, "business_type_select", true);
			$accepts_gift_cards = get_post_meta($post->ID, "accepts_gift_cards", true);
			$hours_of_operation = get_post_meta($post->ID, "hours_of_operation", true);
			$hours_old = get_post_meta($post->ID, "hrs_of_operation_old", true);
			$monday_open = get_post_meta($post->ID, "monday_open", true);
			$tuesday_open = get_post_meta($post->ID, "tuesday_open", true);
			$wednesday_open = get_post_meta($post->ID, "wednesday_open", true);
			$thursday_open = get_post_meta($post->ID, "thursday_open", true);
			$friday_open = get_post_meta($post->ID, "friday_open", true);
			$saturday_open = get_post_meta($post->ID, "saturday_open", true);
			$sunday_open = get_post_meta($post->ID, "sunday_open", true);
			$monday_close = get_post_meta($post->ID, "monday_close", true);
			$tuesday_close = get_post_meta($post->ID, "tuesday_close", true);
			$wednesday_close = get_post_meta($post->ID, "wednesday_close", true);
			$thursday_close = get_post_meta($post->ID, "thursday_close", true);
			$friday_close = get_post_meta($post->ID, "friday_close", true);
			$saturday_close = get_post_meta($post->ID, "saturday_close", true);
			$sunday_close = get_post_meta($post->ID, "sunday_close", true);
			
			$business_type_list = get_taxonomy('business_type');
			$map_address = $address_line_1 . ' ' . $city . ' ' . $state . ' ' . $zip;
			
			
			
			if (!empty($phone)) {
				$phone = '<i class="fa fa-phone"></i> ' . $phone;
			}
			
			echo '<div class="business-title"><h1 class="business-name-detail">' . $business_name . '</h1></div>';
			/////////////// image
			if ( '' != get_the_post_thumbnail() ) {
							    // some code
							    echo '<div class="business-img"><img src="' . $business_photo[0] . '"></div>';
							} else {
							    echo ''; // if no image
							};
							
					echo '<div class="business-desc">' . $business_desc . '</div>',
					'<div class="business-desc">' . $business_more . '</div>',
					////////////////// Address info
					'<div class="business-add-info">',
						'<div class="business-add1">' . $address_line_1 . '</div>',
						//'<div class="business-add2">' . $address_line_2 . '</div>',
						//'<div class="business-city">' . $city . ', ' . $state . ' ' . $zip . '</div>',
						'<div class="business-ph">' . $phone . '</div>',
					'</div>',
					////////////////// Info Bar
					'<div class="business-info-bar">';
					if(!empty($business_www)) {
							echo '<div class="business-www col-md-3 pull-left">',
						'<a href="' . $business_www . '" target="_blank"><span class="glyphicon glyphicon-globe"></span> Website</a></div>';
							}
					if(!empty($business_fb)) {
							echo '<div class="business-fb col-md-3">',
						'<a href="' . $business_fb . '" target="_blank"><i class="fa fa-facebook-square"></i> Facebook</a></div>';
							}	
					if($accepts_gift_cards != 0) {
							echo '<div class="gift-accept"><i class="fa fa-credit-card"></i> We accept Downtown gift cards.</div>';
							}
					echo '</div>';
					///////// Hours of operation
					if($hours_of_operation != 0) {
						echo '<h3 class="business-hrs-title">Hours of Operation</h3>',
						'<ul class="hours-list">',
					'<li class="hrs-label">Monday:</li><li class="hrs-time">' . $monday_open . ' - ' . $monday_close . '</li>',
					'<li class="hrs-label">Tuesday:</li><li class="hrs-time">' . $tuesday_open . ' - ' . $tuesday_close . '</li>',
					'<li class="hrs-label">Wednesday:</li><li class="hrs-time">' . $wednesday_open . ' - ' . $wednesday_close . '</li>',
					'<li class="hrs-label">Thursday:</li><li class="hrs-time">' . $thursday_open . ' - ' . $thursday_close . '</li>',
					'<li class="hrs-label">Friday:</li><li class="hrs-time">' . $friday_open . ' - ' . $friday_close . '</li>',
					'<li class="hrs-label">Saturday:</li><li class="hrs-time">' . $saturday_open . ' - ' . $saturday_close . '</li>',
					'<li class="hrs-label">Sunday:</li><li class="hrs-time">' . $sunday_open . ' - ' . $sunday_close . '</li>',
					'</ul>';
					}
					
					//map
					echo '<p>' . do_shortcode( '[codepeople-post-map width="685" height="200"]' ) . '</p>';
												
			
			?>
</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="dopplist-container">	
			<?php do_shortcode('[search_bar2]'); ?>
		</div>
    	<?php get_sidebar(); ?>
	
	</div>
</div>

<?php get_footer(); ?>
