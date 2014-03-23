	<?php do_action('veuse_bottom_sections'); // Veuse Sections ( below content ) ?>
		
	</div> <!-- / #content -->
	
	<?php global $veuse;?>	
	
	<div id="footer">
	
		<div id="footer-widgets">
		<div class="row">
			<?php dynamic_sidebar('Footer');?>
			
		</div><!-- /.row -->	
		</div><!-- /#footer-widgets -->
	
		<div id="footer-address">	
			<div class="row">
				<div class="small-12 large-6 columns">
					<?php echo isset($veuse) && isset($veuse['footer_text_top']) ? wpautop(do_shortcode( $veuse['footer_text_top'] )) : ''; ?>
				</div>
				<div class="small-12 large-6 columns">
					
					<?php
					
					if ( has_nav_menu( 'footer' ) ) {
							
						wp_nav_menu( array(
							'sort_column' 		=> 'menu_order',
							'container_id'		=> 'footer-nav',
							'container_class' 	=> 'footer-nav',
							'menu_id' 			=> 'footer-menu',
							'menu_class' 		=> 'footer-menu',
							'container' 		=> 'nav',
							'theme_location' 	=> 'footer'
							)
						);
					}?>
				</div>
			</div>
		</div>
		
		
		<div id="footer-credits">
			
			<div class="row">
				<div class="small-12 large-5 columns">
					<?php echo isset($veuse) && isset($veuse['footer_text_1']) ? wpautop( do_shortcode( $veuse['footer_text_1'] )) : ''; ?>
				</div>
				<div class="small-12 large-2 columns text-center">
					<a href="#wrapper" class="scrollto"><?php echo do_shortcode('[icon type="angle-up" size="2x"]');?></a> 
				</div>
				<div class="small-12 large-5 columns text-right">
					<?php echo isset($veuse) && isset($veuse['footer_text_2']) ?  wpautop( do_shortcode( $veuse['footer_text_2'] )): ''; ?>
				</div>
				
			</div>
		</div>
	
	</div><!-- /#footer -->
	
</div><!-- /#wrapper -->
	
<?php wp_footer();?>
	


</body>
</html>