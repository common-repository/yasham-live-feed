<?php
//add_action( 'admin_menu', 'yasham_livefeed_add_admin_menu' );

function yslf_yasham_livefeed_settings_init() { 

	register_setting( 'livefeedsettings', 'yasham_livefeed_settings' );

	add_settings_section(
		'yasham_livefeed_pluginPage_section', 
		'', 
		'', 
		'livefeedsettings'
	);

	add_settings_field( 
		'livefeed_appname', 
		__( 'Firebase app name', 'yasham_livefeed' ), 
		'yslf_appname_render', 
		'livefeedsettings', 
		'yasham_livefeed_pluginPage_section' 
	);

	add_settings_field( 
		'livefeed_apicode', 
		__( 'Firebase API code', 'yasham_livefeed' ), 
		'yslf_apicode_render', 
		'livefeedsettings', 
		'yasham_livefeed_pluginPage_section' 
	);

	add_settings_field( 
		'livefeed_headerid', 
		__( 'Header ID', 'yasham_livefeed' ), 
		'yslf_headerid_render', 
		'livefeedsettings', 
		'yasham_livefeed_pluginPage_section' 
	);

	add_settings_field( 
		'livefeed_textcolor', 
		__( 'Text color', 'yasham_livefeed' ), 
		'yslf_textcolor_render', 
		'livefeedsettings', 
		'yasham_livefeed_pluginPage_section' 
	);

	add_settings_field( 
		'livefeed_bgcolor', 
		__( 'Background color', 'yasham_livefeed' ), 
		'yslf_bgcolor_render', 
		'livefeedsettings', 
		'yasham_livefeed_pluginPage_section' 
	);
}

function yslf_appname_render(  ) { 
	$options = get_option( 'yasham_livefeed_settings' ); ?>
	<input type='text' name='yasham_livefeed_settings[livefeed_appname]' placeholder='AIzaSyBWtCxxxxxxxxxxxxxxxH-KesmprVks' value='<?php echo $options['livefeed_appname']; ?>'>
	<?php

}

function yslf_apicode_render(  ) { 
	$options = get_option( 'yasham_livefeed_settings' ); ?>
	<input type='text' name='yasham_livefeed_settings[livefeed_apicode]' placeholder='appname-00000' value='<?php echo $options['livefeed_apicode']; ?>'>
	<?php

}

function yslf_headerid_render(  ) { 
	$options = get_option( 'yasham_livefeed_settings' ); ?>
	<input type='text' name='yasham_livefeed_settings[livefeed_headerid]' placeholder='#header-id' value='<?php echo $options['livefeed_headerid']; ?>'>
	<?php
}

function yslf_textcolor_render(  ) { 
	$options = get_option( 'yasham_livefeed_settings' ); ?>
	<input class="livefeed-color-field" type='text' name='yasham_livefeed_settings[livefeed_textcolor]' value='<?php echo $options['livefeed_textcolor']; ?>'>
	<?php
}

function yslf_bgcolor_render(  ) { 
	$options = get_option( 'yasham_livefeed_settings' ); ?>
	<input class="livefeed-color-field" type='text' name='yasham_livefeed_settings[livefeed_bgcolor]' value='<?php echo $options['livefeed_bgcolor']; ?>'
	<?php
}

function yslf_settings_html(){ ?>
	<form action='options.php' method='post'>
		<h1><?php _e( 'Livefeed settings', 'yasham_livefeed' ) ?></h1>
		<h2><?php _e( 'Manage live feed settings', 'yasham_livefeed' ); ?></h2>
		<h3><?php echo "support: info@yashamturk.com"; ?></h3>
		<?php
		settings_fields( 'livefeedsettings' );
		do_settings_sections( 'livefeedsettings' );
		submit_button();
		?>
	</form>
	<script>
	jQuery(document).ready(function($){
		$('.livefeed-color-field').wpColorPicker();
	});
</script>
	<?php
}