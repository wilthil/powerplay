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

if(  in_array('title', $page_elements)){ ?>
	
	<div id="page-title-wrapper">
		<div class="row">
			<!-- Page title -->
			<div class="small-12 medium-12 large-6 columns">
				<h1 id="page-title">
					<?php the_title();?>
				</h1>
			</div>
			<!-- Breadcrumbs -->
			<div class="small-12 medium-12 large-6 columns breadcrumb-wrapper">
				<?php echo veuse_breadcrumbs(); ?>
			</div>	
		</div><!-- / .row -->
	</div><!-- / #page-title-wrapper -->
<?php }


	/* Display excerpt only if not disabled in post meta */		
	/*		
	if ( is_page()  && in_array('excerpt', $page_elements)) {
		
			echo '<div id="post-title-wrapper"><div class="row"><div class="column">';
			echo '<h3 id="post-excerpt">'. get_the_excerpt() .'</h3>';
			echo '</div></div></div>';
			
	}
	*/?>		 	
	


