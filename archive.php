<?php get_header();?>
		
		<div id="content">
			
			<?php get_template_part('content','title');	?>
			<div class="row">
		
				
				
				<div id="post-content" class="post-list">
						
					<?php get_template_part('loop','posts'); 
						 
					 wp_reset_query();?>
				
				</div>
				<section id="sidebar">
				<?php get_sidebar();?>
				</section>
			</div>
		</div>
		
<?php get_footer();?>