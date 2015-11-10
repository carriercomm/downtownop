<?php get_header(); ?>
<div class="twocolumns">
<p><?php single_tag_title(); ?></p>
<?php echo do_shortcode ('[codepeople-post-map tag="living" width="100%"]'); ?>
	<div id="business-content">
	


<?php echo do_shortcode ('[living_directory]'); ?>

		</div>
	</div>
<?php get_footer(); ?>