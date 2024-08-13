<?php

/*
Plugin Name:  Garbo product feeds
Plugin URI:   https://www.garbo.nl
Description:  Garbo product feeds
Version:      1.0
Author:       Garbo
Author URI:   https://www.garbo.nl
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  garbo_product_feeds
Domain Path:  /languages
*/

add_action( 'init', 'wpse9870_init_external' );
function wpse9870_init_external()
{
    global $wp_rewrite;
    $plugin_url = plugins_url( 'feed.php', __FILE__ );
    $plugin_url = substr( $plugin_url, strlen( home_url() ) + 1 );

    // The pattern is prefixed with '^'
    // The substitution is prefixed with the "home root", at least a '/'
    // This is equivalent to appending it to `non_wp_rules`
    $wp_rewrite->add_external_rule( 'products-xml/$', $plugin_url );
}