<?php get_header(); ?>

<div class="twocolumns">
	<div id="content">
		<div class="columns-holder">
			<?php if(have_posts()): ?>
			<?php while(have_posts()): the_post(); ?>
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'base'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			<p class="info"><strong class="date"><?php the_time('F jS, Y') ?></strong> <?php _e('by', 'base'); ?> <?php the_author(); ?></p>
			<?php the_excerpt(); ?>
			<div class="meta">
				<ul>
					<li><?php _e('Posted in', 'base'); ?> <?php the_category(', ') ?></li>
					<li><?php comments_popup_link(__('No Comments', 'base'), __('1 Comment', 'base'), __('% Comments', 'base')); ?></li>
					<?php the_tags(__('<li>Tags: ', 'base'), ', ', '</li>'); ?>
				</ul>
			</div>
			<?php endwhile; ?>
			
			<div class="navigation">
				<div class="next"><?php next_posts_link(__('Older Entries &raquo;', 'base')) ?></div>
				<div class="prev"><?php previous_posts_link(__('&laquo; Newer Entries', 'base')) ?></div>
			</div>
			
			<?php else: ?>
			<h3><?php _e('Not Found', 'base'); ?></h3>
			<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'base'); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
