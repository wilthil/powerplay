<?php get_header();?>

	<?php get_template_part('content','title');	?>

	<div class="row">
			
			<?php if(have_posts()): the_post();
				
				$categories = get_the_term_list($post->ID, 'portfolio-category','',', ','');
				//$clients 	= get_the_term_list($post->ID, 'portfolio-client','',', ','');
				$skills 	= get_the_terms($post->ID, 'portfolio-tag');
				$link 		= get_post_meta($post->ID,'veuse_portfolio_website',true);
				$credits 	= get_post_meta($post->ID,'veuse_portfolio_credits',true);
				$client 	= get_post_meta($post->ID,'veuse_portfolio_client',true);
				$launch 	= get_post_meta($post->ID,'veuse_portfolio_launch',true);
	
			?>
		
				<div class="small-12 large-12 columns" style="padding-top:50px;">
				
					<?php get_template_part('content','media');	?>
					
					
					<h1><?php the_title();?></h1>
					
					<?php //if(!empty($post->post_excerpt)) echo '<p class="lead">'.$post->post_excerpt.'</p>';?>
						
					<?php the_content();?>
					
					<div id="portfolio-meta">
					
						<div class="row">
							
							<div class="small-12 large-6 columns">	
								
								<h4><?php _e('Project details','veuse');?></h4>
								
								<ul class="portfolio-meta">
								<?php
								//if($categories)	echo '<li><span>'.__('Categories','veuse').'</span></i>' . $categories . '</li>';
					 			
					 			if($client)	echo '<li><span><i class="fa fa-user"></i></span> '.__('Client:','veuse').' '. $client . '</li>';
					 			if($launch)	echo '<li><span><i class="fa fa-rocket"></i></span> '.__('Launch:','veuse').' '. $launch . '</li>';
					 			if($credits)echo '<li><span>'.__('Credits:','veuse').'</span>'. $credits .'</li>';
					 			?>
					 			<?php if($link)		echo '<li><i class="fa fa-link"></i> <a href="'.$link.'" rel="external">'. __('Visit project','veuse') .'</a></li>';?>
								</ul>
									

						
							</div>
						
							<div class="small-12 large-6 columns">	
						
						
								<h4><?php _e('Work performed','veuse');?></h4>
							
								<?php
								
								if(!empty($skills)){
									
									echo '<ul class="veuse-portfolio-skills">';
									
									foreach($skills as $skill){
										
										$link =  get_term_link( $skill, 'portfolio-tag' );
										
										echo '<li><a href="'. $link .'">'.$skill->name.'</a></li>';
										
									}
									
									echo '</ul>';
									
								}	
								
								?>
							</div>
						</div>		 	
					</div>
				
							
			<?php endif;?>
			
			
			<div id="relatedposts">
			
				<?php 
				
					$taxonomy = 'portfolio-tag';
					
					$terms = wp_get_object_terms( $post->ID, $taxonomy );
		
					if (!empty($terms)) {
					
					?>
			
					<?php echo veuse_related( 'portfolio', 'portfolio-tag', '4', '2', '4', __('Related work','veuse'));
					
					}
				?>
			
			</div>
		</div>
	</div>
		
		
<?php get_footer();?>