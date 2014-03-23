<?php 

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

	THEME SETUP

===================================================================*/

function veuse_theme_setup(){
	
	require_once ( get_template_directory() . '/framework/mr-image-resize.php');
	//require_once ( get_template_directory() . '/includes/sidebar-generator.php');
	
	
	load_theme_textdomain( 'veuse', get_stylesheet_directory() . '/languages' );
	
	/* Switches default core markup for search form, comment form, and comments to output valid HTML5.*/
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	
	add_theme_support( 'automatic-feed-links' );
	add_post_type_support('post', 'post-formats'); // add post-formats to post_type 'products'	
	

}

add_action('after_setup_theme', 'veuse_theme_setup');


/* Sidebar generator */

function veuse_create_sidebars(){
	
	global $veuse;
	
	//var_dump($veuse['sidebars']);
	
	if(isset($veuse['sidebars'])){
		$sidebars = $veuse['sidebars'];
	}	
	
	if(!empty($sidebars)){
	
		foreach( $sidebars as $sidebar){
		
			
			$sidebar_id = $sidebar['slide_title'];
			$sidebar_id = str_replace(' ', '_', $sidebar_id);
			$sidebar_id = strtolower($sidebar_id);
			
			register_sidebar(array(
				'name' => $sidebar['slide_title'],
				'id' => 'veuse_sidebar_'.$sidebar['slide_sort'],
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h4>',
				'before_widget' => '<aside  id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>'
				)
			);
				
		}
	}
	
}


/* Post comments
================================================ */
if(!function_exists('veuse_comments')){

	function veuse_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="single-comment">
				
				<div class="entry-meta">
				
					<div class="comment-author vcard"> <?php echo get_avatar($comment, $size = '40', $default = ''); ?></div>
					<h4><?php comment_author(); ?></h4>
			        <?php echo '<i class="icon-time"></i> '. get_comment_date(); ?> <?php echo get_comment_time(); ?>
			        <?php edit_comment_link(__('Edit', 'ceon'), '  ', ''); ?>
			        <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'ceon'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			   </div>
			        
			    <div class="entry-text">
			            <?php if ($comment->comment_approved == '0'): ?>
			            <p><?php _e('Comment is awaiting moderation', 'veuse'); ?></p>
			            <?php endif; ?>
			   			<?php comment_text() ?>
			    </div>
			
			</div>
		</li>
	<?php
	}
}



/* Gallery shortcode
============================================= */
if(!function_exists('veuse_gallery_shortcode')){
	function veuse_gallery_shortcode( $atts, $content = null ) {
	
		extract(shortcode_atts(array(), $atts));
	
			ob_start();
			include(locate_template('format-gallery.php'));
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
	
	}
	
	add_shortcode('veuse_gallery', 'veuse_gallery_shortcode');
}


/* Video Embed shortcode
============================================= */
if(!function_exists('veuse_video_embed_shortcode')){
	
	function veuse_video_embed_shortcode( $atts, $content = null ) {
	
		extract(shortcode_atts(array(
		
			'width' => ''
		
		), $atts));
	
			
		$out = '<div class="video-wrapper">';
		$out.= wp_oembed_get($content);
		$out.= '</div>';
				
		return $out;
	
	}
	
	add_shortcode('veuse_video', 'veuse_video_embed_shortcode');
	add_shortcode('veuse_responsive_video', 'veuse_video_embed_shortcode');
}


/* Primary menu fallback 
============================================= */

if(!function_exists('veuse_primary_fallback')){

	function veuse_primary_fallback(){
	
		global $options, $post;
		
		//$excluded_pages = $options['menu_primary_exclude'];
		//var_dump($excluded_pages);

		$excluded=array();
		if(isset($excluded_pages)){
		foreach($excluded_pages as $excluded_page => $val ){
			if($val == true){
				$excluded[] = $excluded_page;
				}
			}
		}

		$parent_pages_to_exclude = $excluded;
		$page_exclusions = '';
			foreach($parent_pages_to_exclude as $parent_page_to_exclude) {
			if ($page_exclusions) { $page_exclusions .= ',' . $parent_page_to_exclude; }
			  else { $page_exclusions = $parent_page_to_exclude; }
			  $descendants = get_pages('child_of=' . $parent_page_to_exclude);
			  foreach($descendants as $descendant) {
			    $page_exclusions .= ',' . $descendant->ID;
			  }
			}

		$args = array(
			'depth'        => 0,
			'child_of'     => 0,
			'title_li'     => '',
			'echo'         => 1,
			'sort_column'  => 'menu_order, post_title',
			'post_type'    => 'page',
		    'post_status'  => 'publish',
		    'exclude' 	   => $page_exclusions,
		    //'walker'		=> new MV_Cleaner_Walker_Nav_Menu()
		     );

	     echo "<ul id='primary-menu'>";
		 		wp_list_pages($args);
		 echo "</ul>";
		 
		 
		 }
		 
}

if(!function_exists('veuse_submenu_fallback')){
	function veuse_submenu_fallback(){
		
		if (is_page()) {
		    global $wp_query, $post;
	
		    $depth = get_depth();
	
		    if($depth == '2'){
				// lvl 1
				$parent_post = get_post($wp_query->post->post_parent);
				$parent = $parent_post->post_parent;
		    }
		    elseif($depth == '3'){
				// lvl 2
				$parent_post = get_post($wp_query->post->post_parent);
				// lvl 1
				$grandparent_post = get_post($parent_post->post_parent);
				$parent = $grandparent_post->post_parent;
			    //$parent =
		    }
		    else {
			    if( empty($wp_query->post->post_parent) ) {
			      $parent = $wp_query->post->ID;
			    } else {
			      $parent = $wp_query->post->post_parent;
			    }
		    }
	
	
		    $title = get_the_title($parent);
	
		    if(wp_list_pages("title_li=&child_of=$parent&echo=0" )) {
			
		      echo '<ul>';
		      wp_list_pages("title_li=&child_of=$parent&echo=1" );
		      echo '</ul>';
	
		    } 
		}
	}
}

add_action('veuse_subnav', 'veuse_submenu_fallback');


/* For getting page depths 
============================================= */

if(!function_exists('get_depth')){
	function get_depth($id = '', $depth = '', $i = 0){
		global $wpdb;
	
		if($depth == ''){
			if(is_page()){
				if($id == ''){
					global $post;
					$id = $post->ID;
				}
				$depth = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = '".$id."'");
				return get_depth($id, $depth, $i);
			}
			elseif(is_category()){
	
				if($id == ''){
					global $cat;
					$id = $cat;
				}
				$depth = $wpdb->get_var("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = '".$id."'");
				return get_depth($id, $depth, $i);
			}
			elseif(is_single())	{
				if($id == ''){
					$category = get_the_category();
					$id = $category[0]->cat_ID;
				}
				$depth = $wpdb->get_var("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = '".$id."'");
				return get_depth($id, $depth, $i);
			}
		}
		elseif($depth == '0'){
			return $i;
		}
		elseif(is_single() || is_category()){
			$depth = $wpdb->get_var("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = '".$depth."'");
			$i++;
			return get_depth($id, $depth, $i);
		}
		elseif(is_page()){
			$depth = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = '".$depth."'");
			$i++;
			return get_depth($id, $depth, $i);
		}
	}

}

/* 	Counts sidebar widgets for calculations 
============================================= */
if(!function_exists('count_sidebar_widgets')){
	function count_sidebar_widgets( $sidebar_id, $echo = true ) {
	    $the_sidebars = wp_get_sidebars_widgets();
	    if( !isset( $the_sidebars[$sidebar_id] ) )
	        return __( 'Invalid sidebar ID','veuse' );
	    if( $echo )
	        echo count( $the_sidebars[$sidebar_id] );
	    else
	        return count( $the_sidebars[$sidebar_id] );
	}
}


/* For getting page depths */

if(!function_exists('get_depth')){
	function get_depth($id = '', $depth = '', $i = 0){
		global $wpdb;
	
		if($depth == ''){
			if(is_page()){
				if($id == ''){
					global $post;
					$id = $post->ID;
				}
				$depth = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = '".$id."'");
				return get_depth($id, $depth, $i);
			}
			elseif(is_category()){
	
				if($id == ''){
					global $cat;
					$id = $cat;
				}
				$depth = $wpdb->get_var("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = '".$id."'");
				return get_depth($id, $depth, $i);
			}
			elseif(is_single())	{
				if($id == ''){
					$category = get_the_category();
					$id = $category[0]->cat_ID;
				}
				$depth = $wpdb->get_var("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = '".$id."'");
				return get_depth($id, $depth, $i);
			}
		}
		elseif($depth == '0'){
			return $i;
		}
		elseif(is_single() || is_category()){
			$depth = $wpdb->get_var("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = '".$depth."'");
			$i++;
			return get_depth($id, $depth, $i);
		}
		elseif(is_page()){
			$depth = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = '".$depth."'");
			$i++;
			return get_depth($id, $depth, $i);
		}
	}

}




/* Add extra classes to body 
============================================= */

if(!function_exists('veuse_body_class')){

	function veuse_body_class($classes){

		global $veuse, $post;
		
		//$classes[] = $options['layout'];

		if(is_page() || is_singular()) {

		$layout = '';
		$submenu = '';

		/* Only add layout-classes if page tempate is NOT set to template-left or template-right */

		$current_template = basename( get_page_template());
		
		
		
		/* If on a page */
		if( is_page() ){
			
			if ( $current_template == 'page.php' ) 
			{
				isset( $veuse['page_layout']) ? $layout = $veuse['page_layout'] : $layout = 'sidebar-right';
			}
	
			elseif ( $current_template == 'template-sidebar-left.php' )
			{
					$layout = 'sidebar-left';
			} 
			
			elseif ( $current_template == 'template-sidebar-right.php' )
			{
					$layout = 'sidebar-right';
			}
			
			elseif ( $current_template == 'template-fullwidth.php' )
			{
					$layout = 'fullwidth';
			}
			
		}
		
		elseif ( is_single() ){
			
			isset( $veuse['post_layout']) ? $layout = $veuse['post_layout'] : $layout = 'sidebar-right';
			
		}
				
		/* Get post meta for page elements */
		if(function_exists('rwmb_meta'))
		$page_elements = rwmb_meta( 'veuse_page_elements', 'type=checkbox_list' );
		
		$children = get_pages('child_of='.$post->ID);
		
		if (isset($page_elements) && in_array('submenu', $page_elements)  && count( $children ) != 0 ) {
			$submenu = 'has-submenu';
			$classes[] = $submenu;
			}
		}
		
		if ( is_home() || is_archive() || is_tag() || is_category() || is_404() ) {
			
			isset( $veuse['blog_layout']) ? $layout = $veuse['blog_layout'] : $layout = 'sidebar-right';
			
		}
		
		if( isset($veuse['site_layout']))
			$site_layout = $veuse['site_layout'];
		else 
			$site_layout = '';
		
		$classes[] = $layout;
		$classes[] = $site_layout;
		
		
		return $classes;
	}
}

add_filter('body_class', 'veuse_body_class');


/* Insert retina image 
============================================= */

if(!function_exists('veuse_retina_interchange_image')){

	function veuse_retina_interchange_image($img_url, $width, $height, $crop){

		$imagepath = '<img src="'. mr_image_resize($img_url, $width, $height, $crop, 'c', false) .'" data-interchange="['. mr_image_resize($img_url, $width, $height, $crop, 'c', true) .', (retina)]" />';
	
		return $imagepath;
	
	}
}

/* Get image id from source
============================================= */

function get_attachment_id_from_src ($image_src) {

	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	return $id;

}

/**
 * Breadcrumb Trail - A breadcrumb menu script for WordPress.
 *
 * Breadcrumb Trail is a script for showing a breadcrumb trail for any type of page.  It tries to anticipate
 * any type of structure and display the best possible trail that matches your site's permalink structure.
 * While not perfect, it attempts to fill in the gaps left by many other breadcrumb scripts.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package BreadcrumbTrail
 * @version 0.4.1
 * @author Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright � 2008 - 2011, Justin Tadlock
 * @link http://justintadlock.com/archives/2009/04/05/breadcrumb-trail-wordpress-plugin
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


/**
 * Shows a breadcrumb for all types of pages.  This function is formatting the final output of the
 * breadcrumb trail.  The veuse_breadcrumb_trail_get_items() function returns the items and this function
 * formats those items.
 *
 * @since 0.1.0
 * @param array $args Mixed arguments for the menu.
 * @return string Output of the breadcrumb menu.

 <ul class="breadcrumbs">
  <li><a href="#">Home</a></li>
  <li><a href="#">Features</a></li>
  <li class="unavailable"><a href="#">Gene Splicing</a></li>
  <li class="current"><a href="#">Home</a></li>
</ul>

 */

if(!function_exists('veuse_breadcrumbs')){
	function veuse_breadcrumbs( $args = array() ) {

		/* Create an empty variable for the breadcrumb. */
		$breadcrumb = '';

		/* Set up the default arguments for the breadcrumb. */
		$defaults = array(
			'separator' => '',
			'before' => '',
			'after' => '',
			'front_page' => false,
			'show_home' => __( 'Home', 'veuse' ),
			'echo' => false
		);

		/* Allow singular post views to have a taxonomy's terms prefixing the trail. */
		if ( is_singular() ) {
			$post = get_queried_object();
			$defaults["singular_{$post->post_type}_taxonomy"] = false;
		}

		/* Apply filters to the arguments. */
		$args = apply_filters( 'breadcrumb_trail_args', $args );

		/* Parse the arguments and extract them for easy variable naming. */
		$args = wp_parse_args( $args, $defaults );

		/* Get the trail items. */
		$trail = veuse_breadcrumb_trail_get_items( $args );

		/* Connect the breadcrumb trail if there are items in the trail. */
		if ( !empty( $trail ) && is_array( $trail ) ) {

			/* Open the breadcrumb trail containers. */
			$breadcrumb = '<ul class="breadcrumbs">';

			/* If $before was set, wrap it in a container. */
			$breadcrumb .= ( !empty( $args['before'] ) ? '<li class="trail-before">' . $args['before'] . '</li> ' : '' );

			/* Wrap the $trail['trail_end'] value in a container. */
			if ( !empty( $trail['trail_end'] ) )
				$trail['trail_end'] = '<li class="current"><a href="#">' . $trail['trail_end'] . '</a></li>';

			/* Format the separator. */
			$separator = ( !empty( $args['separator'] ) ? '<li class="sep">' . $args['separator'] . '</li>' : '' );

			/* Join the individual trail items into a single string. */
			$breadcrumb .= join( " {$separator} ", $trail );

			/* If $after was set, wrap it in a container. */
			$breadcrumb .= ( !empty( $args['after'] ) ? ' <li class="trail-after">' . $args['after'] . '</li>' : '' );

			/* Close the breadcrumb trail containers. */
			$breadcrumb .= '</ul>';
		}

		/* Allow developers to filter the breadcrumb trail HTML. */
		$breadcrumb = apply_filters( 'breadcrumb_trail', $breadcrumb, $args );

		/* Output the breadcrumb. */
		if ( $args['echo'] )
			echo $breadcrumb;
		else
			return $breadcrumb;
	}
}

/**
 * Gets the items for the breadcrumb trail.  This is the heart of the script.  It checks the current page
 * being viewed and decided based on the information provided by WordPress what items should be
 * added to the breadcrumb trail.
 *
 * @since 0.4.0
 * @todo Build in caching based on the queried object ID.
 * @param array $args Mixed arguments for the menu.
 * @return array List of items to be shown in the trail.
 */
if(!function_exists('veuse_breadcrumb_trail_get_items')){
	function veuse_breadcrumb_trail_get_items( $args = array() ) {
		global $wp_rewrite;



		/* Set up an empty trail array and empty path. */
		$trail = array();
		$path = '';

		/* If $show_home is set and we're not on the front page of the site, link to the home page. */
		if ( !is_front_page() && $args['show_home'] )
			$trail[] = '<li><a href="' . home_url() . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" class="trail-begin">' . $args['show_home'] . '</a></li>';

		/* If viewing the front page of the site. */
		if ( is_front_page() ) {
			if ( $args['show_home'] && $args['front_page'] )
				$trail['trail_end'] = "{$args['show_home']}";
		}

		/* If viewing the "home"/posts page. */
		else if ( is_home() ) {
			$home_page = get_page( get_queried_object_id() );
			$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( $home_page->post_parent, '' ) );
			$trail['trail_end'] = get_the_title( $home_page->ID );
		}

		/* If viewing a singular post (page, attachment, etc.). */
		elseif ( is_singular() ) {

			/* Get singular post variables needed. */
			$post = get_queried_object();
			$post_id = absint( get_queried_object_id() );
			$post_type = $post->post_type;
			$parent = absint( $post->post_parent );

			/* Get the post type object. */
			$post_type_object = get_post_type_object( $post_type );

			/* If viewing a singular 'post'. */
			if ( 'post' == $post_type ) {

				/* If $front has been set, add it to the $path. */
				$path .= trailingslashit( $wp_rewrite->front );

				/* If there's a path, check for parents. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( '', $path ) );

				/* Map the permalink structure tags to actual links. */
				$trail = array_merge( $trail, veuse_breadcrumb_trail_map_rewrite_tags( $post_id, get_option( 'permalink_structure' ), $args ) );
			}

			/* If viewing a singular 'attachment'. */
			else if ( 'attachment' == $post_type ) {

				/* If $front has been set, add it to the $path. */
				$path .= trailingslashit( $wp_rewrite->front );

				/* If there's a path, check for parents. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( '', $path ) );

				/* Map the post (parent) permalink structure tags to actual links. */
				$trail = array_merge( $trail, veuse_breadcrumb_trail_map_rewrite_tags( $post->post_parent, get_option( 'permalink_structure' ), $args ) );
			}

			/* If a custom post type, check if there are any pages in its hierarchy based on the slug. */
			elseif ( 'page' !== $post_type ) {

				/* If $front has been set, add it to the $path. */
				if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front )
					$path .= trailingslashit( $wp_rewrite->front );

				/* If there's a slug, add it to the $path. */
				if ( !empty( $post_type_object->rewrite['slug'] ) )
					$path .= $post_type_object->rewrite['slug'];

				/* If there's a path, check for parents. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( '', $path ) );

				/* If there's an archive page, add it to the trail. */
				if ( !empty( $post_type_object->has_archive ) )
					$trail[] = '<li><a href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . $post_type_object->labels->name . '</a><li>';
			}

			/* If the post type path returns nothing and there is a parent, get its parents. */
			if ( ( empty( $path ) && 0 !== $parent ) || ( 'attachment' == $post_type ) )
				$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( $parent, '' ) );

			/* Or, if the post type is hierarchical and there's a parent, get its parents. */
			elseif ( 0 !== $parent && is_post_type_hierarchical( $post_type ) )
				$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( $parent, '' ) );

			/* Display terms for specific post type taxonomy if requested. */
			if ( !empty( $args["singular_{$post_type}_taxonomy"] ) && $terms = get_the_term_list( $post_id, $args["singular_{$post_type}_taxonomy"], '', ', ', '' ) )
				$trail[] = $terms;

			/* End with the post title. */
			$post_title = get_the_title();
			if ( !empty( $post_title ) )
				$trail['trail_end'] = $post_title;
		}

		/* If we're viewing any type of archive. */
		else if ( is_archive() ) {

			/* If viewing a taxonomy term archive. */
			if ( is_tax() || is_category() || is_tag() ) {

				/* Get some taxonomy and term variables. */
				$term = get_queried_object();
				$taxonomy = get_taxonomy( $term->taxonomy );

				/* Get the path to the term archive. Use this to determine if a page is present with it. */
				if ( is_category() )
					$path = get_option( 'category_base' );
				else if ( is_tag() )
					$path = get_option( 'tag_base' );
				else {
					if ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front )
						$path = trailingslashit( $wp_rewrite->front );
					$path .= $taxonomy->rewrite['slug'];
				}

				/* Get parent pages by path if they exist. */
				if ( $path )
					$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( '', $path ) );

				/* If the taxonomy is hierarchical, list its parent terms. */
				if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent )
					$trail = array_merge( $trail, breadcrumb_trail_get_term_parents( $term->parent, $term->taxonomy ) );

				/* Add the term name to the trail end. */
				$trail['trail_end'] = single_term_title( '', false );
			}

			/* If viewing a post type archive. */
			else if ( is_post_type_archive() ) {

				/* Get the post type object. */
				$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

				/* If $front has been set, add it to the $path. */
				if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front )
					$path .= trailingslashit( $wp_rewrite->front );

				/* If there's a slug, add it to the $path. */
				if ( !empty( $post_type_object->rewrite['slug'] ) )
					$path .= $post_type_object->rewrite['slug'];

				/* If there's a path, check for parents. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( '', $path ) );

				/* Add the post type [plural] name to the trail end. */
				$trail['trail_end'] = $post_type_object->labels->name;
			}

			/* If viewing an author archive. */
			else if ( is_author() ) {

				/* If $front has been set, add it to $path. */
				if ( !empty( $wp_rewrite->front ) )
					$path .= trailingslashit( $wp_rewrite->front );

				/* If an $author_base exists, add it to $path. */
				if ( !empty( $wp_rewrite->author_base ) )
					$path .= $wp_rewrite->author_base;

				/* If $path exists, check for parent pages. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( '', $path ) );

				/* Add the author's display name to the trail end. */
				$trail['trail_end'] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
			}

			/* If viewing a time-based archive. */
			else if ( is_time() ) {

				if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
					$trail['trail_end'] = get_the_time( __( 'g:i a', 'veuse' ) );

				else if ( get_query_var( 'minute' ) )
					$trail['trail_end'] = sprintf( __( 'Minute %1$s', 'veuse' ), get_the_time( __( 'i', 'veuse' ) ) );

				else if ( get_query_var( 'hour' ) )
					$trail['trail_end'] = get_the_time( __( 'g a', 'veuse' ) );
			}

			/* If viewing a date-based archive. */
			elseif ( is_date() ) {

				/* If $front has been set, check for parent pages. */
				if ( $wp_rewrite->front )
					$trail = array_merge( $trail, veuse_breadcrumb_trail_get_parents( '', $wp_rewrite->front ) );

				if ( is_day() ) {
					$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'veuse' ) ) . '">' . get_the_time( __( 'Y', 'veuse' ) ) . '</a>';
					$trail[] = '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( esc_attr__( 'F', 'veuse' ) ) . '">' . get_the_time( __( 'F', 'veuse' ) ) . '</a>';
					$trail['trail_end'] = get_the_time( __( 'd', 'veuse' ) );
				}

				else if ( get_query_var( 'w' ) ) {
					$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'veuse' ) ) . '">' . get_the_time( __( 'Y', 'veuse' ) ) . '</a>';
					$trail['trail_end'] = sprintf( __( 'Week %1$s', 'veuse' ), get_the_time( esc_attr__( 'W', 'veuse' ) ) );
				}

				else if ( is_month() ) {
					$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'veuse' ) ) . '">' . get_the_time( __( 'Y', 'veuse' ) ) . '</a>';
					$trail['trail_end'] = get_the_time( __( 'F', 'veuse' ) );
				}

				else if ( is_year() ) {
					$trail['trail_end'] = get_the_time( __( 'Y', 'veuse' ) );
				}
			}
		}

		/* If viewing search results. */
		else if ( is_search() )
			$trail['trail_end'] = sprintf( __( 'Search results for &quot;%1$s&quot;', 'veuse' ), esc_attr( get_search_query() ) );

		/* If viewing a 404 error page. */
		elseif ( is_404() )
			$trail['trail_end'] = __( '404 Not Found', 'veuse' );

		/* Allow devs to step in and filter the $trail array. */
		return apply_filters( 'breadcrumb_trail_items', $trail, $args );
	}
}

/**
 * Turns %tag% from permalink structures into usable links for the breadcrumb trail.  This feels kind of
 * hawkish for now because we're checking for specific %tag% examples and only doing it for the 'post'
 * post type.  In the future, maybe it'll handle a wider variety of possibilities, especially for custom post
 * types.
 *
 * @since 0.4.0
 * @param int $post_id ID of the post whose parents we want.
 * @param string $path Path of a potential parent page.
 * @param array $args Mixed arguments for the menu.
 * @return array $trail Array of links to the post breadcrumb.
 */
if(!function_exists('veuse_breadcrumb_trail_map_rewrite_tags')){
	function veuse_breadcrumb_trail_map_rewrite_tags( $post_id = '', $path = '', $args = array() ) {

		/* Set up an empty $trail array. */
		$trail = array();

		/* Make sure there's a $path and $post_id before continuing. */
		if ( empty( $path ) || empty( $post_id ) )
			return $trail;

		/* Get the post based on the post ID. */
		$post = get_post( $post_id );

		/* If no post is returned, an error is returned, or the post does not have a 'post' post type, return. */
		if ( empty( $post ) || is_wp_error( $post ) || 'post' !== $post->post_type )
			return $trail;


		/* Trim '/' from both sides of the $path. */
		$path = trim( $path, '/' );

		/* Split the $path into an array of strings. */
		$matches = explode( '/', $path );

		/* If matches are found for the path. */
		if ( is_array( $matches ) ) {

			/* Loop through each of the matches, adding each to the $trail array. */
			foreach ( $matches as $match ) {

				/* Trim any '/' from the $match. */
				$tag = trim( $match, '/' );

				/* If using the %year% tag, add a link to the yearly archive. */
				if ( '%year%' == $tag )
					$trail[] = '<li><a href="' . get_year_link( get_the_time( 'Y', $post_id ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'veuse' ), $post_id ) . '">' . get_the_time( __( 'Y', 'veuse' ), $post_id ) . '</a></li>';

				/* If using the %monthnum% tag, add a link to the monthly archive. */
				elseif ( '%monthnum%' == $tag )
					$trail[] = '<li><a href="' . get_month_link( get_the_time( 'Y', $post_id ), get_the_time( 'm', $post_id ) ) . '" title="' . get_the_time( esc_attr__( 'F Y', 'veuse' ), $post_id ) . '">' . get_the_time( __( 'F', 'veuse'), $post_id ) . '</a></li>';

				/* If using the %day% tag, add a link to the daily archive. */
				elseif ( '%day%' == $tag )
					$trail[] = '<a href="' . get_day_link( get_the_time( 'Y', $post_id ), get_the_time( 'm', $post_id ), get_the_time( 'd', $post_id ) ) . '" title="' . get_the_time( esc_attr__( 'F j, Y', 'veuse' ), $post_id ) . '">' . get_the_time( __( 'd', 'veuse' ), $post_id ) . '</a>';

				/* If using the %author% tag, add a link to the post author archive. */
				elseif ( '%author%' == $tag )
					$trail[] = '<a href="' . get_author_posts_url( $post->post_author ) . '" title="' . esc_attr( get_the_author_meta( 'display_name', $post->post_author ) ) . '">' . get_the_author_meta( 'display_name', $post->post_author ) . '</a>';

				/* If using the %category% tag, add a link to the first category archive to match permalinks. */
				elseif ( '%category%' == $tag && 'category' !== $args["singular_{$post->post_type}_taxonomy"] ) {

					/* Get the post categories. */
					$terms = get_the_category( $post_id );

					/* Check that categories were returned. */
					if ( $terms ) {

						/* Sort the terms by ID and get the first category. */
						usort( $terms, '_usort_terms_by_ID' );
						$term = get_term( $terms[0], 'category' );

						/* If the category has a parent, add the hierarchy to the trail. */
						if ( 0 !== $term->parent )
							$trail = array_merge( $trail, breadcrumb_trail_get_term_parents( $term->parent, 'category' ) );

						/* Add the category archive link to the trail. */
						$trail[] = '<li><a href="' . get_term_link( $term, 'category' ) . '" title="' . esc_attr( $term->name ) . '">' . $term->name . '</a></li>';
					}
				}
			}
		}

		/* Return the $trail array. */
		return $trail;
	}
}
/**
 * Gets parent pages of any post type or taxonomy by the ID or Path.  The goal of this function is to create
 * a clear path back to home given what would normally be a "ghost" directory.  If any page matches the given
 * path, it'll be added.  But, it's also just a way to check for a hierarchy with hierarchical post types.
 *
 * @since 0.3.0
 * @param int $post_id ID of the post whose parents we want.
 * @param string $path Path of a potential parent page.
 * @return array $trail Array of parent page links.
 */
function veuse_breadcrumb_trail_get_parents( $post_id = '', $path = '' ) {

	/* Set up an empty trail array. */
	$trail = array();

	/* Trim '/' off $path in case we just got a simple '/' instead of a real path. */
	$path = trim( $path, '/' );

	/* If neither a post ID nor path set, return an empty array. */
	if ( empty( $post_id ) && empty( $path ) )
		return $trail;

	/* If the post ID is empty, use the path to get the ID. */
	if ( empty( $post_id ) ) {

		/* Get parent post by the path. */
		$parent_page = get_page_by_path( $path );

		/* If a parent post is found, set the $post_id variable to it. */
		if ( !empty( $parent_page ) )
			$post_id = $parent_page->ID;
	}

	/* If a post ID and path is set, search for a post by the given path. */
	if ( $post_id == 0 && !empty( $path ) ) {

		/* Separate post names into separate paths by '/'. */
		$path = trim( $path, '/' );
		preg_match_all( "/\/.*?\z/", $path, $matches );

		/* If matches are found for the path. */
		if ( isset( $matches ) ) {

			/* Reverse the array of matches to search for posts in the proper order. */
			$matches = array_reverse( $matches );

			/* Loop through each of the path matches. */
			foreach ( $matches as $match ) {

				/* If a match is found. */
				if ( isset( $match[0] ) ) {

					/* Get the parent post by the given path. */
					$path = str_replace( $match[0], '', $path );
					$parent_page = get_page_by_path( trim( $path, '/' ) );

					/* If a parent post is found, set the $post_id and break out of the loop. */
					if ( !empty( $parent_page ) && $parent_page->ID > 0 ) {
						$post_id = $parent_page->ID;
						break;
					}
				}
			}
		}
	}

	/* While there's a post ID, add the post link to the $parents array. */
	while ( $post_id ) {

		/* Get the post by ID. */
		$page = get_page( $post_id );

		/* Add the formatted post link to the array of parents. */
		$parents[]  = '<li><a href="' . get_permalink( $post_id ) . '" title="' .  esc_attr( get_the_title( $post_id )). '">' . get_the_title( $post_id ) . '</a></li>';

		/* Set the parent post's parent to the post ID. */
		$post_id = $page->post_parent;
	}

	/* If we have parent posts, reverse the array to put them in the proper order for the trail. */
	if ( isset( $parents ) )
		$trail = array_reverse( $parents );

	/* Return the trail of parent posts. */
	return $trail;
}

/**
 * Searches for term parents of hierarchical taxonomies.  This function is similar to the WordPress
 * function get_category_parents() but handles any type of taxonomy.
 *
 * @since 0.3.0
 * @param int $parent_id The ID of the first parent.
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 * @return array $trail Array of links to parent terms.
 */
function breadcrumb_trail_get_term_parents( $parent_id = '', $taxonomy = '' ) {

	/* Set up some default arrays. */
	$trail = array();
	$parents = array();

	/* If no term parent ID or taxonomy is given, return an empty array. */
	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return $trail;

	/* While there is a parent ID, add the parent term link to the $parents array. */
	while ( $parent_id ) {

		/* Get the parent term. */
		$parent = get_term( $parent_id, $taxonomy );

		/* Add the formatted term link to the array of parent terms. */
		$parents[] = '<li><a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a></li>';

		/* Set the parent term's parent as the parent ID. */
		$parent_id = $parent->parent;
	}

	/* If we have parent terms, reverse the array to put them in the proper order for the trail. */
	if ( !empty( $parents ) )
		$trail = array_reverse( $parents );

	/* Return the trail of parent terms. */
	return $trail;
}

/**
 * Returns the text domain used by the script and allows it to be filtered by plugins/themes.
 *
 * @since 0.4.0
 * @returns string The text domain for the script.
 */
function veuse_breadcrumb_trail_textdomain() {
	return apply_filters( 'veuse_breadcrumb_trail_textdomain', 'veuse' );
}



/* Creates page excerpts for use in loops etc.
====================================================== */
if(!function_exists('veuse_excerpt')){
	
	function veuse_excerpt($args) {

		global $post;
		
		extract($args);
		
		if(empty($link)){ $link = '';}
		if(empty($excerptlimit)){ $excerptlimit = '';}
		
		if( $page_id == null ) return false;
		
		$page_data 	= get_page( $page_id );
		$page_excerpt = $page_data->post_excerpt;
		$page_content = $page_data->post_content;
		
		if(!empty($page_content)){
				$limit = strpos( $page_content, "<!--more-->", 1);
				$val =  substr($page_content, 0, $limit);
		}
		
		
		$output = '';

		if(!empty($page_excerpt))
		{

		  	if($excerptlimit){
		  	$stringlength = strlen($page_excerpt) - 4;


		  	if ($stringlength  > $excerptlimit) {
			$page_excerpt = substr($page_excerpt,0,strpos($page_excerpt, ' ', $excerptlimit));
			$page_excerpt = $page_excerpt.' ';
			} else {
			$page_excerpt = $page_excerpt;
			}
			}
			$output .= apply_filters('the_excerpt',$page_excerpt);
		  	$output.=  '<a href="'.get_permalink($page_id).'" class="'.$link.'">'.$string.'</a>';
	
	
		  	return $output;
		}
		
		// If page has more-quicktag, echo up to <!--more-->
	
		elseif(!empty($limit))
		{
			 $output .= wpautop(do_shortcode($val));
			 $output.=  '<a href="'.get_permalink($page_id).'" class="'.$link.'">'.$string.'</a>';
			 return $output;
		}

	  // Else echo the content in full

	  else 
	  {
	  	return wpautop(do_shortcode($page_content));
	  }
	}
}

/* Related posts
========================================================= */

function veuse_related_posts( $posttype, $taxonomy, $perpage, $columnsSmall, $columnsLarge) {

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
		    $output.= '<ul class="small-block-grid-'.$columnsSmall.' large-block-grid-'.$columnsLarge.' '.$posttype.'-list">';
		
		    while ($my_query->have_posts() && $count < $perpage) {
		    
		    		$my_query->the_post();

		            $output.= '<li><div class="'.$posttype.'-entry">';
		            
		            if(has_post_thumbnail()):
		               $img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		               $output .= '<div class="entry-thumbnail"><a href="' . get_permalink() . '"><span class="overlay"></span>'. veuse_retina_interchange_image( $img_url, 100, 100, true) .'</a></div>';
		            endif;

		             $output.= '<div class="entry-data"><h4><a href="' . get_permalink() . '">'.get_the_title($post->ID).'</a></h4>';
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

/* Filter the default wp-gallery to display images in lightbox etc.
========================================================================= */

if(!function_exists('veuse_post_gallery')){

	function veuse_post_gallery( $output, $attr) {
	    global $post, $wp_locale;

	    static $instance = 0;
	    $instance++;

	    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	    if ( isset( $attr['orderby'] ) ) {
	        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	        if ( !$attr['orderby'] )
	            unset( $attr['orderby'] );
	    }

	    extract(shortcode_atts(array(
	        'order'      => 'ASC',
	        'orderby'    => 'menu_order ID',
	        'id'         => $post->ID,
	        'itemtag'    => 'dl',
	        'icontag'    => 'dt',
	        'captiontag' => 'dd',
	        'columns'    => 3,
	        'size'       => 'large',
	        'include'    => '',
	        'exclude'    => ''
	    ), $attr));


	    $id = intval($id);
	    if ( 'RAND' == $order )
	        $orderby = 'none';

	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    } else {
	        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    }

	    if ( empty($attachments) )
	        return '';

	    if ( is_feed() ) {
	        $output = "\n";
	        foreach ( $attachments as $att_id => $attachment )
	            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
	        return $output;
	    }

	    $itemtag = tag_escape($itemtag);
	    $captiontag = '<span>'.tag_escape($captiontag).'</span>';
	    $columns = intval($columns);
	    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	    $float = is_rtl() ? 'right' : 'left';
	    
	    global $content_width;
	    
	    switch ($columns) {

		    case 1:
		    $imagewidth = $content_width;
		    $imageheight = $content_width * 0.6;
		    break;

		    case 2:
		    $imagewidth = $content_width/2;
		    $imageheight = $content_width/2 * 0.6;
		    break;

		    case 3:
		    $imagewidth = $content_width/3;
		    $imageheight = $content_width/3 * 0.6;
		    break;

		    case 4:
		    $imagewidth = $content_width/3;
		    $imageheight = $content_width/3 * 0.6;
		    break;

		    case 5:
		    $imagewidth = $content_width/3;
		    $imageheight = $content_width/3 * 0.6;
		    break;

		    case 6:
		    $imagewidth = $content_width/3;
		    $imageheight = $content_width/3 * 0.6;
		    break;

		    case 7:
		    $imagewidth = $content_width/3;
		    $imageheight = $content_width/3 * 0.6;
		    break;

		    case 8:
		    $imagewidth = $content_width/3;
		    $imageheight = $content_width/3 * 0.6;
		    break;

		    case 9:
		    $imagewidth = $content_width/3;
		    $imageheight = $content_width/3 * 0.6;
		    break;

	    }


	    $selector = "gallery-{$instance}";

	    $output = apply_filters('gallery_style', "
	        <!-- see gallery_shortcode() in wp-includes/media.php -->
	        <ul id='$selector' class='veuse-gallery small-block-grid-1 large-block-grid-$columns galleryid-{$id} '>");

	    $i = 0;
	    foreach ( $attachments as $id => $attachment ) {

	    	$image =  wp_get_attachment_image_src($id, 'large');
	    	$image_url = get_attachment_link($id);

	        //$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

	        $output .= "<li>";
	        $output .= "<{$icontag} class='gallery-icon'>";

	        if(isset($attr['link']) && 'file' == $attr['link']){

		        $output .= '<a href="'.$image[0].'" title="'. wptexturize($attachment->post_excerpt) . '" data-rel="lightbox">'. 	veuse_retina_interchange_image( $image[0], $imagewidth, $imageheight, true);

		         if ( $captiontag && trim($attachment->post_excerpt) ) {
		            $output .= '<span class="gallery-caption">' . wptexturize($attachment->post_excerpt) . '</span>';
		        }
				$output .= "<span class='zoom'></span>";
		        $output .= "</a>";


	        }  else {

		         $output .= '<a href="'.$image_url.'">' .veuse_retina_interchange_image( $image[0], $imagewidth, $imageheight, true). '</a>';

	        }

	        $output .= "</{$icontag}>";

			/*
	        if ( $captiontag && trim($attachment->post_excerpt) ) {
	            $output .= "
	                <{$captiontag} class='gallery-caption'>
	                " . wptexturize($attachment->post_excerpt) . "
	                </{$captiontag}>";
	        }
	        */
	        $output .= "</li>";
	        //if ( $columns > 0 && ++$i % $columns == 0 )
	           // $output .= '<br style="clear: both" />';
	    }

	    $output .= "</ul>\n";

	    return $output;
	}

	add_filter( 'post_gallery', 'veuse_post_gallery', 10, 2 );
}

/* Pagination
================================================ */
if(!function_exists('veuse_pagination')){
	function veuse_pagination() {

	    global $wp_query, $wp_rewrite;

	    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	    $pagination = array(
	    	'base' => @add_query_arg('paged', '%#%'),
	    	'format' => '',
	    	'total' => $wp_query->max_num_pages,
	    	'current' => $current,
	    	'show_all' => true,
	    	'prev_next' => True,
	    	'prev_text' => '<i class="fa fa-angle-left"></i>',
	    	'next_text' => '<i class="fa fa-angle-right"></i> ',
	    	'type' => 'plain'
	    	);

	    if ($wp_rewrite->using_permalinks())
	    	$pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
	    if (!empty($wp_query->query_vars['s']))
	    	$pagination['add_args'] = array('s' => get_query_var('s'));

	    return '<div id="pager">'.paginate_links($pagination).'</div>';

	}
}

/* Post pagination between posts
================================================ */

if(!function_exists('veuse_post_pagination')){
	
	function veuse_post_pagination(){
	
		$args = array(
		'before'           => '<div class="post-pagination-wrap">',
		'after'            => '</div>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'text',
		'nextpagelink'     => __('Continue reading','ceon').' <i class="icon-angle-right"></i> ',
		'previouspagelink' => '<i class="icon-angle-left"></i> '.__('Go back ', 'ceon').'',
		'pagelink'         => '%',
		'more_file'        => '',
		'echo'             => 1 );
		
		 wp_link_pages( $args);
	}
}
?>