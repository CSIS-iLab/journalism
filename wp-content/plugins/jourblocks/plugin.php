<?php
/**
 * Plugin Name: Jourblocks
 * Plugin URI:
 * Description: A Gutenberg plugin created for the CSIS website "Reporting on International Affairs".
 * Author: iDeas Lab, CSIS
 * Author URI:
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
