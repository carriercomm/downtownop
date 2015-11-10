<?php
/*
Template Name: Home Template
*/
get_header(); ?>

<?php $current_page_id = get_queried_object_id(); ?>
<?php if(has_post_thumbnail($current_page_id)):?>
<?php $thumb_id = get_post_thumbnail_id($current_page_id); ?>
<?php $attach = get_post($thumb_id);?>
<?php $img_title = $attach->post_title; ?>
<?php $img_description = $attach->post_content; ?>
<div class="visual hidden-xs">
	<?php echo do_shortcode("[metaslider id=87]"); ?>
	<?php if($img_title || $img_description) { ?> 
	<div class="descriptions">
		<?php if($img_title) echo '<h2>'.$img_title.'</h2>'; ?>
		<?php echo $img_description ?>
	</div>
	<?php } ?>
</div>
<?php endif; ?>

<?php if(is_active_sidebar('social-bar-sidebar')) dynamic_sidebar('social-bar-sidebar'); ?>

<div class="twocolumns">
<div class="row">
	<div id="content" class="col-md-8 col-xs-12">
	<div class="columns-holder">
			<?php 
                $newsCategoryID = 8;
                query_posts('cat='.$newsCategoryID.'&showposts=1'); ?>
			<?php if(have_posts()): ?>
			<div class="column col-md-6">
            	<h2><a href="<?php echo get_category_link( $newsCategoryID ); ?>">News</a></h2>
				<?php while(have_posts()): the_post(); ?>
				<?php if(has_post_thumbnail()): ?>
				
				<?php $bg_img = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'home-news' ); ?>
				
				<div class="news-img" style="background: url('<?php echo $bg_img[0]; ?>');"></div>
				
				<?php endif; ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
				<p><?php echo do_shortcode('[icon name="info-sign"]'); ?> <a class="link" href="<?php the_permalink(); ?>">More</a></p>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
			<?php wp_reset_query();?>
			<?php query_posts('post_type=tribe_events&showposts=1'); ?>
			<?php if(have_posts()):?>
			<div class="column col-md-5">
				<h2><a href="<?php echo home_url().'/?post_type=tribe_events'; ?> ">Events</a></h2>
				<?php while(have_posts()): the_post(); ?>
				<?php if(has_post_thumbnail()): ?>
				
				<?php $bg_img = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'home-news' ); ?>
				
				<div class="news-img" style="background: url('<?php echo $bg_img[0]; ?>');"></div>

				<?php endif; ?>
				<h3><?php the_title(); ?></h3>
				<?php the_excerpt(); ?>
				<p><?php echo do_shortcode('[icon name="info-sign"]'); ?> <a class="link" href="<?php the_permalink(); ?>">View Event</a></p>
				<?php endwhile; ?>
			</div>
			<?php  endif; ?>
			<?php wp_reset_query(); ?>
		</div>
        <?php get_template_part( 'ad', 'spot-b' ); ?> 
	</div>
       
	<div class="col-md-3 col-sm-12 col-xs-12">
	<?php get_sidebar(); ?>
	</div>
    
</div>
</div>
<?php get_footer(); ?>