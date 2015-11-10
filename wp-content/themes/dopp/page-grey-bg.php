<?php
/*
Template Name: Page with Grey Bg
*/
get_header(); ?>

<?php $current_page_id = get_queried_object_id(); ?>
<?php if(has_post_thumbnail($current_page_id)):?>
<?php $thumb_id = get_post_thumbnail_id($current_page_id); ?>
<?php $attach = get_post($thumb_id);?>
<?php $img_title = $attach->post_title; ?>
<?php $img_description = $attach->post_content; ?>
<div class="visual">
	<?php the_post_thumbnail('page_thumbnail'); ?>
	<?php if($img_title || $img_description) { ?> 
	<div class="descriptions">
		<?php if($img_title) echo '<h2>'.$img_title.'</h2>'; ?>
		<?php echo $img_description ?>
	</div>
	<?php } ?>
</div>
<?php endif; ?>
<div class="twocolumns">
<div class="row">
	<div id="content" class="col-md-8 col-sm-12 col-xs-12">
		<div class="columns-holder">
			<?php if(have_posts()): ?>
			<?php while(have_posts()): the_post(); ?>
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
			<?php endwhile; ?>
			<?php else: ?>
			<h3><?php _e('Not Found', 'base'); ?></h3>
			<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'base'); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-md-3 col-sm-12 col-xs-12">
	<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
