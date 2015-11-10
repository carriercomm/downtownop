<?php get_header(); ?>


<div class="visual">
	
<div class="twocolumns">
	<div id="content">
		<div class="columns-holder">
		<?php
			global $post;
			$permalink = get_permalink( $id );
			$news_headline = get_post_meta($post->ID, "news_headline", true);
			$news_img = the_post_thumbnail('large');
			$news_story = get_post_meta($post->ID, "news_story", true);
			$news_excerpt = get_post_meta($post->ID, "news_excerpt", true);
			
			echo '<h1 class="news-headline">' . $news_headline . '</h1>',
					'<div class="news-img">' . $news_img . '</div>',
					'<div class="news-story">' . $news_story . '</div>';

			?>
</div>
	</div>
	<aside id="sidebar">
	<h2>News</h2>
	<?php $args = array(
	'show_option_all'    => '',
	'orderby'            => 'name',
	'order'              => 'ASC',
	'style'              => 'list',
	'show_count'         => 0,
	'hide_empty'         => 0,
	'use_desc_for_title' => 1,
	'child_of'           => 0,
	'feed'               => '',
	'feed_type'          => '',
	'feed_image'         => '',
	'exclude'            => '',
	'exclude_tree'       => '',
	'include'            => '',
	'hierarchical'       => 1,
	'title_li'           => __( '<h2>News</h2>' ),
	'show_option_none'   => __('No categories'),
	'number'             => null,
	'echo'               => 1,
	'depth'              => 0,
	'current_category'   => 0,
	'pad_counts'         => 0,
	'taxonomy'           => 'categories',
	'walker'             => null
); ?>
	<?php wp_list_categories( $args ); ?>
	</aside>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
