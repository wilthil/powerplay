<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'veuse_';


global $meta_boxes;

$meta_boxes = array();


$subnav_default = isset($options['default_subnav']) ? 1 : 0;


$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'standard',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Page Elements', 'rwmb' ),

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'page'),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// Auto save: true, false (default). Optional.
	'autosave' => false,

	// List of meta fields
	'fields' => array(
	

		
		
		// CHECKBOX LIST
		
		array(
			'name' => __( 'Select the elements you want to show on your page or post. At least one element needs to be enabled.', 'rwmb' ),
			'desc' => __('<p>PS! Featured video does not work on pages using the Page Builder by SiteOrigin. Use the video-widget instead.</p>'),
			'id'   => "{$prefix}page_elements",
			'type' => 'checkbox_list',
			'std'   => array('title','content'),
			'options' => array(
				'title' 	=> __( 'Title', 'rwmb' ),
				'excerpt' 	=> __( 'Excerpt', 'rwmb' ),
				'content'	=> __( 'Content', 'rwmb' ),
				'submenu' 	=> __( 'Submenu', 'rwmb' ),
				'image' 	=> __( 'Featured image', 'rwmb' ),
				'gallery' 	=> __( 'Featured gallery', 'rwmb' ),
				'video' 	=> __( 'Featured video', 'rwmb' )
			),
		),
				
			
	
		
	),
	
);


// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'gallery',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Featured Gallery', 'rwmb' ),

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'post', 'page', 'portfolio'),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// Auto save: true, false (default). Optional.
	'autosave' => false,

	// List of meta fields
	'fields' => array(
			
		
		// HEADING
		array(
			'type' => 'heading',
			'name' => __( 'Gallery images', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
	
		// IMAGE ADVANCED (WP 3.5+)
		array(
			'name'             => __( 'Select or upload images to display in gallery.<br><br>Images can be rearranged via drag and drop.', 'rwmb' ),
			'desc'  => __( '', 'rwmb' ),
			'id'               => "{$prefix}page_gallery",
			'type'             => 'image_advanced',
			'max_file_uploads' => 100,
		),
		
		// HEADING
		array(
			'type' => 'heading',
			'name' => __( 'Gallery settings', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		
		// RADIO BUTTONS
		array(
			'name'    => __( 'Gallery layout', 'rwmb' ),
			'id'      => "{$prefix}gallery_type",
			'type'    => 'radio',
			
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'slideshow' => __( 'Display as slideshow', 'rwmb' ),
				'thumbnails' => __( 'Display as thumbnails in a grid', 'rwmb' ),
			),
			'std'	=> 'slideshow',
		),
		
		// NUMBER
		array(
			'name' => __( 'Columns for grid view', 'rwmb' ),
			'desc' => __( 'Number of columns for thumbnail layout', 'rwmb' ),
			'id'   => "{$prefix}gallery_grid",
			'type' => 'number',
			'std'  => 3,
			'min'  => 2,
			'max'  => 5,
			'step' => 1,
		),
		
		// CHECKBOX
		array(
			'name' => __( 'Lightbox', 'rwmb' ),
			'desc' => __( 'Open lightbox when you click on the image', 'rwmb' ),
			'id'   => "{$prefix}gallery_lightbox",
			'type' => 'checkbox',
			'std'  => 1,
		),
		
		// CHECKBOX
		array(
			'name' => __( 'Title', 'rwmb' ),
			'desc' => __( 'Show image title', 'rwmb' ),
			'id'   => "{$prefix}gallery_image_title",
			'type' => 'checkbox',
			'std'  => 0,
		),
		
		// CHECKBOX
		array(
			'name' => __( 'Caption', 'rwmb' ),
			'desc' => __( 'Show image description', 'rwmb' ),
			'id'   => "{$prefix}gallery_image_description",
			'type' => 'checkbox',
			'std'  => 0,
		),
		
	
		
				
		
	
	),
	
);


// Audio meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'audio',
	'title' => __( 'Post audio', 'rwmb' ),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => false,
	'fields' => array(
	
		
		array(
			'type' => 'heading',
			'name' => __( 'Source', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		// RADIO BUTTONS
		array(
			'name'    => __( 'Audio source', 'rwmb' ),
			'id'      => "{$prefix}audio_src",
			'type'    => 'radio',
			
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'self' => __( 'Self-hosted audio', 'rwmb' ),
				'embed' => __( 'Embed audio', 'rwmb' ),
			),
			'std'	=> 'self',
		),

		// HEADING
		array(
			'type' => 'heading',
			'name' => __( 'Self-hosted audio', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		
		
		// FILE ADVANCED (WP 3.5+)
		array(
			'name' => __( 'Select audio-files from media-library, or upload audio-files.', 'rwmb' ),
			'id'   => "{$prefix}audio_files",
			'type' => 'file_advanced',
			'max_file_uploads' => 4,
			'mime_type' => 'audio', // Leave blank for all file types
		),
		
		// HEADING
		array(
			'type' => 'heading',
			'name' => __( 'Embedded audio', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		
		// URL
		array(
			'name'  => __( 'Embed audio', 'rwmb' ),
			'id'    => "{$prefix}audio_embed",
			'desc'  => __( 'Enter URL to the audiofile you want to embed.', 'rwmb' ),
			'type'  => 'url',
			'std'   => '',
		),
				
	),
	
);


// Audio meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'video',
	'title' => __( 'Featured Video', 'rwmb' ),
	'pages' => array( 'post','page','portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => false,
	'fields' => array(
	
				array(
			'type' => 'heading',
			'name' => __( 'Source', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),

	
		// RADIO BUTTONS
		array(
			'name'    => __( 'Video source', 'rwmb' ),
			'id'      => "{$prefix}video_src",
			'type'    => 'radio',
			
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'self' => __( 'Self-hosted video', 'rwmb' ),
				'embed' => __( 'Embed video', 'rwmb' ),
			),
			'std'	=> 'self',
		),

		// HEADING
		array(
			'type' => 'heading',
			'name' => __( 'Self-hosted video', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		
		
		// FILE ADVANCED (WP 3.5+)
		array(
			'name' => __( 'Select video-files from media-library, or upload video-files.', 'rwmb' ),
			'id'   => "{$prefix}video_files",
			'type' => 'file_advanced',
			'max_file_uploads' => 4,
			'mime_type' => 'video', // Leave blank for all file types
		),
		
		// HEADING
		array(
			'type' => 'heading',
			'name' => __( 'Embedded video', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		
		// URL
		array(
			'name'  => __( 'Embed video', 'rwmb' ),
			'id'    => "{$prefix}video_embed",
			'desc'  => __( 'Enter URL to the videofile you want to embed.', 'rwmb' ),
			'type'  => 'url',
			'std'   => '',
		),
				
	),
	
);


function all_rev_sliders_in_array(){
    if (class_exists('RevSlider')) {
        $theslider     = new RevSlider();
        $arrSliders = $theslider->getArrSliders();
        $arrA     = array();
        $arrT     = array();
        foreach($arrSliders as $slider){
            $arrA[]     = $slider->getAlias();
            $arrT[]     = $slider->getTitle();
        }
        if($arrA && $arrT){
            $result = array_combine($arrA, $arrT);
        }
        else
        {
            $result = false;
        }
        return $result;
    }
}

$revsliders = all_rev_sliders_in_array();

// Audio meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'revslider',
	'title' => __( 'Revolution slider', 'rwmb' ),
	'pages' => array( 'page','post' ),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => false,
	'fields' => array(
	
	

		// HEADING
		array(
			'type' => 'heading',
			'name' => __( 'Select a slider', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		
		
		// SELECT BOX
		
		array(
			'name'     => __( 'Select a slider', 'rwmb' ),
			'id'       => "{$prefix}revolution_slider",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $revsliders,
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => '',
			'placeholder' => __( 'Select a slider', 'rwmb' ),
		),
		
				
	),
	
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function veuse_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'veuse_register_meta_boxes',5 );
