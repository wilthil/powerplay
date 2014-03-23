<?php

/* Template name: Fullwidth page */

?>

<?php get_header();?>

	<?php if(have_posts()): the_post();?>
		
		<div id="content" <?php post_class();?>>
			
			<?php get_template_part('content','page-title');	?>
			
			<div class="row">
				
				
			
				<article id="post-content">
					<?php get_template_part('content','media');	?>
				 	<?php get_template_part('content','page');	?>
				
				</article>
				
				
			</div>
		</div>
		
	<?php endif;?>
		
<?php get_footer();?>