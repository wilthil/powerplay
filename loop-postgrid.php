<!-- Overrides the veuse-uikit post grid loop -->

<?php if(have_posts()): ?>
			
<ul class="veuse-postgrid small-uikit-block-grid-1 large-uikit-block-grid-<?php echo $grid;?>">			
<?php while (have_posts()): the_post();
			
$img_url = wp_get_attachment_url( get_post_thumbnail_id());

global $content_width;
$width = $content_width/$grid;
$height = $width *0.6;

if(has_post_thumbnail()):

?>
			
	<li <?php post_class();?>>
		<article>
			<div class="entry-thumbnail">
			
				<div class="veuse-postgrid-entry-meta">
					<span class="day"><?php the_time('d');?></span>
					<span class="month"><?php the_time('M');?></span>
					
				</div>
				<span class="veuse-postgrid-entry-comments">
				<a href="<?php comments_link();?>"> <i class="fa fa-comments-o fa-lg"></i> <?php comments_number( '0', '1', '%' ); ?></a>
				</span>
			
				<a href="<?php the_permalink();?>">
				<?php echo veuse_retina_interchange_image( $img_url, $width, $height, true);?>
				</a>
			</div>
			<div class="entry-content">
				
				
				<h4><a href="<?php the_permalink();?>"><?php the_title();?></h4></a>				
				<p><?php echo substr(get_the_excerpt(), 0,110); ?></p>
				
			</div>
		</article>
	</li>	
<?php 
endif;
endwhile;?>
</ul>		
<?php endif; 

wp_reset_query();?>