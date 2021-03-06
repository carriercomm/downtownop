<?php
/*
Template Name: Search Page
*/
?>
<?php get_header(); ?>

<?php $current_page_id = get_queried_object_id(); ?>
<?php if(has_post_thumbnail($current_page_id)):?>
<?php $thumb_id = get_post_thumbnail_id($current_page_id); ?>
<?php $attach = get_post($thumb_id);?>
<?php $img_title = $attach->post_title; ?>
<?php $img_description = $attach->post_content; ?>
<div class="visual col-sm-0">
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
	<div id="content-page" class="col-md-8 col-sm-12">
		<div class="columns-holder">
			<?php get_search_form(); ?>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
	<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
