<?php
if(function_exists('rwmb_meta')) {
	$audio_src = rwmb_meta( 'veuse_audio_src' );
	$audio = rwmb_meta( 'veuse_audio_embed','type=url' );
	$audiolist = rwmb_meta( 'veuse_audio_files','type=file_advanced' );
}	
		
	if(isset($audio) && $audio_src == 'embed'){
			$audiourl = '[audio src="'.$audio .'"]';
			$htmlcode = apply_filters('the_content', $audiourl);
			
					
		}
		
	elseif(isset($audiolist) && $audio_src == 'self'){
			
			$audiourl= '[audio ';
			
			/* Loop through all files */
			foreach($audiolist as $audiofile) {
			
				$audiourl .= pathinfo($audiofile['path'], PATHINFO_EXTENSION);
				$audiourl .= '="'.$audiofile['url'].'" ';
			}
			
			$audiourl.= ']';
			
			$htmlcode = apply_filters('the_content', $audiourl);
			echo $htmlcode;
			
		}
		
		else {
			
			echo '<div class="alert-box alert">'. __('Post-format has been set to "Audio", but no audio source or audio file has not been specified.','veuse') .'</div>';
			
		}

$audio_src = null;
$audio = null;
$audiolist = null;
		
?>