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
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'modern-journalist' ); ?></a>

	<header id="masthead" class="site-header <?php
						if ( is_single() ) :
							echo "is-single-post";
							else :
								echo "not-a-post";
						endif;
						?> ">
		<div id="site-logo">
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
			<img src="<?php echo get_template_directory_uri(); ?>/img/small-logo.svg" /></a>
		</div>

			<div id="site-title" class="site-branding">
					<img id="header__csis-logo" src="<?php echo get_template_directory_uri(); ?>/img/csis_logo_bw.svg" />
					<div id="header__site-name">Reporting on International Affairs</div>
			</div><!-- .site-branding -->

		<?php
		if ( is_single() ) :
			?>
			<div id="header__post-info">
				<div id="header__page-name">
					<?php
					echo get_the_title(); ?>
				</div>
				<div id="page-navigation">Sections
					<nav>
					</nav>
				</div>
		</div>
			<?php
		endif;
		?>


		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'modern-journalist' ); ?></button>
			<?php
			wp_nav_menu( array(
			    'theme_location' => 'menu-1',
			    'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
