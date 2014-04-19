<?php get_header();?>
	
	<?php if(have_posts()): the_post();?>	

			<?php get_template_part('content','page-title');?>
			
			<div class="row">

			<div id="post-content">
			
				  <?php get_template_part('content','media');	?>
				
				<?php get_template_part('content','page');	?>
				<?php wp_link_pages( );?>		
				
			
				
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