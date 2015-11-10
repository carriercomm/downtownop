<?php if(have_posts()): ?>
			<?php while(have_posts()): the_post(); ?>
			<h3><?php the_title(); ?></h3>
			<p class="info"><strong class="date"><?php the_time('F jS, Y') ?></strong> <?php _e('by', 'base'); ?> <?php the_author(); ?></p>
			<?php the_content(); ?>
			<div class="meta">
				<ul>
					<li><?php _e('Posted in', 'base'); ?> <?php the_category(', ') ?></li>
					<li><?php comments_popup_link(__('No Comments', 'base'), __('1 Comment', 'base'), __('% Comments', 'base')); ?></li>
					<?php the_tags(__('<li>Tags: ', 'base'), ', ', '</li>'); ?>
				</ul>
			</div>
			<?php comments_template(); ?>
			<?php endwhile; ?>
			
			<div class="navigation">
				<div class="next"><?php previous_post_link(__('%link &raquo;', 'base')) ?></div>
				<div class="prev"><?php next_post_link(__('&laquo; %link', 'base')) ?></div>
			</div>
			
			<?php else: ?>
			<h3><?php _e('Not Found', 'base'); ?></h3>
			<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'base'); ?></p>
<?php endif; ?>