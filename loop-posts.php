<?php 

global $columns, $masonry;

if(have_posts()):


	if($masonry == 1) {
			
		$wrapper_start = '<div id="grid" data-columns data-columns-'.$columns.'>';
		$wrapper_end = '</div>';
		
		$container_start= '<div>';
		$container_end = '</div>';
		
		
	}
	
	else {
			
		$wrapper_start  = '<ul class="small-block-grid-1 large-block-grid-'. $columns .'">';
		$wrapper_end    = '</ul>';
		
		$container_start = '<li>';
		$container_end   = '</li>';
	}


	echo $wrapper_start;


while (have_posts()): the_post(); 
	
	echo $container_start;
	
?>

<article <?php post_class();?>>

	<?php get_template_part('content','media');?>

	<div class="entry-content">

		<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
		
		<ul class="entry-meta">
			<li><i class="fa fa-clock-o"></i> <?php echo get_the_date();?></li>
			<li><i class="fa fa-user"></i> <?php echo get_the_author_link();?></li>
			<li><i class="fa fa-file-o"></i> <?php echo get_the_category_list();?></li>
			<li><i class="fa fa-comments-o"></i> <a href="<?php comments_link(); ?>"><?php comments_number( 'o', '1', '%' ); ?></a></li>	
		</ul>
		<?php
		$excerpt_args = array(
			'page_id' 		=> $post->ID,
			'link' 			=> '',
			'limit'			=> '',
			'string'		=> 'More'
		);
		
		echo veuse_excerpt($excerpt_args);
		
		?>
		
		
		
	</div>

</article>

<?php 
	echo $container_end;

endwhile;
	
	echo $wrapper_end;
	
?>


</ul>
<?php else:?>

<div class="veuse-alert veuse-alert-yellow"><?php _e('No entries found. Perhaps try a search?','veuse');?></div>

<?php endif; ?>