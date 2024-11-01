<?php
/*
Plugin Name: YASHAM LIVE FEED
Plugin URI:  https://yashamturk.com
Description: YASHAM TURK LIVE FEED
Version:     1.0
Author:      yashamturk.com
*/

//load php files
include( plugin_dir_path( __FILE__ ) . 'functions.php');
include( plugin_dir_path( __FILE__ ) . 'includes/addfeed.php');
include( plugin_dir_path( __FILE__ ) . 'includes/feedsettings.php');

//load custom css
//add_action('init','apply_style_livefeed');

//prepare menu
add_action('admin_menu', 'yslf_yashamlivefeed_menu_pages');

//add bar to front-end
add_action( 'wp_footer', 'yslf_my_front_end_bar');
load_plugin_textdomain( 'yasham_livefeed', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' ); 

//init settings
add_action( 'admin_init', 'yslf_yasham_livefeed_settings_init' );

register_activation_hook( __FILE__, function(){
	$get_feed_options = get_option( 'yslf_yasham_livefeed_settings' );
    // Update just the one option you passed in
    $get_feed_options['livefeed_textcolor'] = "#ffffff";
    $get_feed_options['livefeed_bgcolor'] = "#dd3333";
    // Save to wp_options
    update_option('yslf_yasham_livefeed_settings',$get_feed_options);
});
?>