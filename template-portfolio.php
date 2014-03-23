<?php

/* ---------------------------------------------------------------
	
	Template name: Portfolio page 

	This file is intended for displaying portfolio-posts 
	when the veuse-portfolio plugin is installed and activated.
	
	Plugin URI: http://veuse.com/plugins/veuse-portfolio
	
--------------------------------------------------------------- */

?>

<?php get_header();?>

	<?php if(have_posts()): the_post();?>
		
		<div id="content" <?php post_class();?>>
			
			<?php get_template_part('content','page-title');	?>	
			
			<div class="row">
				
				
				
				<article id="post-content" class="fullwidth">
					<?php get_template_part('content','media');	?>
				 	<?php get_template_part('content','page');?>
				</article>
				
				<div class="column">
				<?php echo do_shortcode('[veuse_portfolio columns="3" filter="true" excerpt_limit="80" type="filtered"]');?>
				</div>
				
			
			</div><!-- / .row -->
		
		</div><!-- / #content -->
	
	<?php endif;?>	
		
<?php get_footer();?>