<?php

if(is_page()){
	
	if(function_exists('rwmb_meta')){
		$elements = rwmb_meta( 'veuse_page_elements', 'type=checkbox_list' );
		
		/* Check if image is set to be shown */
		if( in_array('image', $elements)){
			
			get_template_part('content','image');
		}
		/* Check if image is set to be shown */
		if( in_array('gallery', $elements)){
			
			get_template_part('format','gallery');
		}
		
		/* Check if image is set to be shown */
		if( in_array('video', $elements)){
			
			get_template_part('format','video');
		}
	}	
}

else{
	
	$format = get_post_format();
	
	if($format){
	
		echo '<div class="entry-media">';
		get_template_part('format', $format);
		echo '</div>';	
	
	}
}



?>
