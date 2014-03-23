<?php

if(function_exists('rwmb_meta')) {
	
	$video_src = rwmb_meta( 'veuse_video_src' );
	$video 	   = rwmb_meta( 'veuse_video_embed','type=url' );
	$videolist = rwmb_meta( 'veuse_video_files','type=file_advanced' );
		
	/* Embedded video */	
	if(isset($video) && $video_src == 'embed'){
		$videourl = '[veuse_video]'.$video .'[/veuse_video]';
		$htmlcode = apply_filters('the_content', $videourl);
		echo $htmlcode;					
	}
	
	/* Self hosted video */	
	elseif(isset($videolist) && $video_src == 'self'){
						
		$videourl= '[video width="960" height="535" ';
			
		/* Loop through all files */
		foreach($videolist as $videofile) {	
			$videourl .= pathinfo($videofile['path'], PATHINFO_EXTENSION);
			$videourl .= '="'.$videofile['url'].'" ';
		}
			
		$videourl.= ']';
			
		$htmlcode = apply_filters('the_content', $videourl);
		echo '<div class="video-wrapper">'.$htmlcode.'</div>';
			
	}
		
	else {
			
		echo '<div class="alert-box alert">'. __('Post-format has been set to "Video", but no video source or video file has not been specified.','veuse') .'</div>';
			
	}

	$video_src = null;
	$video = null;
	$videolist = null;

}

?>