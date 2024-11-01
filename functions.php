<?php
/**
function yslf_apply_style_livefeed(){
	wp_enqueue_style( 'yashamlivefeed-style', plugins_url('/styles/livefeed-style.css', __FILE__) );
}
**/

function yslf_yashamlivefeed_menu_pages(){
    add_menu_page(
		__( 'Live Feed', 'yasham_livefeed' ),
		__( 'Live Feed', 'yasham_livefeed' ),
		'publish_posts',
		'add_feed',
		'yslf_add_html',
        'dashicons-welcome-widgets-menus',
        24
	);

	add_submenu_page(
        'add_feed',
        'Add Feed',
        __( 'Add Feed', 'yasham_livefeed' ),
        'publish_posts',
        'add_feed',
        'yslf_add_html'
    );
	
	add_submenu_page(
        'add_feed',
        'Settings',
        __( 'Settings', 'yasham_livefeed' ),
        'publish_posts',
        'settings_feed',
        'yslf_settings_html'
    );
}

function yslf_my_front_end_bar() {
    if ( !is_admin() ) {
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('firebase_app', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-app.js', array(), 7, false);
		wp_enqueue_script('firebase_auth', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-auth.js', array(), 7, false);
		wp_enqueue_script('firebase_database', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-database.js', array(), 7, false);
		wp_enqueue_script('firebase_firestore', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-firestore.js', array(), 7, false);
		wp_enqueue_script('firebase_firestore', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-firestore.js', array(), 7, false);
	
		$feed_options = get_option( 'yasham_livefeed_settings' );
		echo '<script>var livefeed_appname="'.$feed_options['livefeed_appname'].'";</script>';
		echo '<script>var livefeed_apicode="'.$feed_options['livefeed_apicode'].'";</script>';
		echo '<script>var livefeed_headerid="'.$feed_options['livefeed_headerid'].'";</script>';
		echo '<script>var livefeed_textcolor="'.$feed_options['livefeed_textcolor'].'";</script>';
		echo '<script>var livefeed_bgcolor="'.$feed_options['livefeed_bgcolor'].'";</script>';
		
		$csts_lst = get_the_category();
		$cats_parents_lst = '';
		
		if(is_singular()){
			foreach($csts_lst as $single_cat)
			{
				if($single_cat->parent == 0){
					$cats_parents_lst = $cats_parents_lst . $single_cat->term_id . ',';
				}
			}
			$cats_parents_lst = rtrim($cats_parents_lst, ",");
			echo '<script>var cats_lst="'.$cats_parents_lst.'";</script>';
			echo '<script>var is_single=true;</script>';
		}else{
			$main_cat_id = '';
			$cur_cat_id = get_query_var('cat');
			$child = get_category($cur_cat_id);
			$main_cat_id = $child->parent;
			if($child->parent == 0){
				$main_cat_id = $child->term_id;
			}
			echo '<script>var cats_lst="'.$main_cat_id.'";</script>';
			echo '<script>var is_single=false;</script>';
		}
		wp_enqueue_style( 'yashamlivefeed-style-2', plugins_url('/styles/livefeed-style-frontend.css', __FILE__) );
		wp_enqueue_script('firebase_addfeed', plugins_url( 'js/frontendfeed.js',__FILE__ ), array(), 7, false);
    }
}