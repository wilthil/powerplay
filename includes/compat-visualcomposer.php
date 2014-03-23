<?php 


/* Make visual composer use Foundation grid */


/* Change widget title 

add_filter('wpb_widget_title', 'override_widget_title', 10, 2);

function override_widget_title($output = '', $params = array('')) {
  $extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
  return '<h3 class="entry-title'.$extraclass.'">'.$params['title'].'</h3>';
}


add_filter('vc_teaser_grid_title', 'override_teaser_title', 10, 2);

function override_teaser_title($output = '', $params = array('')) {
  $extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
  return '<h4 class="entry-title'.$extraclass.'">'.$params['title'].'</h4>';
}

*/
/*
Available filters in teaser_grid.php
vc_teaser_grid_title
vc_teaser_grid_thumbnail
vc_teaser_grid_content
vc_teaser_grid_carousel_arrows


function veuse_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
     if($tag=='vc_row' || $tag=='vc_row_inner') {
           $class_string = str_replace('vc_row-fluid', 'row', $class_string);
     }
     if($tag=='vc_column' || $tag=='vc_column_inner') {
     	
           $class_string = preg_replace('/vc_span(\d{1,2})/', 'small-12 medium-6 large-$1 columns', $class_string);
     }
     return $class_string;
}

// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'veuse_custom_css_classes_for_vc_row_and_vc_column', 10, 2);

*/