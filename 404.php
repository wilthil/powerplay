<?php get_header();?>
<?php get_template_part('content','title');	?>

	<div class="row">			
		<div id="post-content" class="text-center">
			<h1><?php _e('We are sorry!','veuse');?></h2>
					
			<p><?php _e('The page you were looking for appears to have been moved, deleted or does not exist. Perhaps do a search to find what you are looking for?','veuse');?></p>
			
			<div class="small-12 large-4 columns small-centered large-centered">
			<?php get_search_form(); ?>
			</div>
		</div>
	</div>

<?php get_footer();?>