<?php get_header();?>
	
	<?php if(have_posts()): the_post();?>	
			
			<?php get_template_part('content','page-title');?>
			
			<div class="row">
			
				
				<div id="post-content">
					<?php if ( wp_attachment_is_image( $post->ID ) ) : $att_image = wp_get_attachment_image_src( $post->ID, "full"); ?>
                        <div class="entry-media"><a href="<?php echo wp_get_attachment_url($post->ID); ?>" title="<?php the_title(); ?>" rel="attachment">
                        	<?php echo $imagestring = veuse_retina_interchange_image( wp_get_attachment_url($post->ID), VEUSE_FULLWIDTH_ARTICLE_WIDTH, 0, false);?></a>
                        </div>
<?php else : ?>
                        <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
<?php endif; ?>
						
				 		<?php if(!empty($post->post_excerpt))
				 				echo '<p class="lead">'.$post->post_excerpt .'</p>';
				 				
				 			if(!empty($post->post_content))
				 				echo '<p>'.$post->post_content .'</p>';
				 		 ?>		
				</div>			 	
				
				
			<?php 
				
			/* Only display sidebar on pages that are not set to full width */
			global $veuse;
				
			if ( isset($veuse) && isset($veuse['page_layout']) && $veuse['page_layout'] != 'fullwidth' ):?>
				<section id="sidebar">
					<?php get_sidebar();?>
				</section>
			<?php endif;?>
			
			</div>
		<?php endif;?>
		
<?php get_footer();?>