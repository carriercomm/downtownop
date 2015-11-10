<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
			<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="/wp-content/themes/dopp/bootstrap/css/bootstrap.css" />
			<!-- Latest compiled and minified JavaScript -->
			<!-- <script src="/wp-content/themes/dopp/bootstrap/js/bootstrap.min.js"></script> -->
			<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
			<!-- JQuery for bootstrap -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link media="all" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/all.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css"  />
        
        <link media="all" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dopp-mobile.css" />
		
		<?php if ( is_singular() ) wp_enqueue_script( 'theme-comment-reply', get_template_directory_uri()."/js/comment-reply.js" ); ?>
		<script type="text/javascript" src="//use.typekit.net/qpw5zyb.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		
		<?php wp_head(); ?>
		<!--[if IE]><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ie.js"></script><![endif]-->
		        
	</head>
	<body <?php body_class( $class ); ?>>
        <div id="wrapper" class="container-fluid">
            <div class="w1">
                <header id="header">
                <h1 class="logo hidden-sm hidden-md hidden-lg"><a href="<?php echo home_url(); ?>"><?php echo bloginfo('name');?></a></h1>

                    <div class="header-bar hidden-xs">
                        <h1 class="logo"><a href="<?php echo home_url(); ?>"><?php echo bloginfo('name');?></a></h1>
                        <?php if(has_nav_menu('top_nav'))
                        wp_nav_menu( array('container' => 'nav','container_class' => 'top-nav',
                             'theme_location' => 'top_nav',
                             'items_wrap' => '<ul>%3$s</ul>') ); ?>
                    </div>
                    <div class="hidden-xs">
                    <?php if(has_nav_menu('primary'))
                        wp_nav_menu( array('container' => 'nav','container_id' => 'nav',
                             'theme_location' => 'primary',
                             'items_wrap' => '<ul>%3$s</ul>',
                             'walker' => new Custom_Walker_Nav_Menu) ); ?>
                    </div>
                    
                </header>
                <div id="mobile-nav" class="visible-xs">
                    <!-- Single button -->
                            <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">MENU</a>
        </div>
        <div class="navbar-collapse collapse in" style="height: auto;">
          
            
              
<?php

$defaults = array(
	'theme_location'  => '',
	'menu'            => 'Mobile',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'nav navbar-nav',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

echo wp_nav_menu( $defaults );

?>
            
          
          
        </div><!-- nav-collapse -->
      </div><!-- container -->
    </div><!-- navbar -->
                    
<!--
                    <div class="btn btn-lg btn-block dropdown">
                        <button class="btn btn-primary btn-block btn-lg">Home</button>
                        <button class="btn btn-primary btn-block btn-lg">Businesses</button>
                    </div>
-->
                    
                    
                    </div><!-- mobile-nav -->
                <div id="main" class="col-md-12">
