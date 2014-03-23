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
		<?php the_content();?>
	</article>
	
<?php } ?>