<?php
/*
Template Name: Home Template
*/
get_header(); ?>

<div id="main">
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
            <?php $img_description ?>
        </div>
        <?php } ?>
    </div>
    <?php endif; ?>
    <?php if(is_active_sidebar('social-bar-sidebar')) dynamic_sidebar('social-bar-sidebar'); ?>
    <div class="twocolumns">
        <div id="content">
            <div class="columns-holder">
                <?php query_posts('cat='.newsCategoryID.'&showposts=-1'); ?>
                <?php if(have_posts()): ?>
                <section class="column news">
                    <?php while(have_posts()): the_post(); ?>
                    <h2><a href="#">News</a></h2>
                    <?php if(has_post_thumbnail()): ?>
                    <div class="img-holder">
                        <?php the_post_thumbnail('news_post_thumbnail'); ?>
                    </div>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <?php the_excerpt(); ?>
                    <a class="link" href="<?php the_permalink(); ?>">Full Details</a>
                    <?php endwhile; ?>
                </section>
                <?php endif; ?>
                <?php wp_reset_query();?>
                <section class="column">
                    <h2><a href="#">Latest Events</a></h2>
                    <div class="img-holder">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/img03.jpg" width="264" height="144" alt="image description">
                    </div>
                    <h3>Free Downtown Coupon Books</h3>
                    <p>While you're at the Farmers' Market on Saturday, pick up a Downtown coupon book at the information table. Hurry . . . many of the offers are good just through October.</p>
                    <p>Download a 2013 event schedule.</p>
                    <p>Take a look at what's in store for you this year. Farmers' Market entertainment and programs are subject to change.</p>
                </section>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
