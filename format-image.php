<?php


global $columns;


	

/* Define image-sizes */

if(is_page_template('template-fullwidth.php')) 
{	
	$width = VEUSE_FULLWIDTH_ARTICLE_WIDTH;
	$ratio = 0.40;
	$height = $width * $ratio;
	$crop = true;
}


else 
{	
	
	if ($columns == 1)
		$width = VEUSE_FULLWIDTH_ARTICLE_WIDTH;

	elseif ($columns == 2)
		$width = VEUSE_FULLWIDTH_ARTICLE_WIDTH/2;
	
	elseif ($columns == 3)
		$width = VEUSE_FULLWIDTH_ARTICLE_WIDTH/3;
		
	elseif ($columns == 4)
		$width = VEUSE_FULLWIDTH_ARTICLE_WIDTH/4;
	
	
	else 
		$width = VEUSE_FULLWIDTH_ARTICLE_WIDTH;
	
	
	$ratio = 0.40;
	$height = $width * $ratio;
	$crop = true;
}


$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
$fallback_img_url = get_stylesheet_directory_uri().'/images/fallback-featured.jpg';


		
if(!empty($img_url)){

	echo veuse_retina_interchange_image( $img_url, $width, $height, $crop);

}else{ 
	
	echo veuse_retina_interchange_image( $fallback_img_url, 200, 200, $crop);
	//echo '<div class="alert-box alert">'. __('Warning: Post-format has been set to "Image", but no featured image has been set.','veuse') .'</div>';
}
?>