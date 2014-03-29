<?php

/**
 *  Overrides the loop from the veuse-portfolio plugin
 * 	
 *	The loop displays portfolio-posts ( Post-type portfolio ) 
 *
 */


global $post, $categories, $content_width;

/* Fallback settings */

if(!isset($columns)) { $columns = '3';}
if(!isset($type)) { $type = '';}
if(!isset($excerpt)) { $excerpt = 'false';}
if(!isset($displayterms)) { $displayterms = 'false';}
if(!isset($morelink)) { $morelink = 'false';}


/* Calculate image size depending on contentwidth and columns */

$imagesize = array( 
	'width' => round($content_width/$columns), 
	'height' => ( round($content_width/$columns ) ) * 0.7 
	);

	$taxonomy = 'portfolio-category';

	/* Portfolio filter */

	if(isset($type) && $type == 'filtered' ){

		$allterms = get_terms( $taxonomy, array('hide_empty' => 1)); ?>
     			
     	<ul class="veuse-portfolio-filter">
    		<li class="active"><a href="#" class="showall" ><?php _e('All','veuse');?></a></li>
    			<?php

     			foreach ( $allterms as $term ) {

		     		if(!empty($categories)){
	     				$needle = strpos($categories, $term ->slug);
	     					if($needle !== false){
	     					?><li><a href="#" class="<?php echo $term->slug;?>"><?php echo $term->name;?></a></li><?php
	        			}
	        		} else { ?>

	        		<li><a href="#" class="<?php echo $term->slug;?>"><?php echo $term->name;?></a></li>
	        		<?php
		        	}
        		}
        		?>
     			</ul>
     			<?php
		} ?>
		<ul class="veuse-portfolio-list small-block-portfolio-grid-1 large-block-portfolio-grid-<?php echo $columns;?>">
		<?php

		/* The loop */

		$plugin_options = get_option('veuse_portfolio_options');

		$i = 0;

		if(have_posts()): while (have_posts()): the_post();

		$i++;

		$post_terms = get_the_terms( $post->ID, $taxonomy);
		$count = count($post_terms);

		if ( $count > 0 ){

			$post_term_names = '';
			$post_term_list = '';
	
			if ( $post_terms && ! is_wp_error( $post_terms ) ) :
	
			       foreach ( $post_terms as $term ) {
			       	   	$post_term_list.= $term->slug. ' ';
			       	   	$post_term_names.= '<span>' . $term->name. '</span> ';
			       }
			 endif;
		 }
		 
		$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		$fallback_img_url = get_stylesheet_directory_uri().'/images/fallback-thumbnail.jpg';
		?>
		
			<li <?php post_class();?> data-id="id-<?php echo ($i + 1);?>" data-tags="<?php echo $post_term_list;?>">
			
			<div class="portfolio-entry">		
				
				<div class="entry-thumbnail">
					<a href="<?php echo get_permalink();?>"><span class="overlay"></span></a>
					<a class="more-link" href="<?php echo get_permalink();?>"><span><?php _e('View details','veuse');?></span></a><h4><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h4>
					<?php if( !empty($img_url) ):?>
					<?php echo veuse_retina_interchange_image( $img_url, $imagesize['width'], $imagesize['height'], true);?>
					<?php else: ?>
					<?php echo veuse_retina_interchange_image( $fallback_img_url, $imagesize['width'], $imagesize['height'], true);?>
					<?php endif;?>
				</div>
							
			</div>
		</li>

		<?php
		unset($post_term_list); // Reset the term list for each item
		endwhile; endif;				
		wp_reset_query();
		?>
		</ul>