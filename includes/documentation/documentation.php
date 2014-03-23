<?php


// Set-up Action and Filter Hooks
add_action('admin_init', 'veuse_documentation_init' );
add_action('admin_menu', 'veuse_documentation_add_options_page');


// Init plugin options to white list our options
function veuse_documentation_init(){
	register_setting( 'veuse_documentation_plugin_options', 'veuse_documentation_options', 'veuse_documentation_validate_options' );
}


// Add menu page
function veuse_documentation_add_options_page() {
	add_theme_page('Veuse Documentation Page', 'Theme Docs', 'manage_options', 'documentation', 'veuse_documentation_render_form');

}



function get_all_tabs(){
	
	 $tabs = array( 
    	
    	'intro' 		=> 'Intro', 
    	'theme-options' => 'Theme options', 
    	'sidebars'		=> 'Sidebars',
    	'menus'			=> 'Menus',
    	'pages' 		=> 'Pages',
    	'posts' 		=> 'Posts',
    	'portfolio' 	=> 'Portfolio',
    	'misc'			=> 'Other post types',
    	'shortcodes'	=> 'Shortcodes',
    	
    	
    	);
    return $tabs;
}

// Render the Plugin options form
function veuse_docs_admin_tabs( $current = 'intro' ) {


	
    
    $tabs = get_all_tabs();  
     
    echo '<h3 class="nav-tab-wrapper" style="padding-left:0; border-bottom:0;">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' style='padding-top:6px; margin:0px -1px -1px 0; border:1px solid #ccc;' href='?page=documentation&tab=$tab'>$name</a>";

    }
    echo '</h3>';
}


function veuse_documentation_render_form(){

	
	$ct = wp_get_theme();
    $theme_data = $ct;
    $theme_name = $theme_data->get('Name'); 
	
	
	
	?>
	<style>
		#veuse-documentation-wrapper a { text-decoration: none;}
		#veuse-documentation-wrapper .about-text { margin: 1em 0; }
		#veuse-documentation-wrapper p {  }
		#veuse-documentation-wrapper h1 { margin-right:0;}
		#veuse-documentation-wrapper hr { margin: 0 0 20px;}
		#veuse-documentation-wrapper ul { margin-bottom: 30px !important; list-style: square; margin-left:18px;}
		ul.inline-list { list-style: disc !important; list-style-position: inside;}
		ul.inline-list li { display: inline; margin-right: 10px; list-style: disc;}
		ul.inline-list li:after { content:'-'; margin-left: 10px; }
	</style>
	<div class="wrap about-wrap">

		<div class="icon32" id="icon-options-general"><br></div>
		<h2><?php echo $theme_name;?> <?php _e('documentation','veuse-documentation');?></h2>
		<p>
		<?php echo sprintf( __( 'Here you find instructions on how to use the %s theme. For more in-depth info, please check out http://veuse.com/support.', 'veuse-documentation' ), $theme_name);?>
		</p>
		
		<?php
		
		$docpath = get_stylesheet_directory().'/includes/documentation';
		
		if ( isset ( $_GET['tab'] ) ) veuse_docs_admin_tabs($_GET['tab']); else veuse_docs_admin_tabs('intro'); ?>
		
		<div id="veuse-documentation-wrapper" style="padding:20px 0; max-width:800px;">	

		<?php
		
		if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; else $tab = 'intro';
		

			
			switch ($tab ) {	
				
				
				case $tab :
				
					echo '<div>';
					
					//$text = file_get_contents($docpath."/pages/$tab.php");		
					//echo nl2br($text);
					
					include("pages/$tab.php");
										
					echo '</div>';
					
					break;
				
			} // end switch			
			

	
		?>
		<div>
		<br>
		<hr>
		<br>
		<a href="http://veuse.com/support" class="button">Support forum</a>
		</div>
		</div>
		
	</div>
	<?php
}
?>