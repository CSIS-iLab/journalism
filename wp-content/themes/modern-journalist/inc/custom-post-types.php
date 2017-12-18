<?php
/**
* Custom Post Types
*
*@package Modern-Journalism
*/

/*----------  Themes  ----------*/
require get_template_directory() . '/inc/cpts/themes.php';

/*----------  Testimonials  ----------*/
//require get_template_directory() . '/inc/cpts/testimonials.php';

/*----------  Pages  ----------*/
add_post_type_support( 'page', 'excerpt' );