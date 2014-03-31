<?php

function setup_framework_options(){
    $args = array();

    // For use with a tab below
	$tabs = array();

	ob_start();

	$ct = wp_get_theme();
    $theme_data = $ct;
    $item_name = $theme_data->get('Name'); 
	$tags = $ct->Tags;
	$screenshot = $ct->get_screenshot();
	$class = $screenshot ? 'has-screenshot' : '';

	$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','veuse' ), $ct->display('Name') );

		?>
		<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
			<?php if ( $screenshot ) : ?>
				<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
				<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
					<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
				</a>
				<?php endif; ?>
				<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
			<?php endif; ?>

			<h4>
				<?php echo $ct->display('Name'); ?>
			</h4>

			<div>
				<ul class="theme-info">
					<li><?php printf( __('By %s'), $ct->display('Author') ); ?></li>
					<li><?php printf( __('Version %s'), $ct->display('Version') ); ?></li>
					<li><?php echo '<strong>'.__('Tags', 'veuse').':</strong> '; ?><?php printf( $ct->display('Tags') ); ?></li>
				</ul>
				<p class="theme-description"><?php echo $ct->display('Description'); ?></p>
				<?php if ( $ct->parent() ) {
					printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>',
						__( 'http://codex.wordpress.org/Child_Themes' ),
						$ct->parent()->display( 'Name' ) );
				} ?>
				
			</div>

		</div>

		<?php
		$item_info = ob_get_contents();
		    
		ob_end_clean();


	if( file_exists( dirname(__FILE__).'/info-html.html' )) {
		global $wp_filesystem;
		if (empty($wp_filesystem)) {
			require_once(ABSPATH .'/wp-admin/includes/file.php');
			WP_Filesystem();
		}  		
		$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__).'/info-html.html');
	}


    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: true
    $args['dev_mode'] = true;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
    $args['dev_mode_icon_class'] = 'icon-large';

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = 'veuse';

    // Setting system info to true allows you to view info useful for debugging.
    // Default: false
    //$args['system_info'] = true;

    
	// Set the icon for the system info tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['system_info_icon'] = 'info-sign';

	// Set the class for the system info tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['system_info_icon_class'] = 'icon-large';

	$theme = wp_get_theme();

	$args['display_name'] = $theme->get('Name');
	//$args['database'] = "theme_mods_expanded";
	$args['display_version'] = $theme->get('Version');

    // If you want to use Google Webfonts, you MUST define the api key.
    $args['google_api_key'] = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    //$args['admin_stylesheet'] = 'standard';

    // Setup custom links in the footer for share icons
    /*
    $args['share_icons']['twitter'] = array(
        'link' => 'http://twitter.com/andreaswilthil',
        'title' => 'Follow me on Twitter', 
        'img' => ReduxFramework::$_url . 'assets/img/social/Twitter.png'
    );
    $args['share_icons']['linked_in'] = array(
        'link' => 'http://www.linkedin.com/profile/view?id=52559281',
        'title' => 'Find me on LinkedIn', 
        'img' => ReduxFramework::$_url . 'assets/img/social/LinkedIn.png'
    );
	*/
    // Enable the import/export feature.
    // Default: true
    //$args['show_import_export'] = false;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	//$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['import_icon_class'] = 'icon-large';

    // Set a custom menu icon.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Theme Options', 'veuse');

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Theme Options', 'veuse');

    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'redux_options';

    $args['default_show'] = true;
    $args['default_mark'] = '*';

    // Set a custom page capability.
    // Default: manage_options
    //$args['page_cap'] = 'manage_options';

    // Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
    // Default: menu
    $args['page_type'] = 'submenu';

    // Set the parent menu.
    // Default: themes.php
    // A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    //$args['page_parent'] = 'options_general.php';

    // Set a custom page location. This allows you to place your menu where you want in the menu order.
    // Must be unique or it will override other items!
    // Default: null
    //$args['page_position'] = null;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	$args['icon_type'] = 'iconfont';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
    /*
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', 'veuse'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'veuse')
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', 'veuse'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'veuse')
    );
    
    */

    // Set the help sidebar for the options page.                                        
    //$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'veuse');


   
    // Add content after the form.
   // $args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'veuse');

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', 'veuse');


    $sections = array();              

    //Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) :
    	
      if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
      	$sample_patterns = array();

        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

          if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
          	$name = explode(".", $sample_patterns_file);
          	$name = str_replace('.'.end($name), '', $sample_patterns_file);
          	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
          }
        }
      endif;
    endif;


	function veuse_custom_stylesheets(){
	
	//Stylesheets Reader
		$alt_stylesheet_path = get_stylesheet_directory().'/css/skins/';
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[$alt_stylesheet_file] = $alt_stylesheet_file;
		            }
		        }    
		    }
		    
		    return $alt_stylesheets;
		}
	}

	$alt_stylesheets = veuse_custom_stylesheets();
	


	$sections[] = array(
		'icon' => 'cogs',
		'icon_class' => 'icon-large',
        'title' => __('General Settings', 'veuse'),
		'fields' => array(
			
			
			array(
			'id'=>'logo',
			'type' => 'media', 
			'url'=> true,
			'title' => __('Site Logo', 'veuse'),
			'compiler' => 'true',
			'desc'=> __('', 'veuse'),
			'subtitle' => __('Select or upload logo', 'veuse'),
			),
			
			
			array(
				'id'=>'header_position',
				'type' => 'select',
				'compiler'=>true,
				'title' => __('Header position', 'veuse'), 
				'subtitle' => __('', 'veuse'),
				'options' => array(
						'fixed' => 'Fixed to top',
						'regular' => 'Regular'
					),
				'default' => 'fixed'
				),
			
			
			
			array(
				'id'=>'header-height',
				'type' => 'text',
				'title' => __('Header Height', 'veuse'), 
				'subtitle' => __('Set a maximum pixel height for your site header', 'veuse'),
				'validate' => 'numeric',
				//'desc' => 'Validate that it\'s javascript!',
				),
				
			array(
				'id'=>'header-height-sticky',
				'type' => 'text',
				'title' => __('Header Height on sticky-menu', 'veuse'), 
				'subtitle' => __('Set a maximum pixel height for your site header when menu is sticked to page top', 'veuse'),
				'validate' => 'numeric',
				//'desc' => 'Validate that it\'s javascript!',
				),
			
			array(
				'id'=>'logo-maxwidth',
				'type' => 'text',
				'title' => __('Logo Max-width', 'veuse'), 
				'subtitle' => __('Set a maximum pixel width for your site logo', 'veuse'),
				'validate' => 'numeric',
				//'desc' => 'Validate that it\'s javascript!',
				),
				
			array(
				'id'=>'logo_margin_top',
				'type' => 'text',
				'title' => __('Logo Top Margin', 'veuse'), 
				'subtitle' => __('Add some spacing above your site logo', 'veuse'),
				'validate' => 'numeric',
				//'desc' => 'Validate that it\'s javascript!',
				),
				
			array(
				'id'=>'logo_margin_bottom',
				'type' => 'text',
				'title' => __('Logo Bottom Margin', 'veuse'), 
				'subtitle' => __('Add some below above your site logo', 'veuse'),
				'validate' => 'numeric',
				//'desc' => 'Validate that it\'s javascript!',
				),
				
			
			array(
			'id'=>'favicon',
			'type' => 'media', 
			'url'=> true,
			'title' => __('Site favicon', 'veuse'),
			'compiler' => 'true',
			'desc'=> __('Insert a favicon.', 'veuse'),
			//'subtitle' => __('Upload any media using the WordPress native uploader', 'veuse'),
			),
			
			array(
				'id'=>'menu_layout',
				'type' => 'select',
				'compiler'=>true,
				'title' => __('Menu Layout', 'veuse'), 
				'subtitle' => __('', 'veuse'),
				'options' => array(
						'regular' => 'Regular menu',
						'mobile' => 'Collapsed menu'
					),
				'default' => 'regular-layout'
				),

			
						
			array(
				'id'=>'site_layout',
				'type' => 'select',
				'compiler'=>true,
				'title' => __('Site Layout', 'veuse'), 
				'subtitle' => __('Select boxed or full width layout.', 'veuse'),
				'options' => array(
						'fullwidth-layout' => 'Full width',
						'boxed-layout' => 'Boxed'
					),
				'default' => 'fullwidth-layout'
				),

			
			
			

			
			array(
				'id'=>'page_layout',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Page Layout', 'veuse'), 
				'subtitle' => __('Select default layout for pages. You can override this on page level by selecting a tempate.', 'veuse'),
				'options' => array(
						'fullwidth' => array('alt' => '1 Column', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
						'sidebar-left' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
						'sidebar-right' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
					),
				'default' => 'fullwidth'
				),
				
			
			array(
				'id'=>'post_layout',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Post Layout', 'veuse'), 
				'subtitle' => __('Select default layout for posts.', 'veuse'),
				'options' => array(
						'fullwidth' => array('alt' => '1 Column', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
						'sidebar-left' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
						'sidebar-right' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
					),
				'default' => 'sidebar-right'
				),
				
		
			array(
				'id'=>'tracking-code',
				'type' => 'textarea',
				'required' => array('layout','equals','1'),	
				'title' => __('Tracking Code', 'veuse'), 
				'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'veuse'),
				'validate' => 'js',
				'desc' => 'Validate that it\'s javascript!',
				),
				
				
			)
		);

		$sections[] = array(
		'icon' => 'cogs',
		'icon_class' => 'icon-large',
        'title' => __('Blog', 'veuse'),
		'fields' => array(
		
		
			array(
				'id'=>'blog_layout',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Blog and Archive Layout', 'veuse'), 
				'subtitle' => __('Select default layout for blog, archive, category and archive pages.', 'veuse'),
				'options' => array(
						'fullwidth' => array('alt' => '1 Column', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
						'sidebar-left' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
						'sidebar-right' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
					),
				'default' => 'sidebar-right'
				),
				
				
			array(
				'id'=>'blog_columns',
				'type' => 'select',
				'title' => __('Blog Columns', 'veuse'), 
				'subtitle' => __('Select how many columns to display on blog', 'veuse'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
					),
				'default' => '1',
				),
				
			
			array(
				'id'=>'blog_masonry',
				'type' => 'checkbox',
				'title' => __('Masonry layout', 'veuse'), 
				'subtitle' => __('Select this if you want your blog to be listed with the masononry-effect', 'veuse'),		
				'default' => '',
				),
		
			array(
                'id' => 'sidebar-blog',
                'type' => 'select',
                'data' => 'sidebar',
                'title' => __('Blog sidebar', 'redux-framework-demo'),
                'subtitle' => __('Select a sidebar', 'redux-framework-demo'),
                'desc' => __('Select a sidebar to show on the blog page', 'redux-framework-demo'),
                'default' => 'default_sidebar',
            ),
			
			array(
                'id' => 'sidebar-category',
                'type' => 'select',
                'data' => 'sidebar',
                'title' => __('Category sidebar', 'redux-framework-demo'),
                'subtitle' => __('Select a sidebar', 'redux-framework-demo'),
                'desc' => __('Select a sidebar to show on category-pages', 'redux-framework-demo'),
                'default' => 'default_sidebar',
            ),
			
			array(
                'id' => 'sidebar-archive',
                'type' => 'select',
                'data' => 'sidebar',
                'title' => __('Archives sidebar', 'redux-framework-demo'),
                'subtitle' => __('Select a sidebar', 'redux-framework-demo'),
                'desc' => __('Select a sidebar to show on archive-pages', 'redux-framework-demo'),
                'default' => 'default_sidebar',
            ),
            
            array(
                'id' => 'sidebar-search',
                'type' => 'select',
                'data' => 'sidebar',
                'title' => __('Search page sidebar', 'redux-framework-demo'),
                'subtitle' => __('Select a sidebar', 'redux-framework-demo'),
                'desc' => __('Select a sidebar to show on search-page', 'redux-framework-demo'),
                'default' => 'default_sidebar',
            ),

		
			)
		);

		$sections[] = array(
		'icon' => 'cogs',
		'icon_class' => 'icon-large',
        'title' => __('Footer', 'veuse'),
		'fields' => array(
		
		
			array(
				'id'=>'footer_text_top',
				'type' => 'editor',
				'title' => __('Footer Text Top', 'veuse'), 
				//'subtitle' => __('You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'veuse'),
				'default' => 'How about an adress line here?',
				),
			
			
			array(
				'id'=>'footer_text_1',
				'type' => 'editor',
				'title' => __('Footer Text Left', 'veuse'), 
				//'subtitle' => __('You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'veuse'),
				'default' => 'Copyright 2013 [site-title]',
				),
				
			array(
				'id'=>'footer_text_2',
				'type' => 'editor',
				'title' => __('Footer Text Right', 'veuse'), 
				//'subtitle' => __('You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'veuse'),
				'default' => 'Powered by [wp-url]. Built on the [theme-url].',
				),

		)
	);




	$sections[] = array(
		'icon' => 'website',
		'icon_class' => 'icon-large',
		'title' => __('Styling Options', 'veuse'),
		'fields' => array(
			array(
				'id'=>'stylesheet',
				'type' => 'select',
				'title' => __('Theme Stylesheet', 'veuse'), 
				'subtitle' => __('Select your themes alternative color scheme.', 'veuse'),
				'options' => $alt_stylesheets,
				'default' => 'default.css',
				),
			
			array(
				'id'=>'primary_color',
				'type' => 'color',
				'title' => __('Primary Theme Color', 'veuse'), 
				//'subtitle' => __('Pick a color for the theme.', 'veuse'),
				'default' => '',
				'validate' => 'color',
				),
			/*
			array(
				'id'=>'secondary_color',
				'type' => 'color',
				'title' => __('Secondary Theme Color', 'veuse'), 
				//'subtitle' => __('Pick a color for the theme.', 'veuse'),
				'default' => '',
				'validate' => 'color',
				),
			*/
			array(
				'id'=>'body_background',
				'type' => 'color',
				'title' => __('Body Background Color', 'veuse'), 
				'subtitle' => __('Pick a background color for the theme.', 'veuse'),
				'default' => '',
				'validate' => 'color',
				),
			
			array(
				'id'=>'header_background',
				'type' => 'color',
				'title' => __('Header Background Color', 'veuse'), 
				'subtitle' => __('Pick a background color for the header.', 'veuse'),
				'default' => '',
				'validate' => 'color',
				),
				
			array(
				'id'=>'content_background',
				'type' => 'color',
				'title' => __('Content Background Color', 'veuse'), 
				'subtitle' => __('Pick a background color for the content area.', 'veuse'),
				'default' => '',
				'validate' => 'color',
				),
				
				
			array(
				'id'=>'footer_background',
				'type' => 'color',
				'title' => __('Footer Background Color', 'veuse'), 
				'subtitle' => __('Pick a background color for the footer.', 'veuse'),
				'default' => '',
				'validate' => 'color',
				),
				
			/*
			array(
				'id'=>'color-header',
				'type' => 'color_gradient',
				'title' => __('Header Gradient Color Option', 'veuse'),
				'subtitle' => __('Only color validation can be done on this field type', 'veuse'),
				'desc' => __('This is the description field, again good for additional info.', 'veuse'),
				'default' => array('from' => '#1e73be', 'to' => '#00897e')
				),
			*/
			array(
				'id'=>'link_color',
				'type' => 'link_color',
				'title' => __('Links Color Option', 'veuse'),
				//'subtitle' => __('Only color validation can be done on this field type', 'veuse'),
				//'desc' => __('This is the description field, again good for additional info.', 'veuse'),
				'default' => array(
					'show_regular' => false,
					'show_hover' => false,
					'show_active' => false
				)
			),
			
			array(
				'id'=>'footer_link_color',
				'type' => 'link_color',
				'title' => __('Links Color in Footer', 'veuse'),
				//'subtitle' => __('Only color validation can be done on this field type', 'veuse'),
				//'desc' => __('This is the description field, again good for additional info.', 'veuse'),
				'default' => array(
					'show_regular' => false,
					'show_hover' => false,
					'show_active' => false
				)
			),
			
			
			array(
				'id'=>'primary_menu_link_color',
				'type' => 'link_color',
				'title' => __('Links Color in Main Menu', 'veuse'),
				//'subtitle' => __('Only color validation can be done on this field type', 'veuse'),
				//'desc' => __('This is the description field, again good for additional info.', 'veuse'),
				'default' => array(
					'show_regular' => false,
					'show_hover' => false,
					'show_active' => false
				)
			),
			
			/*
			array(
				'id'=>'header-border',
				'type' => 'border',
				'title' => __('Header Border Option', 'veuse'),
				'subtitle' => __('Only color validation can be done on this field type', 'veuse'),
				'output' => array('.site-header'), // An array of CSS selectors to apply this font style to
				'desc' => __('This is the description field, again good for additional info.', 'veuse'),
				'default' => array('color' => '#1e73be', 'style' => 'solid', 'width'=>'3')
				),
			*/
			/*	
			array(
				'id'=>'spacing',
				'type' => 'spacing',
				'output' => array('#logo'), // An array of CSS selectors to apply this font style to
				'mode'=>'margin', // absolute, padding, margin, defaults to padding
				//'units' => 'em', // You can specify a unit value. Possible: px, em, %
				//'units_extended' => 'true', // Allow users to select any type of unit
				'title' => __('Logo margins', 'veuse'),
				'subtitle' => __('Allow your users to choose the spacing or margin they want.', 'veuse'),
				'desc' => __('You can enable or diable any piece of this field. Top, Right, Bottom, Left, or Units.', 'veuse'),
				'default' => array('top' => 5, 'bottom' => 6, 'left'=>2, 'right'=>4)
				),
			*/					
			array(
				'id'=>'custom_css',
				'type' => 'textarea',
				'title' => __('Custom CSS', 'veuse'), 
				'subtitle' => __('Quickly add some CSS to your theme by adding it to this block.', 'veuse'),
				//'desc' => __('This field is even CSS validated!', 'veuse'),
				'validate' => 'css',
				),
		)
	);
	
	$sections[] = array(
		'icon' => 'font',
		'icon_class' => 'icon-large',
		'title' => __('Typography', 'veuse'),
		'desc' => __('<p class="description">Change typograhy settings</p>', 'veuse'),
		'fields' => array(
			
			array(
				'id'=>'typography_h1',
				'type' => 'typography', 
				'title' => __('Header 1', 'veuse'),
				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'=>true, // Select a backup non-google font in addition to a google font
				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
				//'subsets'=>false, // Only appears if google is true and subsets not set to false
				//'font-size'=>false,
				//'line-height'=>false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				//'color'=>false,
				//'preview'=>false, // Disable the previewer
				'output' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
				'units'=>'px', // Defaults to px
				'subtitle'=> __('', 'veuse'),
				'default'=> array(
					'color'=>"", 
					'font-style'=>'700', 
					'font-family'=>'Roboto Slab', 
					'font-size'=>'', 
					'line-height'=>''),
				),	
				
			array(
				'id'=>'typography_h2',
				'type' => 'typography', 
				'title' => __('Header 2', 'veuse'),
				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'=>true, // Select a backup non-google font in addition to a google font
				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
				//'subsets'=>false, // Only appears if google is true and subsets not set to false
				//'font-size'=>false,
				//'line-height'=>false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				//'color'=>false,
				//'preview'=>false, // Disable the previewer
				'output' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
				'units'=>'px', // Defaults to px
				'subtitle'=> __('', 'veuse'),
				'default'=> array(
					'color'=>"", 
					'font-style'=>'700', 
					'font-family'=>'Roboto Slab',
					'font-size'=>'', 
					'line-height'=>''),
				
			),
			
			array(
				'id'=>'typography_h3',
				'type' => 'typography', 
				'title' => __('Header 3', 'veuse'),
				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'=>true, // Select a backup non-google font in addition to a google font
				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
				//'subsets'=>false, // Only appears if google is true and subsets not set to false
				//'font-size'=>false,
				//'line-height'=>false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				//'color'=>false,
				//'preview'=>false, // Disable the previewer
				'output' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
				'units'=>'px', // Defaults to px
				'subtitle'=> __('', 'veuse'),
				'default'=> array(
					'color'=>"", 
					'font-style'=>'700', 
					'font-family'=>'Roboto Slab',
					'font-size'=>'', 
					'line-height'=>''),
				
			),
			
			
			array(
				'id'=>'typography_h4',
				'type' => 'typography', 
				'title' => __('Header 4', 'veuse'),
				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'=>true, // Select a backup non-google font in addition to a google font
				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
				//'subsets'=>false, // Only appears if google is true and subsets not set to false
				//'font-size'=>false,
				//'line-height'=>false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				//'color'=>false,
				//'preview'=>false, // Disable the previewer
				'output' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
				'units'=>'px', // Defaults to px
				'subtitle'=> __('', 'veuse'),
				'default'=> array(
					'color'=>"", 
					'font-style'=>'700', 
					'font-family'=>'Roboto Slab', 
					'font-size'=>'', 
					'line-height'=>''),
				
			),
			
			array(
				'id'=>'typography_h5',
				'type' => 'typography', 
				'title' => __('Header 5', 'veuse'),
				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'=>true, // Select a backup non-google font in addition to a google font
				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
				//'subsets'=>false, // Only appears if google is true and subsets not set to false
				//'font-size'=>false,
				//'line-height'=>false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				//'color'=>false,
				//'preview'=>false, // Disable the previewer
				'output' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
				'units'=>'px', // Defaults to px
				'subtitle'=> __('', 'veuse'),
				'default'=> array(
					'color'=>"", 
					'font-style'=>'700', 
					'font-family'=>'Roboto Slab',  
					'font-size'=>'', 
					'line-height'=>''),
				
			),
			
			array(
				'id'=>'typography_h6',
				'type' => 'typography', 
				'title' => __('Header 6', 'veuse'),
				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'=>true, // Select a backup non-google font in addition to a google font
				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
				//'subsets'=>false, // Only appears if google is true and subsets not set to false
				//'font-size'=>false,
				//'line-height'=>false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				//'color'=>false,
				//'preview'=>false, // Disable the previewer
				'output' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
				'units'=>'px', // Defaults to px
				'subtitle'=> __('', 'veuse'),
				'default'=> array(
					'color'=>"", 
					'font-style'=>'400', 
					'font-family'=>'Roboto', 
					'font-size'=>'', 
					'line-height'=>''),
				
			),
			
			array(
				'id'=>'typography_body',
				'type' => 'typography', 
				'title' => __('Body and paragraph', 'veuse'),
				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'=>true, // Select a backup non-google font in addition to a google font
				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
				//'subsets'=>false, // Only appears if google is true and subsets not set to false
				//'font-size'=>false,
				//'line-height'=>false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				//'color'=>false,
				//'preview'=>false, // Disable the previewer
				'output' => array('body,p'), // An array of CSS selectors to apply this font style to dynamically
				'units'=>'px', // Defaults to px
				'subtitle'=> __('', 'veuse'),
				'default'=> array(
					'color'=>"", 
					'font-style'=>'300', 
					'font-family'=>'Roboto',  
					'font-size'=>'', 
					'line-height'=>''),
				
			),
			

			)
		);
	
		
	
	
		
	$tabs = array();

	if (function_exists('wp_get_theme')){
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data->get('ThemeURI');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');
		}else{
		$theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()).'style.css');
		$theme_uri = $theme_data['URI'];
		$description = $theme_data['Description'];
		$author = $theme_data['Author'];
		$version = $theme_data['Version'];
		$tags = $theme_data['Tags'];
	}	

	$theme_info = '<div class="redux-framework-section-desc">';
	$theme_info .= '<p class="redux-framework-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'veuse').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'veuse').$author.'</p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'veuse').$version.'</p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-description">'.$description.'</p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'veuse').implode(', ', $tags).'</p>';
	$theme_info .= '</div>';

	if(file_exists(dirname(__FILE__).'/README.md')){
	$tabs['theme_docs'] = array(
				'icon' => ReduxFramework::$_url.'assets/img/glyphicons/glyphicons_071_book.png',
				'title' => __('Documentation', 'veuse'),
				'content' => file_get_contents(dirname(__FILE__).'/README.md')
				);
	}//if

	
	/*
    $tabs['item_info'] = array(
		'icon' => 'info-sign',
		'icon_class' => 'icon-large',
        'title' => __('Theme Information', 'veuse'),
        'content' => $item_info
    );
    
    if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
        $tabs['docs'] = array(
			'icon' => 'book',
			'icon_class' => 'icon-large',
            'title' => __('Documentation', 'veuse'),
            'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
        );
    }
	*/
    global $ReduxFramework;
    $ReduxFramework = new ReduxFramework($sections, $args, $tabs);

}
add_action('init', 'setup_framework_options', 0);


/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
    $error = false;
    $value =  'just testing';
    /*
    do your validation
    
    if(something) {
        $value = $value;
    } elseif(somthing else) {
        $error = true;
        $value = $existing_value;
        $field['msg'] = 'your custom error message';
    }
    */
    
    $return['value'] = $value;
    if($error == true) {
        $return['error'] = $field;
    }
    return $return;
}

/*
	This is a test function that will let you see when the compiler hook occurs. 
	It only runs if a field	set with compiler=>true is changed.
*/
function testCompiler() {
	//echo "Compiler hook!";
}
add_action('redux-compiler-redux-sample-file', 'testCompiler');



/**
	Use this function to hide the activation notice telling users about a sample panel.
**/
function removeReduxAdminNotice() {
	delete_option('REDUX_FRAMEWORK_PLUGIN_ACTIVATED_NOTICES');
}
add_action('redux_framework_plugin_admin_notice', 'removeReduxAdminNotice');
