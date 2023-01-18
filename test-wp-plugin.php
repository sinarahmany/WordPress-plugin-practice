<?php

/*
Plugin Name: Test Wp Plugin
Plugin URI: https://sinarahmannejad.com/
Description: A brief description of the Plugin.
Version: 1.0
Author: sinarahmannejad
Author URI: https://sinarahmannejad.com/
License: A "Slug" license name e.g. GPL2
*/

// Add Toolbar Menus
function custom_toolbar() {
    global $wp_admin_bar;

    $args = array(
        'title'  => __( 'my Plugin', 'text_domain' ),
    );
    $wp_admin_bar->add_menu( $args );

}
add_action( 'wp_before_admin_bar_render', 'custom_toolbar', 999 );

// Register oEmbed providers
function instagram_oembed_provider() {

    wp_oembed_add_provider( '#https?://(www.)?instagram.com/p/.*#i', 'http://api.instagram.com/oembed', true );
    wp_oembed_add_provider( '#https?://(www.)?instagr.am/p/.*#i', 'http://api.instagram.com/oembed', true );

}

// Hook into the 'init' action
add_action( 'init', 'instagram_oembed_provider' );




// Add Shortcode
function calendar_shortcode() {

     include 'calendar/index.html';

}
add_shortcode( 'calendar-custom', 'calendar_shortcode' );

include 'setting-page.php';