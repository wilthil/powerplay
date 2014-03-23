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
					    $columns = 1;
				
					    global $wp_query;
					        query_posts(array_merge($wp_query->query, array(
					            'paged'          => $paged,
					            'posts_per_page' => $perpage
					     )));
				
						 get_template_part('loop','search'); 
						 next_posts_link();
						 previous_posts_link();
					?>
				</div>
				<section id="sidebar">
				<?php get_sidebar();?>
				</section>
			</div>
		</div>
		
<?php get_footer();?>