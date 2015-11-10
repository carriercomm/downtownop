<!-- Search results page -->

<?php get_header(); ?>

<div class="twocolumns">
<div class="row">
	<div id="content" class="col-md-8 col-sm-12">
		<div class="columns-holder">
				
			<?php global $post;	?>				
			<?php if(have_posts()): ?>
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<h2><?php _e('Search Results', 'base'); ?></h2>
			<?php while(have_posts()): the_post(); ?>
			
			<?php 
			
			// set variables
			
				$business_description = get_post_meta($post->ID, "business_description", true);
									
				if( empty( $business_description ) ) {
				
		        	//$business_description = "-";
				
						};
				
			?>
			
			<?php 
				 if ( has_post_thumbnail()) {
				  
				   $tn_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-news');
				   $post_img = $tn_image_url[0];
				 } else {
						$post_img = '/wp-content/themes/dopp/images/dopp-mark-img2.png'; 
				 }
			?>
			
				
				<?php if( get_post_type() == 'business_directory' ) { ?>
				
				<div class="article-wrap">
				
				<div class="post-img pull-left img-cir-container">
					<img class="" src="<?php echo $post_img; ?>" width="140px" height="140px"></div>
				
				<div class="article-info">
						    				
					<h3>Business: <a class="text-primary" style="text-decoration:none;" href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'base'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					
				<?php echo $business_description; ?>
				
				</div></div>
				
				
				<?php } else { }?>
				
				
				<?php if( get_post_type() == 'tribe_events' ) { ?>
				
				<div class="article-wrap">
				
				<div class="post-img pull-left img-cir-container">
					<img class="" src="<?php echo $post_img; ?>" width="140px" height="140px"></div>
				
				<div class="article-info">
						    				
					<h3>Event: <a class="text-primary" style="text-decoration:none;" href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'base'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					
					<p class="info post-info"><strong class="date"><?php the_time('F jS, Y') ?></strong></p>
					
				<?php echo the_content(); ?>
				
				</div></div>
				
				
				<?php } else { }?>
				
				<?php if( get_post_type() == 'page' ) { ?>
				
				<div class="article-wrap">
				
							    				
					<h3 style="margin-left:175px;">Page: <a class="text-primary" style="text-decoration:none;" href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'base'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					
				
				</div>
				
				
				<?php } else { }?>
				
				<?php if( get_post_type() == 'post' ) { ?>
				
				<div class="article-wrap">
				
				<div class="post-img pull-left img-cir-container">
					<img class="" src="<?php echo $post_img; ?>" width="140px" height="140px"></div>
				
				<div class="article-info">
						    				
					<h3><a class="text-primary" style="text-decoration:none;" href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'base'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					
					<p class="info post-info"><strong class="date"><?php the_time('F jS, Y') ?></strong></p>
					
				<?php echo the_excerpt(); ?>
				
				</div></div>
				
				
				<?php } else { }?>
				
				
								
				<?php endwhile; ?>
				
				<div class="navigation">
					<div class="next"><?php next_posts_link(__('Previous &raquo;', 'base')) ?></div>
					<div class="prev"><?php previous_posts_link(__('&laquo; Next', 'base')) ?></div>
				</div>
		
			<?php else: ?>
			<?php _e('No posts found.', 'base'); ?>
			<p><?php _e('Try a different search?', 'base'); ?></p>
			<?php get_search_form(); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<?php get_sidebar(); ?>
	</div>
</div>
</div>
<?php get_footer(); ?>
