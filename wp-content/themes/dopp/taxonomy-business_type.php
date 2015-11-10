<?php get_header(); ?>

<div class="twocolumns">
<div class="row">
	<div id="content-page" class="col-md-12 col-xs-12">
		<div class="columns-holder">
			<?php //global $post;
			
/*
$args = array(
	'post_type' => 'business_directory',
	'post_status' => 'published',
	'meta_key' => 'business_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'posts_per_page'=> -1
);
$the_query = new WP_Query( $args );
*/

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
query_posts(array(
	'posts_per_page' => -1, 
	'post_type' => array('business_directory'), 
					'orderby'=> name, 
					'order'=>ASC, 
					'taxonomy'=>'business_type', 
					'term'=>$term->slug)
	);


			
// top
echo '<div style="padding:12px 0px;">' . do_shortcode('[biz_nav]') . do_shortcode('[search_bar2]') . '</div>';
// The Loop



if(have_posts()):
while(have_posts()): the_post();
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
		echo '<div class="business-list biz-mobile">'.
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
		'</div>'.
 		'</div>';
 		?>
 		<?php endwhile; ?>
				
				<div class="navigation">
					<div class="next"><?php next_posts_link(__('Previous &raquo;', 'base')) ?></div>
					<div class="prev"><?php previous_posts_link(__('&laquo; Next', 'base')) ?></div>
				</div>
		
			<?php else: ?>
			<h3><?php _e('Not Found', 'base'); ?></h3>
			<?php endif; ?>

		</div>
	</div>
	</div>
</div>
<?php get_footer(); ?>
