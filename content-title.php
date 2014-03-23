<div id="page-title-wrapper">
	<div class="row">
<?php

/* Get page elements from post meta */
	if(( is_page() || is_singular() ) && function_exists('rwmb_meta')){
		$elements = rwmb_meta( 'veuse_page_elements', 'type=checkbox_list' );
			if(!empty($elements)){
				$page_elements = $elements;
			} else {
				/* Set defaults if not set */
				$page_elements[] = 'title';
				$page_elements[] = 'content';
			}
	}




/* Display title only if not disabled in post meta */		
if(!is_page()) {

	echo '<div class="small-12 large-6 columns">';
	echo '<h1 id="page-title">';
	
	if(is_singular('post'))
		echo __('Blog','veuse');
	
	elseif(is_singular('portfolio'))
		echo __('Portfolio','veuse');	
	
	elseif(is_home())
		echo __('Blog','veuse');
	
	elseif( is_attachment())
		the_title();
	
	elseif( is_tax()){
		
		single_term_title();
		
		}
	elseif( is_category())
		echo __('Posts published in category','veuse').' '. single_cat_title('',false);
		
	elseif( is_tag())
		echo __('Posts tagged with','veuse').' '.single_tag_title(' ',false);

	elseif( is_year())
		echo  __('Posts published in','veuse').' '. get_the_time('Y');
	
	elseif( is_date())
		echo __('Posts published on','veuse').' '. get_the_date();
	
	elseif( is_archive())
		echo  __('Posts published in','veuse').' '. single_month_title(' ',false);
	
	

		
	elseif( is_author())
		echo get_the_author();
	
	
	
	elseif( is_search()){
			
			$output = __('Search results for', 'veuse');
			$s = get_query_var('s');
			$allsearch = new WP_Query("s=$s&showposts=-1");
			$key = esc_html($s, 1);
			$count = $allsearch->post_count;
			
			if($count == 1){
			$output.= ' "'.$key.'" - '. $count . ' ' .__('article', 'veuse');
			}
			else{
			$output.= ' "'.$key.'" - '. $count . ' ' .__('articles', 'veuse');
			}
			
			$posttitle = $output;

			echo $posttitle;	
	?>
	
	<?php } 
	
	elseif( is_404())
	_e('404 Error','veuse');
	
	else {
		
		echo the_title();
	}
	
	echo '</h1></div>';

?>
<?php }?>


	<div class="small-12 large-6 columns breadcrumb-wrapper">
	<?php 
	
		if(!is_single()) {
			echo veuse_breadcrumbs(); 
		}
		else {
		  previous_post_link('%link', '<i class="fa fa-angle-left primary"></i>'). next_post_link('%link', '<i class="fa fa-angle-right primary"></i>');
		}
	?>
	</div>
	</div><!-- / .row -->
</div><!-- / #page-title-wrapper -->

<div id="post-title-wrapper">
<?php //if( is_singular('post') && in_array('title', $page_elements) ){?>
<!-- <div class="row">
	<div class="column">
		<h1 id="post-title"><?php //the_title();?></h1>
	</div>
</div>
-->
<?php 
//}

/* Display excerpt only if not disabled in post meta */		
	//if ( (is_page() || is_singular('post')) && in_array('excerpt', $page_elements)) {

		//echo '<div class="row"><div class="column">';
		//echo '<h3 id="post-excerpt">'. get_the_excerpt() .'</h3>';
		//echo '</div></div>';

	//}

 ?>
 </div>
