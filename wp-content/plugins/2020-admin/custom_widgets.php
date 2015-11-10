<?php

$remove_defaults_widgets = array(
    'dashboard_incoming_links' => array(
        'page'    => 'dashboard',
        'context' => 'normal'
    ),
    'dashboard_right_now' => array(
        'page'    => 'dashboard',
        'context' => 'normal'
    ),
    'dashboard_recent_drafts' => array(
        'page'    => 'dashboard',
        'context' => 'side'
    ),
    'dashboard_quick_press' => array(
        'page'    => 'dashboard',
        'context' => 'side'
    ),
    'dashboard_plugins' => array(
        'page'    => 'dashboard',
        'context' => 'normal'
    ),
    'dashboard_primary' => array(
        'page'    => 'dashboard',
        'context' => 'side'
    ),
    'dashboard_secondary' => array(
        'page'    => 'dashboard',
        'context' => 'side'
    ),
    'dashboard_recent_comments' => array(
        'page'    => 'dashboard',
        'context' => 'normal'
    )
);

$custom_dashboard_widgets = array(
    'my-dashboard-widget' => array(
        'title' => 'My Dashboard Widget',
        'callback' => 'dashboardWidgetContent'
    )
);

function dashboardWidgetContent()
{
    $user = wp_get_current_user();
    echo 'Hello <strong>' . $user->user_login . '</strong>, this is your custom widget. You can for instance list all the posts you\'ve published:';
 
    $r = new WP_Query( apply_filters( 'widget_posts_args', array(
        'posts_per_page' => 10,
        'post_status' => 'publish',
        'author' => $user->ID ) ) );
 
    if ($r->have_posts()) : ?>
    <ul>
    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
        <li>
            <?php edit_post_link(get_the_title());?>
        </li>
    <?php endwhile; ?>
    </ul>
    <?php endif;
}