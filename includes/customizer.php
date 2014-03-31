<?php

$veuse = get_option('veuse');

function add_media_manager_template_to_customizer() {
wp_print_media_templates();
}

add_action( 'customize_controls_print_footer_scripts', 'add_media_manager_template_to_customizer' );     
 
function veuse_customizer_add_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('veuse-media-manager', get_template_directory_uri().'/js/customizer-media-manager.js', array( ), '1.0', true);
 }
 
add_action( 'customize_controls_enqueue_scripts', 'veuse_customizer_add_scripts' ); 

function veuse_customizer_live_preview()
{
	wp_enqueue_script( 
		  'veuse-themecustomizer',			//Give the script an ID
		  get_template_directory_uri().'/js/customizer-live-preview.js',//Point to file
		  array( 'jquery'),	//Define dependencies
		  '',						//Define a version (optional) 
		  true						//Put script in footer?
	);
}
add_action( 'customize_preview_init', 'veuse_customizer_live_preview' );
 

function veuse_customize_styles() { ?>
    <style>
    .wp-full-overlay {
        z-index: 150000 !important;
    }
    </style>
<?php }
add_action( 'customize_controls_print_styles', 'veuse_customize_styles', 10);

function my_add_image_control( $slug, $label ) {
    global $wp_customize;
    static $count = 0;
    $id = "veuse[{$slug}][url]";
    $wp_customize->add_setting( $id, array(
        'type'              => 'option',
        'transport'			=> 'postMessage'
    ) );
     
    $control = 
    new WP_Customize_Image_Control( $wp_customize, $slug, 
        array(
        'label'         => __( $label, 'veuse' ),
        'section'       => 'veuse_logo_section',
        'priority'      => $count,
        'settings'      => $id
        ) 
    );
    $wp_customize->add_control($control); 
    $count++;
    return $control;
     
}

function veuse_customize_register($wp_customize) {

		global $my_image_controls;
		$my_image_controls = array();
		$my_image_controls['logo'] =  my_add_image_control('logo', 'Logo');
		
		global $my_image_controls;
		foreach ($my_image_controls as $id => $control) {
		    $control->add_tab( 'library',   __( 'Media Library','veuse' ), 'my_library_tab' );
		}
		 
		function my_library_tab() {
		    global $my_image_controls;
		    static $tab_num = 0; // Sync tab to each image control
		     
		    $control = array_slice($my_image_controls, $tab_num, 1);
		    ?>
		    <a class="choose-from-library-link button"
		        data-controller = "<?php esc_attr_e( key($control) ); ?>">
		        <?php _e( 'Open Library' ,'veuse'); ?>
		    </a>
		     
		    <?php
		    $tab_num++;
		}  

		



	class Example_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
}

/* Layout section - Boxed or stretched layout */
$wp_customize->add_section( 
	'veuse_layout', array(
	'title'          => __( 'Site layout', 'veuse' ),
	'priority'       => 32,
	)
);

$wp_customize->add_setting( 
	'veuse[site_layout]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	'veuse_layout', array(
		'label'      => __( 'Select layout', 'veuse' ),
		'section'    => 'veuse_layout',
		'settings'   => 'veuse[site_layout]',
		'type'       => 'select',
		'choices'    => array(
			'boxed-layout' => 'Boxed layout', 
			'fullwidth-layout' => 'Fullwidth layout'
		)
	)
);

$wp_customize->add_setting( 
	'veuse[page_layout]', array(
		'default'        => 'sidebar-left',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	'veuse_page_layout', array(
		'label'      => __( 'Defalt layout for pages', 'veuse' ),
		'section'    => 'veuse_layout',
		'settings'   => 'veuse[page_layout]',
		'type'       => 'select',
		'choices'    => array(
			'fullwidth' => 'Full width (no sidebar)', 
			'sidebar-left' => 'Sidebar on left',
			'sidebar-right' => 'Sidebar on right',
		)
	)
);

$wp_customize->add_setting( 
	'veuse[post_layout]', array(
		'default'        => 'sidebar-right',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	'veuse_post_layout', array(
		'label'      => __( 'Defalt layout for posts', 'veuse' ),
		'section'    => 'veuse_layout',
		'settings'   => 'veuse[post_layout]',
		'type'       => 'select',
		'choices'    => array(
			'fullwidth' => 'Full width (no sidebar)', 
			'sidebar-left' => 'Sidebar on left',
			'sidebar-right' => 'Sidebar on right',
		)
	)
);

/* Site background section */
$wp_customize->add_section( 'veuse_logo_section', array(
	'title'          => __( 'Logo', 'veuse' ),
	'priority'       => 24,
	)
);


$wp_customize->add_setting( 
	'veuse[logo_margin_top]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	'logo_margin_top', array(
		'label'      => __( 'Logo top margin', 'veuse' ),
		'section'    => 'veuse_logo_section',
		'settings'   => 'veuse[logo_margin_top]',
		'type'       => 'text',
	)
);

$wp_customize->add_setting( 
	'veuse[logo_margin_bottom]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	'logo_margin_bottom', array(
		'label'      => __( 'Logo bottom margin', 'veuse' ),
		'section'    => 'veuse_logo_section',
		'settings'   => 'veuse[logo_margin_bottom]',
		'type'       => 'text',
	)
);


$wp_customize->add_setting( 
	'veuse[logo_max_width]', array(
		'default'        => '250',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);


$wp_customize->add_control( 
	'logo_max_width', array(
		'label'      => __( 'Logo Max Width', 'veuse' ),
		'section'    => 'veuse_logo_section',
		'settings'   => 'veuse[logo_max_width]',
		'type'       => 'text',
	)
);



/* Skins section */

/* Get skins 

$skins = veuse_get_custom_stylesheets();

$wp_customize->add_section( 'veuse_skins', array(
	'title'          => __( 'Skins', 'veuse' ),
	'priority'       => 19,
	)
);


$wp_customize->add_setting( 
	'veuse[skin]', array(
		'default'        => 'default.css',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	'veuse_skin', array(
		'label'      => __( 'Skin', 'veuse' ),
		'section'    => 'veuse_skins',
		'settings'   => 'veuse[skin]',
		'type'       => 'select',
		'choices'    => $skins
	)
);
*/

/* Footer section */

$wp_customize->add_section( 'veuse_footer_section', array(
	'title'          => __( 'Footer', 'veuse' ),
	'priority'       => 40,
	)
);


$wp_customize->add_setting( 
	'veuse[footer_textline]', array(
    	'default'        => 'Some business info here',
    	'type'           => 'option',
		'capability'     => 'edit_theme_options'
	)
);
 
$wp_customize->add_control( 
	new Example_Customize_Textarea_Control( 
		$wp_customize, 'textarea_setting', array(
		    'label'   => 'Textarea Setting',
		    'section' => 'veuse_footer_section',
		    'settings'   => 'veuse[footer_textline]',
		)
	)
);



$wp_customize->add_setting( 
	'veuse[footer_credits_left]', array(
		'default'        => 'Your footer credits',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	'footer_credits_left', array(
		'label'      => __( 'Footer Credits Bottom Left', 'veuse' ),
		'section'    => 'veuse_footer_section',
		'settings'   => 'veuse[footer_credits_left]',
		'type'       => 'text',
	)
);

$wp_customize->add_setting( 
	'veuse[footer_credits_right]', array(
		'default'        => 'Your footer credits',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	'footer_credits_right', array(
		'label'      => __( 'Footer Credits Bottom Right', 'veuse' ),
		'section'    => 'veuse_footer_section',
		'settings'   => 'veuse[footer_credits_right]',
		'type'       => 'text',
	)
);
	


/* Colors section */
$wp_customize->add_section( 'veuse_colors', array(
	'title'          => __( 'Colors', 'veuse' ),
	'priority'       => 34,
	)
);



/* Body background color */
$wp_customize->add_setting( 
	'veuse[body_background]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options'
	)
);

$wp_customize->add_control( 
	new WP_Customize_Color_Control(
		$wp_customize, 'body_background_color', array(
			'label'   => __( 'Body background color', 'veuse' ),
			'section' => 'veuse_colors',
			'settings'   => 'veuse[body_background]'
		)
	)
);



/* Header  background */
$wp_customize->add_setting( 
	'veuse[header_background]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		)
);


$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 'header_background_color', array(
		'label'   => __( 'Header background-color', 'veuse' ),
		'section' => 'veuse_colors',
		'settings'   => 'veuse[header_background]',
		)
	)
);


/* Header  background */
$wp_customize->add_setting( 
	'veuse[menu_anchor_color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		)
);


$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 'option_menu_anchor_color', array(
		'label'   => __( 'Menu link color', 'veuse' ),
		'section' => 'veuse_colors',
		'settings'   => 'veuse[menu_anchor_color]',
		)
	)
);



/* Page content background */

$wp_customize->add_setting( 
	'veuse[content_background]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options'
	)
);


$wp_customize->add_control( 
	new WP_Customize_Color_Control( 
		$wp_customize, 'content_background_color', array(
			'label'   => __( 'Page content background-color', 'veuse' ),
			'section' => 'veuse_colors',
			'settings'   => 'veuse[content_background]'
		)
	)
);





/* Footer  background */
$wp_customize->add_setting( 
	'veuse[footer_background]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	new WP_Customize_Color_Control( 
		$wp_customize, 'footer_background_color', array(
			'label'   => __( 'Footer background color', 'veuse' ),
			'section' => 'veuse_colors',
			'settings'   => 'veuse[footer_background]',
		)
	)
);




/* Main color */
$wp_customize->add_setting( 
	'veuse[primary_color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	new WP_Customize_Color_Control( 
		$wp_customize, 'primary_color', array(
			'label'   => __( 'Main theme color', 'veuse' ),
			'section' => 'veuse_colors',
			'settings'   => 'veuse[primary_color]',
		)
	)
);



	/* Links  */
	$wp_customize->add_setting( 
		'veuse[anchor_color]', array(
			'default'        => '',
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
			$wp_customize, 'color_links', array(
				'label'   => __( 'Link Color', 'veuse' ),
				'section' => 'veuse_colors',
				'settings'   => 'veuse[anchor_color]',
			)
		)
	);
	
	
	
	/* Links hover */
	$wp_customize->add_setting( 
		'veuse[anchor_color_hover]', array(
			'default'        => '',
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
			$wp_customize, 'color_links_hover', array(
				'label'   => __( 'Link color on hover', 'veuse' ),
				'section' => 'veuse_colors',
				'settings'   => 'veuse[anchor_color_hover]',
			)
		)
	);

			
}


add_action( 'customize_register', 'veuse_customize_register' );



/* Print the styles to head */

function veuse_print_custom_styles(){
	
	$veuse = get_option('veuse');
	
	if(!empty($veuse)){
	
	
		empty($veuse['body_background']) 	? $body_background = '' 	: $body_background = $veuse['body_background'];
		empty($veuse['header_background']) 	? $header_background = '' 	: $header_background = $veuse['header_background'];
		empty($veuse['footer_background']) 	? $footer_background = '' 	: $footer_background = $veuse['footer_background'];
		empty($veuse['content_background']) ? $content_background = '' 	: $content_background = $veuse['content_background'];
		empty($veuse['primary_color']) 		? $primary_color = '' 		: $primary_color = $veuse['primary_color'];
		empty($veuse['anchor_color'])  		? $anchor_color = ''  		: $anchor_color = $veuse['anchor_color'];
		empty($veuse['anchor_color_hover']) ? $anchor_color_hover = ''  : $anchor_color_hover = $veuse['anchor_color_hover'];
		empty($veuse['menu_anchor_color']) 	? $menu_anchor_color = ''  	: $menu_anchor_color = $veuse['menu_anchor_color'];
		empty($veuse['logo_margin_top'])  	? $logo_margin_top = ''  	: $logo_margin_top = $veuse['logo_margin_top'];
		empty($veuse['logo_margin_bottom']) ? $logo_margin_bottom = ''  : $logo_margin_bottom = $veuse['logo_margin_bottom'];
	
		
		//$header_background =  $veuse['header_background'];
		//$footer_background = $veuse['footer_background'];
		//$content_background = $veuse['content_background'];
		
		//$logo_max_width = $veuse['logo_max_width'];

	?>		
	
	<style>
		<?php if($body_background):?>body,html { background-color: <?php echo $body_background;?>;}<?php endif;?>
		
		<?php if($content_background):?>#content { background-color: <?php echo $content_background;?>;}<?php endif;?>
	
		
		
		<?php if($header_background):?>
			#header { background-color: <?php echo $header_background;?>;}
		<?php endif;?>
		<?php if($footer_background):?>
			#footer { background-color: <?php echo $footer_background;?>;}
		<?php endif;?>
		
		<?php if($logo_margin_top):?>
			#header #logo img { padding-top: <?php echo $logo_margin_top;?>px;}
		<?php endif;?>
		<?php if($logo_margin_bottom):?>
			#header #logo img { padding-bottom: <?php echo $logo_margin_bottom;?>px;}
		<?php endif;?>
		
		<?php if($primary_color):?>
			.primary,
			.portfolio-entry .overlay 
			{ background-color: <?php echo $primary_color;?> !important;}
			
			#content #sidebar .widget .widget-title:after,
			#post-content .widget .widget-title:after { border-bottom-color: <?php echo $primary_color;?>;}
			#primary-menu > li > a:hover:before { border-right-color:<?php echo $primary_color;?>;}
			#primary-menu > li > ul,
			#primary-menu > li.mega-menu > ul:before { border-top-color:<?php //echo $primary_color;?>;}
			
		<?php endif;?>
		
		<?php if($menu_anchor_color):?>
			#primary-menu > li > a,
			#menu-open-search i:before { color: <?php echo $menu_anchor_color;?>;}
			 
		<?php endif;?>
		<?php if($anchor_color):?>
			.veuse-button,
			.button,
			input[type=submit],
			input[type=reset],
			input[type=button]{ background-color: <?php echo $anchor_color;?>;}
			a { color: <?php echo $anchor_color;?>;}
			#primary-menu > li.current-menu-item > a,
			#primary-menu > li.current_page_item > a,
			#primary-menu > li.current_page_parent > a
			 { color: <?php echo $anchor_color;?>; }
			.breadcrumbs a { color: <?php echo $anchor_color;?>;}
			
		<?php endif;?>
		<?php if($anchor_color_hover):?>
			.veuse-button:hover,
			.button:hover,
			input[type=submit]:hover,
			input[type=reset]:hover,
			input[type=button]:hover { background-color: <?php echo $anchor_color_hover;?>;}
			a:hover,
			ul.portfolio-filter li.active a,
			ul.portfolio-filter li a:hover,
			#primary-menu > li > a:hover,
			#primary-menu > li.sfHover > a  { color: <?php echo $anchor_color_hover;?>;}
			
		<?php endif;?>
	</style>
	<?php
	
	}
}

add_action('wp_head','veuse_print_custom_styles');
?>