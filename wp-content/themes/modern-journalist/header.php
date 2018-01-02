<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Modern_Journalist
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'modern-journalist' ); ?></a>

	<header id="masthead" class="site-header">
		<div class=" flex-container">
			
			<div class="header-top">
				<div class="site-branding ">
					<div class="large-logo">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) : ?>
					<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php else : ?>
						<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php
					endif;
					?>
					</div>
					<div class="small-logo">
						<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/small-logo.svg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>"></a>
				
					</div>
				</div><!-- .site-branding -->
				
				<nav id="site-navigation" class="main-navigation"> <div id="mobile-menu"><i class="icon-menu"></i><i class="icon-close"></i></div>

					<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'modern-journalist' ); ?></button> -->
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
					?>
				</nav><!-- #site-navigation -->
			</div><!-- header-top -->
	
			
				<?php
	            if ( is_single() ) {
	                get_template_part( 'components/header-post-header' );
	            } else { ?>
	            	
				<div class="header-bottom">
	             <img src="<?php echo get_template_directory_uri(); ?>/img/csis_logo_bw.svg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>">
	    		</div><!-- header-bottom -->
				<?php 
	            }
				?>
	       
	        
		</div><!-- #content-wrapper -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
