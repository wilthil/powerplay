<?php


	if(is_page_template('template-fullwidth.php')) 
		{	
			$width = VEUSE_FULLWIDTH_ARTICLE_WIDTH;
			$ratio = 0.40;
			$height = $width * $ratio;
			$crop = true;
		}
		
		else 
		{	
			$width = VEUSE_ARTICLE_WIDTH;
			$ratio = 0.40;
			$height = $width * $ratio;
			$crop = true;
	}

	$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
	$fallback_img_url = get_stylesheet_directory_uri().'/images/fallback-featured.jpg';

	if(!empty($img_url)){
		echo '<div class="entry-media">';
		echo veuse_retina_interchange_image( $img_url, $width, $height, $crop);
		echo '</div>';
	}
	
	else{ 
		echo '<div class="entry-media">';
		echo veuse_retina_interchange_image( $fallback_img_url, 200, 200, $crop);
		echo '</div>';
	}



?>