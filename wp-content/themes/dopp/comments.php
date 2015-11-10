<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) {
	?> <p><?php _e('This post is password protected. Enter the password to view comments.', 'base'); ?></p> <?php
	return;
}
	
function theme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	
	<li>
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<?php echo get_avatar( $comment, 48 ); ?>
			<p class="meta"><?php comment_date('F d, Y'); ?> <?php _e('at', 'base'); ?> <?php comment_time('g:i a'); ?>, <?php comment_author_link(); ?> <?php _e('said:', 'base'); ?></p>
			<?php if ($comment->comment_approved == '0') : ?>
			<p><?php _e('Your comment is awaiting moderation.', 'base'); ?></p>
			<?php else: ?>
			<?php comment_text(); ?>
			<?php endif; ?>
			
			<?php
				comment_reply_link(array_merge( $args, array(
					'reply_text' => __('Reply', 'base'),
					'before' => '<p>',
					'after' => '</p>',
					'depth' => $depth,
					'max_depth' => $args['max_depth']
				))); ?>
		</div>
	<?php }
	
	function theme_comment_end() { ?>
		</li>
	<?php }
?>

<?php if ( have_comments() ) : ?>

<div class="section comments" id="comments">

	<h2><?php comments_number(__('No Responses', 'base'), __('One Response', 'base'), __('% Responses', 'base') );?> <?php _e('to', 'base'); ?> &#8220;<?php the_title(); ?>&#8221;</h2>

	<ol class="commentlist">
		<?php wp_list_comments(array(
			'callback' => 'theme_comment',
			'end-callback' => 'theme_comment_end'
			)); ?>
	</ol>

	<div class="navigation">
		<div class="next"><?php previous_comments_link(__('&laquo; Older Comments', 'base')) ?></div>
		<div class="prev"><?php next_comments_link(__('Newer Comments &raquo;', 'base')) ?></div>
	</div>

</div>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p><?php _e('Comments are closed.', 'base'); ?></p>

	<?php endif; ?>
	
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div class="section respond">
	<?php comment_form(); ?>
</div>

<?php endif; ?>