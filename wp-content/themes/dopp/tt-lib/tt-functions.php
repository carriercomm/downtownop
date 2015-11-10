<?php

/*
Author: 2020 Creative
URL: htp://2020creative.com
*/
//////////////////////////////////////////////////////// 2020 Functions
define( 'TEMPPATH', get_stylesheet_directory_uri());
define( 'IMAGES', TEMPPATH. "/imgages");

// Custom fields
// require_once ('plugins/advanced-custom-fields/acf.php');

// Shortcodes
require_once ('tt-directory.php');
require_once ('tt-commercial.php');

// CPT's
// require_once ('tt-cpt.php');


// Custom CSS
add_action('wp_enqueue_scripts','tt_custom_css');
add_action('admin_enqueue_scripts','tt_custom_css');
function tt_custom_css() {
	wp_register_style('tt_menu_tb_style', get_template_directory_uri() . '/tt-lib/tt-style-print.css');
	wp_enqueue_style('tt_menu_tb_style');
}





// 2020 DOPP Functions
////////////////////////////////////////////////////////////// bootstrap icons
add_shortcode( 'icon', 'icon1' );
function icon1 ( $atts ) {

// Attributes
	extract( shortcode_atts(array(
			'name' => '',
			'color' => '#000000'
		), $atts ));
// code
return '<span class="glyphicon glyphicon-' . $name .'" style="color:' . $color . ';"></span>';
}

////////////////////////////////////////////////////////////// Living Directory
add_shortcode( 'living_directory', 'living_directory1' );
function living_directory1 ( $atts ) {

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
	'meta_key' => 'living_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'tax_query' => array(
		'relation' => 'NOT IN',
		array(
			'taxonomy' => 'living_type',
			'field' => 'slug',
			'terms' => array( 'commercial' ),
			'operator' => 'NOT IN'
			),
		)
	);

$the_query = new WP_Query( $args );

global $post;
// top
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

// page menu
wp_nav_menu( $defaults );

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
        $living_contact_phone_1 = get_post_meta($post->ID, "living_contact_phone_1", true);
        $living_contact_email = get_post_meta($post->ID, "living_contact_email", true);
        $living_contact_website = get_post_meta($post->ID, "living_contact_website", true);
		
// display html
 		$output .= '<div class="business-list">'.
 		'<div class="row">'.
		  '<div class="col-md-4 col-xs-12"><div class="business-list-photo-wrap hidden-xs"><div class="business-list-photo"><a href="' . $permalink . '"><img width="150" height="150" src="' . $living_img1 . '"</a></div></div>'.
		  '<a href="' . $permalink . '"><div class="living-name">' . $living_name . '</div></a></div>'.
		  '<div class="col-md-3"><div class="address-living-line hidden-xs">' . $living_add1 . '</div></div>'.
		  '<div class="col-md-2"><span class="pull-left medium">' . $living_phone_1 . '</span> <span class="living-type small hidden-xs">  ' . 
		  //$living_property_type . 
		  '</span></div>'.
		  '<div class="col-md-1"><span class="edit pull-right hidden-xs"><a class="post-edit-link" href="/wp-admin/post.php?post=' . $post_id . '&amp;action=edit">Edit</a></span></div>'.
		'</div></div>';
	}
} else {
	// no posts found
	echo '<h2>No Listings found</h2>';
}
/* Restore original Post Data */
wp_reset_postdata();
return $output;
}
////////////////////////////////////////////////////////////// map nav
add_shortcode( 'map_nav', 'map_nav1' );
function map_nav1 ( $atts ) {

// Attributes
	extract( shortcode_atts(
		array(
			'name' => '',
			'list' => 'n',
		), $atts )
	);
	
// code
$defaults = array(
	'theme_location'  => '',
	'menu'            => 'Map Submenu',
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
}
////////////////////////////////////////////////////////////// business filter nav
add_shortcode( 'biz_nav', 'biz_nav1' );
function biz_nav1 ( $atts ) {

// Attributes
	extract( shortcode_atts(
		array(
			'name' => '',
			'list' => 'n',
		), $atts )
	);
	
// code
$defaults = array(
	'theme_location'  => '',
	'menu'            => 'Business Types',
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

}


////////////////////////////////////////////////////////////// Business Directory //////////// Depricate?
add_shortcode( 'business_directory', 'business_directory1' );
function business_directory1 ( $atts ) {

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
	'post_type' => 'business_directory',
	'post_status' => 'published',
	'meta_key' => 'business_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'posts_per_page'=> -1
);

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
////////////////////////////////////////////////////////////// Search bar #1 depricated
add_shortcode( 'search_bar', 'search_bar1' );
function search_bar1 ( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => '',
		), $atts )
	);

// code
$args = array(
	'show_option_all'    => '',
	'show_option_none'   => '',
	'orderby'            => 'ID', 
	'order'              => 'ASC',
	'show_count'         => 0,
	'hide_empty'         => 1, 
	'child_of'           => 0,
	'exclude'            => '',
	'echo'               => 0,
	'selected'           => 0,
	'hierarchical'       => 1, 
	'name'               => 'business-type',
	'id'                 => '',
	'class'              => 'postform',
	'depth'              => 0,
	'tab_index'          => 0,
	'taxonomy'           => 'business_type',
	'hide_if_empty'      => true,
    'walker'             => ''
);

$dopp_tax = wp_dropdown_categories( $args ); 
?>
<li id="categories">
	<h2><?php _e('Posts by Category'); ?></h2>
	<form action="<?php bloginfo('url'); ?>/business-type/" method="get">
	<div>
<?php
$select = wp_dropdown_categories( $args );
$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
echo $select;
?>
	<noscript><div><input type="submit" value="View" /></div></noscript>
	</div></form>
</li>
<?php
//print_r( $dopp_tax );

}
////////////////////////////////////////////////////////////// Search bar #2 active
add_shortcode( 'search_bar2', 'search_bar2' );

function search_bar2($taxonomies, $args){
  $categories = get_categories(array('taxonomy' => 'business_type'));
 
  $select = "<select name='cat' id='cat' class='postform dopplist'>".
    "<option value='-1'>Select category</option>";
 
  foreach($categories as $category){
    if($category->count > 0){
        $select.= "<option value='".$category->slug."'>".$category->name."</option>";
    }
  }
 
  $select.= "</select>";
 
  echo '<div class="search-bar col-xs-12">' . $select . '</div><div class="clearfix"></div></br>';
?>
<script type="text/javascript"><!--
    var dropdown = document.getElementById("cat");
    function onCatChange() {
        if ( dropdown.options[dropdown.selectedIndex].value != -1 ) {
            location.href = "<?php echo home_url();?>/business-type/"+dropdown.options[dropdown.selectedIndex].value+"/";
        }
    }
    dropdown.onchange = onCatChange;
--></script>
<?php	
}
	

////////////////////////////////////////////////////////////// Gift card list
add_shortcode( 'gift_card_list', 'gift_card_list1' );
function gift_card_list1 ( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => 'all',
			'list' => 'n',
		), $atts )
	);
//Query
$args = array(
	'post_type' => 'business_directory',
	'post_status' => 'published',
	'order' => 'ASC',
	'orderby' => 'title',
	'posts_per_page'=> -1,
	'meta_query' => array(
		array(
			'key' => 'accepts_gift_cards',
			'value' => 1,
			'compare' => 'IN'
		)));
		
$the_query = new WP_Query( $args );

//loop
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
		$business_type = get_post_meta($post->ID, "business_type_select.name", true);
		$business_phone_1 = get_post_meta($post->ID, "phone", true);
		
		$edit_link_url = get_edit_post_link($post->ID);
		$edit_link = '<span class="edit-pencil-link"><a href="' . $edit_link_url . '"><i class="fa fa-pencil"></i></a></span>';
		
		// set variables
        if( empty( $business_name ) ) {
        	$business_name = get_the_title();
				};
		
// display html
 		$output .= '<a class="no-underline" href="' . $permalink . '"><div class="list-view list-small">' . $business_name . '</div></a>';
	}
} else {
	// no posts found
	echo '<h2>No Listings found</h2>';
}
/* Restore original Post Data */
wp_reset_postdata();
return $output;
}

////////////////////////////////////////////////////////////// Default Sidebar
add_shortcode( 'dopp_sidebar', 'dopp_sidebar1' );
function dopp_sidebar1 ( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => 'all',
			'list' => 'n',
		), $atts )
	);
//HTML output

?>
<a class="promo-link" href="/gift-cards/">

	<div class="promo-btn-group">
	
		<div class="promo-img-holder gift"></div>
		
			<div class="promo-btn">
			
				<div class="">
					<p>Purchase Gift Card<p>
				</div>
			
		</div>
		
	</div>

</a>
<a class="promo-link" href="/newsletter/">

	<div class="promo-btn-group">
	
		<div class="promo-img-holder nl"></div>
		
			<div class="promo-btn">
			
				<div class="">
					<p>Sign up for E-news<p>
				</div>
			
		</div>
		
	</div>

</a>
<!--
<a class="promo-link" href="/category/news/">

	<div class="promo-btn-group">
	
		<div class="promo-img-holder coupon"></div>
		
			<div class="promo-btn">
			
				<div class="">
					<p>Promos and Coupons<p>
				</div>
			
		</div>
		
	</div>

</a>
-->
<?php
}
////////////////////////////////////////////////////////////// Ad spot 1
add_shortcode( 'dopp_ad', 'dopp_ad1' );
function dopp_ad1 ( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'id' => '2917', //2917 is DEV, 4126 is live
			'url' => '',
			'size' => 'medium',
			'target' => '_blank',
			'alt' => '',
		), $atts )
	);
//html
    $post_status = get_post_status( $id ); 
    $featured_img = get_post_thumbnail_id( $id );
    $ad_1_img = wp_get_attachment_url( $featured_img );
    $ad_1_link = get_post_meta( $id, 'ad_spot_1_link', true ); 

    if ( $post_status == 'publish' ) {
        echo '<a href="'.$ad_1_link.'" target="'.$target.'"><img src="'.$ad_1_img.'" width="255px"></a>';
    }else{
        
        // do nothing
    }
}
