<?php
global $post, $veuse;

if(is_page() || is_singular() ){

	$sidebar_id = get_post_meta($post->ID, '_page_sidebar', true);

	if($sidebar_id && $sidebar_id != 'default_sidebar'){ $sidebar = 'veuse-sidebar-'.$sidebar_id; } else { $sidebar = 'default_sidebar';}
}

elseif (is_home()) {	
	$sidebar = $veuse['sidebar-blog'];
	
}

elseif (is_category()) {	
	$sidebar = $veuse['sidebar-category'];
}
elseif (is_archive()) {	
	$sidebar = $veuse['sidebar-archive'];
}
elseif (is_search()) {	
	$sidebar = $veuse['sidebar-search'];
}

else{
	$sidebar = 'default_sidebar';
}

//echo $sidebar;

if ( $sidebar ){
	
	/* Insert sub-navigation in sidebar */
	if(is_page() || is_single()){
		
		get_template_part('content','subnav');
	
	}

	dynamic_sidebar($sidebar);

}
?>