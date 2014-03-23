<?php get_header();?>
		
<?php if(have_posts()): the_post();?>
			
<?php get_template_part('content','title');	?>	
			
	<div class="row">	
		<div id="post-content">
						
			
			
			<?php get_template_part('content','media');	?>	
					
			<?php get_template_part('content','single');	?>
					 	
			
			</div>
				
			<?php 
				
				/* Only display sidebar on pages that are not set to full width */
				
				if ($veuse['post_layout'] != 'fullwidth'){
					echo '<section id="sidebar">';
					get_sidebar();
					echo '</section>';
				}
				?>
	</div>
		
	<?php endif;?>
		
<?php get_footer();?>