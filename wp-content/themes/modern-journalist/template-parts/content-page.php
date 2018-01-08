<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Modern_Journalist
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title('<h1 class="page-title underline">', '</h1>'); ?>
	</header><!-- .entry-header -->

	<div class="entry-content col-wide">
		<?php
			the_content();


		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
