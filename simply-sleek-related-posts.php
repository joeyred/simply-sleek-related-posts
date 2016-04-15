<?php
/**
 * Simply Sleek Related Posts
 *
 * @package   SSRP
 * @author    Joey Hayes
 * @copyright 2016 Joey Hayes
 * @license   GPL-3.0+
 * @link      https://github.com/joeyred/simply-sleek-related-posts
 *
 * @wordpress-plugin
 * Plugin Name:       Simply Sleek Related Posts
 * Plugin URI:       	https://github.com/joeyred/simply-sleek-related-posts
 * Description:      	A simple, yet sleek and stylish plugin for adding related posts to a page as a widget.
 * Version:          	0.0.1
 * Author:           	Joey Hayes
 * Author URI:       	https://github.com/joeyred
 * Text Domain:      	simply-sleek-related-posts
 * License:          	GPL-3.0+
 * License URI:      	http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/joeyred/simply-sleek-related-posts
 */


require( 'inc/functions.php' );
require( 'inc/admin.php' );
require( 'inc/front-end.php' );
require( 'inc/widget.php' );

add_action( 'wp_enqueue_scripts', 'ssrp_enqueue' );
function ssrp_enqueue() {

  if ( ssrp_which_markup() === 'ssrp' ) {
    wp_enqueue_style( 'ssrp_main', plugins_url( 'simply-sleek-related-posts/css/ssrp.css' ) );
  } elseif ( ssrp_which_markup() === 'bootstrap' ) {
    wp_enqueue_style( 'ssrp_bootstrap', plugins_url( 'simply-sleek-related-posts/css/ssrp-bootstrap.css' ) );
  } elseif ( ssrp_which_markup() === 'foundation5' ) {
    wp_enqueue_style( 'ssrp_foundation5', plugins_url( 'simply-sleek-related-posts/css/ssrp-foundation5.css' ) );
  } elseif ( ssrp_which_markup() === 'foundation6' ) {
    wp_enqueue_style( 'ssrp_foundation6', plugins_url( 'simply-sleek-related-posts/css/ssrp-foundation6.css' ) );
  }

  wp_enqueue_script( 'ssrp_main_js', plugins_url( 'simply-sleek-related-posts/js/ssrp.js' ), array( 'jquery' ), '', true );
}
