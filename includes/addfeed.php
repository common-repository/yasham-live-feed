<?php

function yslf_add_html(){
	
	if (!current_user_can('manage_options')) {
        return;
    }
	
	$feed_options = get_option( 'yasham_livefeed_settings' );
	echo '<script>var livefeed_appname="'.$feed_options['livefeed_appname'].'";</script>';
	echo '<script>var livefeed_apicode="'.$feed_options['livefeed_apicode'].'";</script>';
	echo '<script>var livefeed_headerid="'.$feed_options['livefeed_headerid'].'";</script>';
	echo '<script>var livefeed_textcolor="'.$feed_options['livefeed_textcolor'].'";</script>';
	echo '<script>var livefeed_bgcolor="'.$feed_options['livefeed_bgcolor'].'";</script>';
		
    wp_enqueue_script('firebase_app', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-app.js', array(), 7, false);
    wp_enqueue_script('firebase_auth', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-auth.js', array(), 7, false);
    wp_enqueue_script('firebase_database', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-database.js', array(), 7, false);
    wp_enqueue_script('firebase_firestore', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-firestore.js', array(), 7, false);
    wp_enqueue_script('firebase_firestore', 'https://www.gstatic.com/firebasejs/7.8.2/firebase-firestore.js', array(), 7, false);
    wp_enqueue_script('firebase_addfeed', plugin_dir_url( __DIR__ ) . 'js/addfeed.js', array(), 7, false);
    wp_enqueue_style('firebase_addfeed', plugin_dir_url( __DIR__ ) . 'styles/livefeed-style.css', array(), 7, false);
	
	?>
	<h1><?php _e( 'Publish Feed', 'yasham_livefeed' ) ?></h1>
	<h2><?php _e( 'From here you can publish your feeds to categories and posts', 'yasham_livefeed' ); ?></h2>
	
	<div class="category_list">
		<?php 
			$defaults = array(
				'show_option_all'   => '',
				'show_option_none'  => '',
				'orderby'           => 'id',
				'order'             => 'ASC',
				'show_count'        => 0,
				'hide_empty'        => 1,
				'child_of'          => 0,
				'exclude'           => '',
				'echo'              => 1,
				'selected'          => 1,
				'hierarchical'      => 1,
				'name'              => 'cat_feed_lst',
				'id'                => 'cat_feed_lst',
				'class'             => 'postform yasham_feed_cats',
				'depth'             => 1,
				'tab_index'         => 0,
				'taxonomy'          => 'category',
				'hide_if_empty'     => true,
				'option_none_value' => -1,
				'value_field'       => 'term_id',
				'required'          => false,
			);
			
			?>
		<div style="margin-bottom: 5px;" class="list_sub_div">
			<lable style="margin-bottom: 10px;"><?php _e( 'Select feed category: ', 'yasham_livefeed' ); ?></lable>
			<?php wp_dropdown_categories( $defaults ); ?>
		</div>

		<div class="list_sub_div final">
			<input type="button" class="danger_btn" onclick="clear_feed()" value="<?php _e( 'Clear this only', 'yasham_livefeed' ); ?>">
			<input type="button" class="danger_btn" onclick="clear_feed_all()" value="<?php _e( 'Clear all', 'yasham_livefeed' ); ?>">
		</div>
		
		<!--
		<div class="list_sub_div" style="display:none;">
			<lable><?php _e( 'Feed url: ', 'yasham_livefeed' ); ?></lable>
			<input id="feed_url" name="feed_url" type="text" placeholder="https://domain.com/"/>
		</div>
		-->
		
		<div class="list_sub_div">
			<lable><?php _e( 'Feed message: ', 'yasham_livefeed' ); ?></lable>
			<!--<textarea id="feed_msg" name="feed_msg" type="text" placeholder="Write your feed text here..."></textarea>-->
			<?php
					wp_editor( '' , 'feed_msg', array(
						'wpautop'       => false,
						'media_buttons' => false,
						'textarea_name' => 'feed_msg',
						'editor_class'  => 'feed_msg',
						'textarea_rows' => 10
					) );
			?>
		</div>
		<div class="list_sub_checkbox">
			<input type="checkbox" id="inposts" name="inposts" value="showinposts">
			<label for="inposts"><?php _e( 'Show in posts', 'yasham_livefeed' ); ?></label><br>
		</div>		
		<div class="list_sub_div final">
			<input type="button" value="<?php _e( 'Publish', 'yasham_livefeed' ); ?>" onclick="send_feed()">
		</div>
	</div>
	<?php
}