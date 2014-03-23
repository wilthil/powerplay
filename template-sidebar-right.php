<?php 

/* Template name: Sidebar right */

__('Sidebar right', 'ceon' );

?>

<?php get_header();?>

	<?php if(have_posts()): the_post();?>
		
		<div id="content" <?php post_class();?>>
			
			<?php get_template_part('content','page-title');?>
			
			<div class="row">
				<article id="post-content">
					<?php get_template_part('content','media');	?>
					<?php get_template_part('content','page');	?>
					<?php wp_link_pages( );?>				
				</article>			 	
				<section id="sidebar">
					<?php get_sidebar();?>
				</section>				
			
			</div>
		</div>
	
	<?php endif;?>
		
<?php get_footer();?>