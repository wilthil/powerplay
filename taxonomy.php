<?php get_header();?>
		
			<?php get_template_part('content','title');	?>
			<div class="row">
		
				
				<div id="post-content" class="small-12 large-12 columns">
						
					<?php 
					
					$columns = '4';
					
					locate_template('loop-portfolio.php',true, true);
		
					?>
				
				</div>

		</div>
		
<?php get_footer();?>