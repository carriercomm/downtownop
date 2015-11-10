<?php get_header(); ?>

<div class="twocolumns">
<div class="row">
	<div id="content" class="col-md-8 col-sm-12 col-xs-12">
		<div class="columns-holder">
			<?php if(have_posts()): ?>
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* If this is a category archive */ if (is_category()) { ?>
			<h2><?php single_cat_title(); ?></h2>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>			
			<h2><?php printf(__( 'Posts Tagged &#8216;%s&#8217;', 'base' ), single_tag_title('', false)); ?></h2>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2><?php _e('Archive for', 'base'); ?> <?php the_time('F jS, Y'); ?></h2>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2><?php _e('Archive for', 'base'); ?> <?php the_time('F, Y'); ?></h2>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2><?php _e('Archive for', 'base'); ?> <?php the_time('Y'); ?></h2>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2><?php _e('Author Archive', 'base'); ?></h2>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2><?php _e('Blog Archives', 'base'); ?></h2>
			<?php } ?>
			<?php while(have_posts()): the_post(); ?>
				
			<?php 
				 if ( has_post_thumbnail()) {
				  
				   $tn_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-news');
				   $post_img = $tn_image_url[0];
				 } else {
						$post_img = '/wp-content/themes/dopp/images/dopp-mark-img2.png'; 
				 }
			?>
			
			<div class="article-wrap">
					<div class="post-img pull-left img-cir-container hidden-xs">
					<img class="" src="<?php echo $post_img; ?>" width="140px" height="140px"></div>
				
				<div class="article-info">
				<h3><a class="text-primary" style="text-decoration:none;" href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'base'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				
				<p class="info post-info"><strong class="date"><?php the_time('F jS, Y') ?></strong></p>
				<?php the_content(); ?>
				<div class="meta">
				
				
					<ul class="post-comments">
						<li><span class="bold"><?php _e('Posted in', 'base'); ?></span> <?php the_category(', ') ?></li>
						<li><?php comments_popup_link(__('No Comments', 'base'), __('1 Comment', 'base'), __('% Comments', 'base')); ?></li>
						<?php the_tags(__('<li>Tags: ', 'base'), ', ', '</li>'); ?>
					</ul>
				</div>
				</div>
				</div>
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
</div>
<?php get_footer(); ?>
