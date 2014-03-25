<?php

/**
 * Gallery help
 */
function veuse_gallery_add_help_tab($prefix) {
	$screen = get_current_screen();
	if(
		($screen->base == 'post' || $screen->id == '')
	) {
		$screen->add_help_tab( array(
			'id' => 'gallery-help-tab', //unique id for the tab
			'title' => __( 'Image Gallery Panel', 'so-panels' ), //unique visible title for the tab
			'callback' => 'veuse_gallery_add_help_tab_content'
		) );
	}
}

/**
 * Display the content for the help tab.
 */
function veuse_gallery_add_help_tab_content(){
	?>
	<p>
	<?php _e('You can use the Image Gallery panel to create image sliders or an image gallery.', 'veuse'); ?>
	<?php _e('Add images via the button "Select or Upload Images". Hold CTRL on your keyboard to select multiple images.', 'veuse'); ?>
	<?php _e('In "Gallery Settings", enter the appropriate settings for your gallery.', 'veuse'); ?>
	</p>
	<p>
		<?php printf( __( "Read the full documentation on veuse.com.", 'veuse' ), 'http://veuse.com/documentation/' ); ?>
	</p>
	<?php
}

add_action('load-page.php', 'veuse_gallery_add_help_tab');
add_action('load-post.php', 'veuse_gallery_add_help_tab');
add_action('load-page-new.php', 'veuse_gallery_add_help_tab');
add_action('load-post-new.php', 'veuse_gallery_add_help_tab');

/**
 * Add a help tab to pages and posts.
 */
function veuse_video_add_help_tab($prefix) {
	$screen = get_current_screen();
	if(
		($screen->base == 'post' || $screen->id == '')
	) {
		$screen->add_help_tab( array(
			'id' => 'video-help-tab', //unique id for the tab
			'title' => __( 'Video Panel', 'veuse' ), //unique visible title for the tab
			'callback' => 'veuse_video_add_help_tab_content'
		) );
	}
}

/**
 * Vieo help
 */
function veuse_video_add_help_tab_content(){
	?>
	<p>
	<?php _e('You can use the Video panel to insert a featured video on your page or post.', 'veuse') ?>
	<?php _e('First, select if you want to use a self-hosted video or embed a video from an external website like Youtube or Vimeo.', 'veuse') ?>
	<?php _e('If you want to use a self-hosted video, klick on "Select or Upload Files", and select a video file.', 'veuse') ?>
	<?php _e('If you want to embed a video from Youtube or Vimeo, add the url to the video page in the Embed video input field.', 'veuse') ?>
	</p>
	<p>
		<?php printf( __( "Read the full documentation on Veuse.com.", 'so-panels' ), 'http://veuse.com/documentation/' ) ?>
	</p>
	<?php
}

add_action('load-page.php', 'veuse_video_add_help_tab');
add_action('load-post.php', 'veuse_video_add_help_tab');
add_action('load-page-new.php', 'veuse_video_add_help_tab');
add_action('load-post-new.php', 'veuse_video_add_help_tab');