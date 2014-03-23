<?php 

/* Get page elements from post meta */
	if(function_exists('rwmb_meta')){
		$elements = rwmb_meta( 'veuse_page_elements', 'type=checkbox_list' );
			if(!empty($elements)){
				$page_elements = $elements;
			} else {
				/* Set defaults if not set */
				$page_elements[] = 'title';
				$page_elements[] = 'content';
			}
	}
		
if ( in_array('content', $page_elements)) {?>
	<article class="entry-content">
		
		<h2><?php the_title();?></h2>	
		
		<?php the_content();?>
		
		<ul class="entry-meta">
			<li><?php _e('Posted by','veuse');?> <?php echo get_the_author_link();?></li>
			<li><?php _e('Filed in','veuse');?> <?php echo get_the_category_list();?></li>
			<li><a href="<?php comments_link(); ?>"><?php comments_number( 'No comments', '1 comment', '% comments' ); ?></a></li>
		</ul>	
		
		<?php previous_post_link('%link', '<i class="fa fa-angle-left"></i> Previous'). next_post_link('%link', 'Next <i class="fa fa-angle-right"></i>');?>
		
		<?php comments_template(); ?>

		

	</article>
	
	<?php 
	
	/* Show related posts */
				
	$taxonomy = 'post_tag';
	$terms = wp_get_object_terms( $post->ID, $taxonomy );
					
	if (!empty($terms)) {?>
				
	<?php echo veuse_related( 'post', 'post_tag', '3', '1', '1', __('Related posts','veuse'));
	}?>
	
	
<?php }?>
