<?php if (!dynamic_loop()) : ?>
	<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>
    <h3><?php the_title(); ?></h3>
    <?php the_content(); ?>
    <?php wp_link_pages(); ?>
    <?php endwhile; ?>
    <?php else: ?>
    <h3><?php _e('Not Found', 'base'); ?></h3>
    <p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'base'); ?></p>
    <?php endif; ?>
    
<?php endif; ?>