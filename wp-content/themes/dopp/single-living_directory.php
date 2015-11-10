<?php get_header(); ?>
<div class="visual">
    
<div class="twocolumns">

<div class="row">
	<div id="content" class="col-sm-8 col-xs-12">
		<div class="columns-holder">
		<?php
			global $post;
			$post_id = get_the_ID();
            $post_info = get_post($post_id);
            $permalink = get_permalink($id);
			$living_name = get_post_meta($post->ID, "living_name", true);
	        $living_img1 = get_post_meta($post->ID, "living_image_1.guid", true);
	        $living_img2 = get_post_meta($post->ID, "living_image_2.guid", true);
	        $living_img3 = get_post_meta($post->ID, "living_image_3.guid", true);
	        $living_img4 = get_post_meta($post->ID, "living_image_4.guid", true);
	        $living_img5 = get_post_meta($post->ID, "living_image_5.guid", true);
			$living_desc = get_the_content($post->ID);
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
	        $living_contact_photo = get_post_meta($post->ID, "living_contact_photo.guid", true);
	        $living_contact_name = get_post_meta($post->ID, "living_contact_name", true);
	        $living_contact_title = get_post_meta($post->ID, "living_contact_title", true);
	        $living_contact_phone_1_label = get_post_meta($post->ID, "living_contact_phone_1_label", true);
	        $living_contact_phone_1 = get_post_meta($post->ID, "living_contact_phone", true);
	        $living_contact_email = get_post_meta($post->ID, "living_contact_email", true);
	        $living_contact_website = get_post_meta($post->ID, "living_contact_website", true);
			
			echo '<div class="business-title"><h1 class="business-name-detail">' . $living_name . '</h1></div>';

			/////////////// image
            if ( '' != $living_img1 )
							    echo '<div class="business-img"><img src="' . $living_img1 . '" width="560px"></div>';

			/////////////// Desc
			echo '<div class="living-content">' . $post_info->post_content . '</div>';
							
            if ( '' != $living_phone_1 )
                $icon_ph1 = '<span class="glyphicon glyphicon-earphone"></span><span class="data-label">' . $living_phone_1_label . '</span><span class="field">' . $living_phone_1 . '</span>';
							
            if ( '' != $living_phone_2 )
                $icon_ph2 = '<span class="glyphicon glyphicon-earphone"></span><span class="data-label">' . $living_phone_2_label . '</span><span class="field">' . $living_phone_2 . '</span>';
							
            if ( '' != $living_contact_phone_1 )
							    $icon_contact_ph1 = '<span class="glyphicon glyphicon-earphone"></span><span class="data-label">' . $living_contact_phone_1_label . '</span><span class="field">' . $living_contact_phone_1 . '</span>';

					////////////////// Address info
            if(!empty($living_add1) || !empty($living_phone_1)) {
                echo '<div class="business-add-info">';
                if(!empty($living_add1)) echo '<div class="business-add1">' . $living_add1 . '</div>';
                if(!empty($living_phone_1)) echo '<div class="business-ph">' . $icon_ph1 . '</div>';
                echo '</div>';
            }
					
					////////////////// Property info
					echo '<div class="living-info clearfix">',
						'<p class="living-type clearfix bg-success"><span class="glyphicon glyphicon-home"></span> ' . $living_property_type . '</p>';
						
                if(!empty($living_price))
							echo '<p class="living-data"><span class="label"> ' . $living_price_label . '</span><span class="field">' . $living_price . '</span><span class="term">' . $living_price_term . '</span></p>';
                if(!empty($icon_ph2))
							echo '<p class="living-data">' . $icon_ph2 . '</p>';

					echo '</div>';

					////////////////// Info Bar
					echo '<div class="business-info-bar">';
					if(!empty($living_website)) {
							echo '<div class="business-www col-md-3 pull-left">',
						'<a href="http://' . $living_website . '" target="_blank"><span class="glyphicon glyphicon-globe"></span> Website</a></div>';
							}
					if(!empty($business_fb)) {
							echo '<div class="business-fb col-md-3">',
						'<a href="' . $business_fb . '" target="_blank"><i class="fa fa-facebook-square"></i> Facebook</a></div>';
							}
					echo '</div>';			

					////////////////// Contact
					echo '<div class="clearfix living-contact-info">';
					
					if(!empty($living_contact_photo)) {
							echo '<div class="contact-photo fleft"><img src="' . $living_contact_photo . '" width="150px"></div>';
							}
					
				echo '<h3 class="living-data"><strong>' . $living_contact_name . '</strong></h3>',
						'<p class="living-data">' . $living_contact_title . '</p>',
						'<p class="living-data">' . $icon_contact_ph1  . '</p>';
						
						if(!empty($living_contact_email)) {
							echo '<button type="button" class="btn btn-primary btn-md">',
							  '<span class="glyphicon glyphicon-envelope"></span>' . eeb_email($living_contact_email, ' Email Me'),
							  '</button> ';
							}
						if(!empty($living_contact_website)) {
							echo '<a href="http://' . $living_contact_website . '" target="_blank"><button type="button" class="btn btn-primary btn-md">',
							  '<span class="glyphicon glyphicon-globe"></span> Website',
							  '</button></a>';
							}
						echo '</div>';
					
					//map
					echo '<p>' . do_shortcode( '[codepeople-post-map width="685" height="200"]' ) . '</p>';							
			
			?>
        </div><!-- columns-holder -->
    </div><!-- content -->
        <div class="col-sm-3 col-xs-12">
            <?php get_sidebar(); ?>
        </div>

</div><!-- row -->

</div><!-- twocolumns -->
        
</div><!-- visual -->

<?php get_footer(); ?>
