<?php if(have_posts()): ?>

<?php
while (have_posts()): the_post();
?>
<article <?php post_class();?>>

	<div class="row">
	
		<div class="small-2 medium-1 large-1 columns">
			<ul class="entry-date">
				<li class="day"><span><?php the_time('j');?></span></li>
				<li class="month"><?php the_time('M');?></li>
			</ul>
		</div> 
	
	<div class="small-10 medium-11 large-11 columns">
	
	<?php get_template_part('content','media');?>

	<div class="entry-content">
	
		
	
		<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

		<?php
		the_excerpt();
		
		?>
		
		<ul class="entry-meta">
			<li><?php _e('Posted by','veuse');?> <?php echo get_the_author_link();?></li>
			<li><?php _e('Filed in','veuse');?> <?php echo get_the_category_list();?></li>
			<li><a href="<?php comments_link(); ?>"><?php comments_number( 'No comments', '1 comment', '% comments' ); ?></a></li>
			<li class="more-link"><a href="<?php the_permalink();?>" class="veuse-button small primary">Read more</a><li>
		</ul>
		
	</div>
		</div>
	</div>
</article>
<?php endwhile;?>
<?php else:?>
<div class="veuse-alert veuse-alert-yellow"><?php _e('No entries found. Perhaps try a search?','veuse');?></div>

<?php endif; ?>
