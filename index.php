<?php get_header();?>
		
		<div id="content">
			<?php get_template_part('content','title');	?>
			<div class="row">
			
				<div id="post-content" class="post-list">
			
				<?php 
						if ( get_query_var('paged') ) { $paged = get_query_var('paged');}
						elseif ( get_query_var('page') ) {$paged = get_query_var('page');}
						else { $paged = 1;}
				
					    $perpage = get_option('posts_per_page');
					    
					    global $veuse;
					    $columns = $veuse['blog_columns'];
					    
					    $masonry = $veuse['blog_masonry'];
				
					    global $wp_query;
					        query_posts(array_merge($wp_query->query, array(
					            'paged'          => $paged,
					            'posts_per_page' => $perpage
					     )));
				
						 get_template_part('loop','posts'); 
						 
						 echo veuse_pagination();
						 
						 //next_posts_link();
						 //previous_posts_link();
					?>
				</div>
					<?php 
				
			/* Only display sidebar on pages that are not set to full width */
			global $veuse;
				
			if ( isset($veuse) && isset($veuse['blog_layout']) && $veuse['blog_layout'] != 'fullwidth' ):?>
				<section id="sidebar">
					<?php get_sidebar();?>
				</section>
			<?php endif;?>
			</div>
		</div>
		
<?php get_footer();?>