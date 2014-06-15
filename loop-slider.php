

		<ul class="veuse-slider">
		<?php

		$counter = 0;
		$slidecount = get_post_meta($id,'veuse_slidecount',true);
		
		while($counter < $slidecount):

			$caption = get_post_meta($id, 'veuse_slide_'.$counter.'_caption', true);
			$subcaption = get_post_meta($id, 'veuse_slide_'.$counter.'_subcaption', true);
			$description = get_post_meta($id, 'veuse_slide_'.$counter.'_description', true);
			$link = get_post_meta($id, 'veuse_slide_'.$counter.'_link', true);
			$buttontext = get_post_meta($id, 'veuse_slide_'.$counter.'_linktext', true);
			$image = get_post_meta($id, 'veuse_slide_'.$counter.'_image', true);
			$image_src = wp_get_attachment_image_src($image, 'full');
			$position = get_post_meta($id, 'veuse_slide_'.$counter.'_position', true);
			$counter++;

			?>
			<li>
				<?php if($link):?><a href="<?php echo $link;?>"><?php endif;?>
				<?php echo veuse_retina_interchange_image( $image_src[0], $width, $height, true);	?>
				<?php if($link):?></a><?php endif;?>
				<?php if($caption || $description):?>

					<div class="slide-caption">
						<div class="slide-inner-caption">
							<div>
						<?php if($caption):?><h3><span><?php echo $caption;?></span></h3><?php endif;?>
						<!--<?php if($subcaption):?><h2 class="subheader"><?php echo $subcaption;?></h2><?php endif;?>-->
						<?php if($description):?><p><?php echo do_shortcode($description);?></p><?php endif;?>
						
						<?php //if($link && $buttontext):?>
						<!--<a href="<?php echo $link;?>" class="slide-link"><?php echo $buttontext;?></a>-->
						<?php //endif;?>
						</div></div>
					</div>
				<?php endif;?>
				
			</li>
		<?php endwhile; ?>
	</ul>
	



