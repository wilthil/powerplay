<?php 
if(!is_admin()){

	function wp_admin_bar_new_item() {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu(array(
		'id' => 'screen-mobile-p',
		'title' => '<i class="fa fa-mobile"></i>',
		'href' => '#',
		'meta' =>  array( 'title' => __('Mobile portrait','veuse') )
		));
		
		$wp_admin_bar->add_menu(array(
		'id' => 'screen-mobile-l',
		'title' => '<i class="fa fa-mobile fa-rotate-90"></i>',
		'href' => '#',
		'meta' =>  array( 'title' => __('Mobile landscape','veuse') )
		));
		
		
		$wp_admin_bar->add_menu(array(
		'id' => 'screen-tablet-p',
		'title' => '<i class="fa fa-tablet"></i>',
		'href' => '#',
		'meta' =>  array( 'title' => __('Tablet portrait','veuse') )
		));
		
		$wp_admin_bar->add_menu(array(
		'id' => 'screen-tablet-l',
		'title' => '<i class="fa fa-tablet fa-rotate-90"></i>',
		'href' => '#',
		'meta' =>  array( 'title' => __('Tablet landscape','veuse') )
		));
		
		$wp_admin_bar->add_menu(array(
		'id' => 'screen-desktop',
		'title' => '<i class="fa fa-desktop"></i>',
		'href' => '#',
		'meta' =>  array( 'title' => __('Desktop','veuse') )
		));
	}
	
	add_action('wp_before_admin_bar_render', 'wp_admin_bar_new_item');
}


require_once(get_stylesheet_directory().'/includes/documentation/documentation.php');

require_once(get_stylesheet_directory().'/framework/functions.php');
require_once(get_stylesheet_directory().'/includes/contextual-help.php');

require_once(get_stylesheet_directory().'/includes/compat-pagebuilder.php');
require_once(get_stylesheet_directory().'/includes/compat-woocommerce.php');

// Add SoundCloud oEmbed
function add_oembed_soundcloud(){
	wp_oembed_add_provider( 'http://soundcloud.com/*', 'http://soundcloud.com/oembed' );
}
//add_action('init','add_oembed_soundcloud');


// options
$tmpl_opt  = get_stylesheet_directory() . '/admin/option/option.php';


remove_filter('the_content', 'veuse_portfolio_filter_content', 1);


if(class_exists('ReduxFramework'))
require_once(dirname(__FILE__).'/options-config.php');

 

if ( ! isset( $content_width ) )
	$content_width = 1140;
	
define('VEUSE_CONTENT_WIDTH',$content_width);
define('VEUSE_ARTICLE_WIDTH', round($content_width * .75));
define('VEUSE_FULLWIDTH_ARTICLE_WIDTH', $content_width);



/**
 * If more than one page exists, return TRUE.
 */
if(!function_exists('show_posts_nav')){
	function show_posts_nav() {
		global $wp_query;
		return ($wp_query->max_num_pages > 1);
	}
}






/* 	===============================================================

	ENQUEUE SCRIPTS

===================================================================*/

function veuse_enqueue_styles(){

	wp_register_style( 'main-styles',  get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );
	wp_enqueue_style( 'main-styles' );
		
	wp_register_style( 'normalize',  get_stylesheet_directory_uri() . '/css/normalize.css', array(), '', 'all' );
	wp_enqueue_style( 'normalize' );
		
	wp_register_style( 'foundation',  get_stylesheet_directory_uri() . '/css/foundation.css', array(), '', 'all' );
	wp_enqueue_style( 'foundation' );
	

	
	/* Enque custom skin */
	/*
	global $veuse;
	
	if($veuse['stylesheet']){
		wp_register_style( 'veuse-custom-skin',  get_stylesheet_directory_uri().'/css/skins/'.$veuse['stylesheet'] , array(), '', 'all' );
		wp_enqueue_style( 'veuse-custom-skin' );
	}
	*/
	
}

add_action('wp_enqueue_scripts', 'veuse_enqueue_styles',100);



if(!function_exists('veuse_footer_scripts')){
	function veuse_footer_scripts(){
		?>
		<script>
		jQuery(document).foundation();
		</script>
		<?php
	}
	add_action('wp_footer', 'veuse_footer_scripts',50);
}


function veuse_enqueue_script(){
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', get_stylesheet_directory_uri()  . '/js/vendor/custom.modernizr.js', array('jquery'), '', false);
	wp_enqueue_script('foundation', get_stylesheet_directory_uri()  . '/js/foundation/foundation.js', array('jquery'), '', true);
	//wp_enqueue_script('foundation-tooltips', get_stylesheet_directory_uri() . '/js/foundation/foundation.tooltips.js', array('jquery'), '', true);
	wp_enqueue_script('foundation-interchange', get_stylesheet_directory_uri() . '/js/foundation/foundation.interchange.js', array('jquery'), '', true);
	//wp_enqueue_script('foundation-section', get_stylesheet_directory_uri() . '/js/foundation/foundation.section.js', array('jquery'), '', true);
	wp_enqueue_script('flexslider', get_stylesheet_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '', true);
	wp_enqueue_script('magnific', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), '', true);
	wp_enqueue_script('fitvids', get_stylesheet_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '', true);
	wp_enqueue_script('superfish', get_stylesheet_directory_uri() . '/js/superfish.js', array('jquery'), '', true);
	wp_enqueue_script('waypoints', get_stylesheet_directory_uri() . '/js/waypoints.min.js', array('jquery'), '', true);
	//wp_enqueue_script('salvattore', get_stylesheet_directory_uri() . '/js/salvattore.min.js', array('jquery'), '', true);
	wp_enqueue_script('theme-scripts', get_stylesheet_directory_uri() . '/js/theme-scripts.js', array('jquery'), '', true);
	wp_enqueue_script('flexslider', get_stylesheet_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '', true);

	if ( is_singular() ) 
		wp_enqueue_script( "comment-reply" );

}

add_action('wp_enqueue_scripts', 'veuse_enqueue_script');


function veuse_admin_enqueue_scripts(){
	
	
	wp_enqueue_script('veuse-admin', get_stylesheet_directory_uri()  . '/js/admin.js', array('jquery'), '', false);
	
}

add_action('admin_enqueue_scripts', 'veuse_admin_enqueue_scripts');


/**

	Register widgetized areas 
	
*/

function veuse_widgets_init() {

	$sidebars = array(
	
		'default_sidebar' => 'Default Sidebar',
		//'page_sidebar_1' => 'Page Sidebar 1',
		//'page_sidebar_2' => 'Page Sidebar 2',
		//'blog_sidebar' => 'Blog Sidebar',
		//'archive_sidebar' => 'Archive Sidebar',
		//'category_sidebar' => 'Category Sidebar',
		//'search_sidebar' => 'Search Sidebar'	
	);
	
	foreach ($sidebars as $sidebar=>$name){
		
		register_sidebar(array(
			'name' => $name,
			'id' => $sidebar,
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
			'before_widget' => '<aside  id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>'
			)
		);
		
	}
	
	$footer_widget_count = count_sidebar_widgets( 'primary_footer', false );
	
	if($footer_widget_count > 0) $footer_widget_count = 12/$footer_widget_count;
		
	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'primary_footer',
		'before_title' => '<h4 class="widget-title"><span>',
		'after_title' => '</span></h4>',
		'before_widget' => '<div class="small-12 medium-6 large-'. $footer_widget_count .' columns"><aside  id="%1$s" class="widget %2$s ">',
		'after_widget' => '</aside></div>'
	));
	
	add_filter('widget_text', 'do_shortcode'); // Makes it possible to use shortcodes inside text widgets
	
}

add_action( 'widgets_init', 'veuse_widgets_init' );


/* 	===============================================================

	REGISTER NAV-MENUS

===================================================================*/

function veuse_register_menus(){

	/* Register menus */
	register_nav_menu('primary', __('Primary Navigation','veuse'));  
   	register_nav_menu('footer',__('Footer Navigation','veuse')); 
 	   	
}

add_action('init', 'veuse_register_menus');

function veuse_register_custom_mimes(){
  	
	function custom_mimes( $mimes ){
	    $mimes['ogg'] = 'audio/ogg';
	    $mimes['ogv'] = 'video/ogv';
	    return $mimes;
	}   	
}

add_action('init', 'veuse_register_custom_mimes');


/* Add editor style */

function veuse_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
}
add_action( 'init', 'veuse_add_editor_styles' );

function veuse_googlefont_add_editor_styles() {
    $font_url = 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600';
    add_editor_style( str_replace( ',', '%2C', $font_url ) );
}
add_action( 'init', 'veuse_googlefont_add_editor_styles' );



function siteman_theme_setup(){
	
	/* Loads the customizer */
	require_once ( get_stylesheet_directory() . '/includes/customizer.php');

	/* Post meta */
	require_once( get_stylesheet_directory() .'/post-meta.php');
	
	load_theme_textdomain( 'veuse', get_stylesheet_directory() . '/languages' );
	
	/* Switches default core markup for search form, comment form, and comments to output valid HTML5.*/
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	
	/* Style the visual editor */
	add_editor_style( array( 'css/editor-style.css') );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );
	add_post_type_support('post', 'post-formats');
	
	/* Custom image sizes */
	add_image_size( 'veuse-25-thumbnail',  480, 9999, false ); 
	add_image_size( 'veuse-33-thumbnail',  640, 9999, false ); 
	add_image_size( 'veuse-50-thumbnail',  960, 9999, false ); 
	add_image_size( 'veuse-75-thumbnail',  1440, 9999, false ); 
	add_image_size( 'veuse-100-thumbnail', 1920, 9999, false ); 
	add_image_size( 'veuse-25-thumbnail-cropped',  480, 240, true ); 
	add_image_size( 'veuse-33-thumbnail-cropped',  640, 320, true ); 
	add_image_size( 'veuse-50-thumbnail-cropped',  960, 480, true ); 
	add_image_size( 'veuse-75-thumbnail-cropped',  1300, 650, true ); 
	add_image_size( 'veuse-100-thumbnail-cropped', 1920, 960, true ); 

}

add_action('after_setup_theme', 'siteman_theme_setup');


add_filter( 'image_size_names_choose', 'veuse_custom_sizes' );

function veuse_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'veuse-25-thumbnail' 			=> __('1/4 width','veuse'),
        'veuse-33-thumbnail' 			=> __('1/3 width','veuse'),
        'veuse-50-thumbnail' 			=> __('1/2 width','veuse'),
        'veuse-75-thumbnail' 			=> __('3/4 width','veuse'),
        'veuse-100-thumbnail' 			=> __('Full width','veuse'),
        'veuse-25-thumbnail-cropped' 	=> __('1/4 width - cropped','veuse'),
        'veuse-33-thumbnail-cropped' 	=> __('1/3 width - cropped','veuse'),
        'veuse-50-thumbnail-cropped' 	=> __('1/2 width - cropped','veuse'),
        'veuse-75-thumbnail-cropped' 	=> __('3/4 width - cropped','veuse'),
        'veuse-100-thumbnail-cropped' 	=> __('Full width - cropped','veuse'),
    ) );
}

/* Shortcode for inserting a retina image in editor */
function veuse_retina_image($atts, $content = null) {
    return '<div class="retina">' . $content .'</div>';
}
 
add_shortcode('retina', 'veuse_retina_image');



function addHomeMenuLink($items, $args) {
     
     if( 'primary' === $args -> theme_location ) {
		$b = '<li class="menu-item menu-home"><a href="#"><i class="fa fa-home"></i></a></li>';
		
	}
	
	return $b.$items;
}
//add_filter( 'wp_nav_menu_items', 'addHomeMenuLink', 10, 2 );



/* For adding a search button to primary menu */

function add_search_to_wp_menu ( $items, $args ) {
	
	if( 'primary' === $args -> theme_location ) {
		$items .= '<li class="menu-item menu-open-search"><a href="#"><i class="fa fa-search"></i></a></li>';
		
	}
	
	return $items;
}
//add_filter('wp_nav_menu_items','add_search_to_wp_menu',10,2);



/* Related posts
========================================================= */

function veuse_related( $posttype, $taxonomy, $perpage, $columnsSmall, $columnsLarge, $str) {

    global $post, $wpdb;
 
	$terms = wp_get_object_terms( $post->ID, $taxonomy );
		
	if (!empty($terms)) {

		foreach($terms as $individual_category) $category_ids[] = $individual_category->term_id;
		
		$args = array(

			'tax_query' => array(
			    array(
			        'taxonomy' => $taxonomy,
			        'field' => 'id',
			        'terms' => $category_ids
			    )
			),

			'post_type' =>  $posttype,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> $perpage,
			'ignore_sticky_posts'=> 1,
			'order_by' => 'date',
			'order' => 'DESC'
		);


		$my_query = new WP_Query( $args );

		if ($my_query->have_posts()) {
		   
		   	$count = 0;
		  
		    $output = '';
		    $output.= '<h3>'.$str.'</h3>';
		    $output.= '<ul class="related-posts">';
		
		    while ($my_query->have_posts() && $count < $perpage) {
		    
		    		$my_query->the_post();

		            $output.= '<li><div class="'.$posttype.'-entry">';
		            $output.= '<div class="entry-thumbnail">';
		            if(has_post_thumbnail()):
		               $img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		               $output .= '<a href="' . get_permalink() . '">'. veuse_retina_interchange_image( $img_url, 200, 120, true) .'</a>';
		            endif;
					$output.= '</div>';
		             $output.= '<div class="entry-data"><span class="entry-date">'.get_the_date().'</span><h4><a href="' . get_permalink() . '">'.get_the_title($post->ID).'</a></h4>';
		             $output .= '</div>';
		             $output .= '</div></li>';

		             $count++;
		     }
		     $output.= '</ul>';

		     wp_reset_query();
		     
		     return $output;

		     }
	 }
}



/**
 * Include the TGM_Plugin_Activation class.
 */

require_once get_template_directory() . '/framework/plugin-activation.php';

add_action( 'tgmpa_register', 'siteman_register_required_plugins' );


/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function siteman_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     				=> 'Redux Options Framework', // The plugin name
			'slug'     				=> 'redux-framework', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/redux-framework.3.0.8.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.0.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://downloads.wordpress.org/plugin/redux-framework.zip', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Meta Box', // The plugin name
			'slug'     				=> 'meta-box', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/meta-box.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://downloads.wordpress.org/plugin/meta-box.zip', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Page Builder by Site Origin', // The plugin name
			'slug'     				=> 'siteorigin-panels', // The plugin slug (typically the folder name)
			'source'   				=> '', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://downloads.wordpress.org/plugin/siteorigin-panels.zip', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Veuse Portfolio', // The plugin name
			'slug'     				=> 'veuse-portfolio', // The plugin slug (typically the folder name)
			'source'   				=> '', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/veuse/veuse-portfolio/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),


		array(
			'name'     				=> 'Veuse Staff', // The plugin name
			'slug'     				=> 'veuse-staff', // The plugin slug (typically the folder name)
			'source'   				=> '', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/veuse/veuse-staff/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Veuse Slider', // The plugin name
			'slug'     				=> 'veuse-slider', // The plugin slug (typically the folder name)
			'source'   				=> '', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/veuse/veuse-slider/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),
		

		
		array(
			'name'     				=> 'Veuse Pricetable', // The plugin name
			'slug'     				=> 'veuse-pricetable', // The plugin slug (typically the folder name)
			'source'   				=> '', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/veuse/veuse-pricetable/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Veuse Uikit', // The plugin name
			'slug'     				=> 'veuse-uikit', // The plugin slug (typically the folder name)
			'source'   				=> '', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/veuse/veuse-uikit/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Veuse Sidebar Generator', // The plugin name
			'slug'     				=> 'veuse-sidebars', // The plugin slug (typically the folder name)
			'source'   				=> '', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/veuse/veuse-sidebars/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Veuse FAQ', // The plugin name
			'slug'     				=> 'veuse-faq', // The plugin slug (typically the folder name)
			'source'   				=> '', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/veuse/veuse-faq/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),
		
				
		/*
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		*/
		
		array(
			'name'     				=> 'Black Studio TinyMCE Widget', // The plugin name
			'slug'     				=> 'black-studio-tinymce-widget', // The plugin slug (typically the folder name)
			'source'   				=> '', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://downloads.wordpress.org/plugin/black-studio-tinymce-widget.zip', // If set, overrides default API URL and points to an external URL
		),



	);


	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'veuse',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'ceon'),
			'menu_title'                       			=> __( 'Install Plugins', 'ceon'),
			'installing'                       			=> __( 'Installing Plugin: %s', 'ceon'), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'ceon'),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'ceon'),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'ceon'),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'ceon'), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}
?>