<?php

if(is_page_template('template-fullwidth.php')) 
{	
	$width = VEUSE_FULLWIDTH_ARTICLE_WIDTH;
	$ratio = 0.50;
	$height = $width * $ratio;
}

else 
{	
	$width = VEUSE_ARTICLE_WIDTH;
	$ratio = 0.50;
	$height = $width * $ratio;
}

$crop = true;


if(function_exists('rwmb_meta')) {
	
	if(!isset($gallery_images))				$gallery_images = rwmb_meta( 'veuse_page_gallery','type=image_advanced' );
	if(!isset($gallery_type)) 				$gallery_type = rwmb_meta( 'veuse_gallery_type');
	if(!isset($gallery_grid)) 				$gallery_grid = rwmb_meta( 'veuse_gallery_grid');
	if(!isset($gallery_lightbox)) 			$gallery_lightbox = rwmb_meta( 'veuse_gallery_lightbox');
	if(!isset($gallery_image_title)) 		$gallery_image_title = rwmb_meta( 'veuse_gallery_image_title');
	if(!isset($gallery_image_description)) 	$gallery_image_description = rwmb_meta( 'veuse_gallery_image_description');
}

if(isset($gallery_type, $gallery_images, $gallery_grid)){
		
	if( $gallery_type == 'slideshow'){
	
		echo '<div class="flexslider veuse-gallery-format"><ul class="slides">';
		
		foreach ($gallery_images as $gallery_image){
			
			$img_url =  $gallery_image['full_url'];
			$img_title =  $gallery_image['title'];
			$img_description =  $gallery_image['description'];
			
			echo '<li>';
			echo $imagestring = veuse_retina_interchange_image( $img_url, $width, $height, $crop);
			
			if( (!empty($img_title) && $gallery_image_title == 1 ) || (!empty($img_description) && $gallery_image_description == 1) ) {
			
			echo '<div class="flex-caption"><div class="caption-inner">';
			if( !empty($img_title) && $gallery_image_title == 1){
			echo '<h4><span>'. $img_title.'</span></h4>';
			}
			if(!empty($img_description) && $gallery_image_description == 1){
			echo '<p>'. $img_description.'</p>';
			}
			echo '</div></div>';
			}
			echo '</li>';
		}
		
		echo '</ul></div>';
		
		?>
		
		<script type="text/javascript" charset="utf-8">
			jQuery(function($) {
				jQuery(".veuse-gallery-format").flexslider({
						directionNav: true,
						controlNav: false,
						animation: "fade",
						slideshowSpeed: 5000,
						slideshow: false,
						pauseOnHover: true,
						smoothHeight: true
								      
					});
			});
		</script>
		
		<?php
	}
	
	else {
	
		$width = VEUSE_FULLWIDTH_ARTICLE_WIDTH / $gallery_grid;
		$ratio = 0.60;
		$height = $width * $ratio;
		
		
		echo '<ul class="veuse-gallery small-block-grid-2 large-block-grid-'.$gallery_grid.'">';
		
		if(isset($gallery_images)){	
		
		foreach ($gallery_images as $gallery_image){
		
			
			$img_url =  $gallery_image['full_url'];
			$img_id =  get_attachment_id_from_src($img_url );
			$attachment_page = get_attachment_link($img_id);
			
			$img_title =  $gallery_image['title'];
			$img_description =  $gallery_image['description'];
			
			$imagestring = veuse_retina_interchange_image( $img_url, $width, $height, $crop);
				
			if(isset($gallery_lightbox) && $gallery_lightbox == 1){
				
				echo '<li><a href="'. $img_url .'" data-rel="lightbox">'. $imagestring .'</a>';
				
				if(!empty($img_title) && $gallery_image_title == 1){
					echo '<span class="title">'. $img_title.'</span>';
				}
				if(!empty($img_description) && $gallery_image_description == 1){
					echo '<span class="description">'. $img_description.'</span>';
				}
				
				echo '</li>';
			
			}
			
			else {
				
				echo '<li><a href="'. $attachment_page .'">'. $imagestring  .'</a>';
				
				if(!empty($img_title) && $gallery_image_title == 1){
					echo '<h3>'. $img_title.'</h3>';
				}
				if(!empty($img_description) && $gallery_image_description == 1){
					echo '<p>'. $img_description.'</p>';
				}
				
				echo '</li>';
			}
		}
			
		}
		
		echo '</ul>';
			
	}
	

	
	
}	
?>