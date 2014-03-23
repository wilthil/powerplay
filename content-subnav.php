<?php 

/* 	

	This file inserts a sub-navigation displaying the pages child pages 
	if subnavigation has been checked in page-meta panel and page has child pages

*/
	/* Get post meta for page elements */
	if(function_exists('rwmb_meta')){
	$page_elements = rwmb_meta( 'veuse_page_elements', 'type=checkbox_list' );
	/* Check for page children */
	$children = get_pages('child_of='.$post->ID);
	}
	/* Display subnav is all criterias are met */
	if ( isset($page_elements) && in_array('submenu', $page_elements) ){	?>
		<nav id="subnav">
		<!--<h4 class="subnav-title"><?php //_e('Navigation','veuse');?></h4>-->
		<?php do_action('veuse_subnav');?>
		</nav>
<?php } ?>