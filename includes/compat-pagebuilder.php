<?php

/* Panel wrapper classes */

function veuse_panels_row_styles($styles) {
    
    $styles['edge'] = __('Full width content', 'veuse');
    $styles['fullwidth-white'] = __('Full width white', 'veuse');
    $styles['fullwidth-grey'] = __('Full width grey', 'veuse');
    $styles['fullwidth-dark'] = __('Full width dark', 'veuse');
    return $styles;
}

add_filter('siteorigin_panels_row_styles', 'veuse_panels_row_styles');

/* Extra fields */

function vantage_panels_row_style_fields($fields) {

	$fields['top_border'] = array(
		'name' => __('Top Border Color', 'vantage'),
		'type' => 'color',
	);

	$fields['bottom_border'] = array(
		'name' => __('Bottom Border Color', 'vantage'),
		'type' => 'color',
	);

	$fields['background'] = array(
		'name' => __('Background Color', 'vantage'),
		'type' => 'color',
	);

	$fields['background_image'] = array(
		'name' => __('Background Image', 'vantage'),
		'type' => 'url',
	);

	$fields['background_image_repeat'] = array(
		'name' => __('Repeat Background Image', 'vantage'),
		'type' => 'checkbox',
	);
	
	$fields['parallax'] = array(
		'name' => __('Add parallax-effect', 'vantage'),
		'type' => 'checkbox',
	);
	
	$fields['parallax_speed'] = array(
		'name' => __('Parallax speed', 'vantage'),
		'type' => 'select',
		'options' => array(
			'.15' 	=> 'Slow',
			'.3' 	=> 'Normal',
			'.45' 	=> 'Fast',
		),
		'std' 	=> ''
	);

	$fields['no_margin'] = array(
		'name' => __('No Bottom Margin', 'vantage'),
		'type' => 'checkbox',
	);

	return $fields;
}

add_filter('siteorigin_panels_row_style_fields', 'vantage_panels_row_style_fields');



function veuse_panels_panels_row_style_attributes($attr, $style) {
	
	$attr['style'] = '';

	if(!empty($style['top_border'])) $attr['style'] .= 'border-top: 1px solid '.$style['top_border'].'; ';
	if(!empty($style['bottom_border'])) $attr['style'] .= 'border-bottom: 1px solid '.$style['bottom_border'].'; ';
	if(!empty($style['background'])) $attr['style'] .= 'background-color: '.$style['background'].'; ';
	if(!empty($style['background_image'])) $attr['style'] .= 'background-image: url('.esc_url($style['background_image']).'); ';
	if(!empty($style['background_image_repeat'])) $attr['style'] .= 'background-repeat: repeat; ';

	if(empty($attr['style'])) unset($attr['style']);
	return $attr;
}

add_filter('siteorigin_panels_row_style_attributes', 'veuse_panels_panels_row_style_attributes', 10, 2);

function veuse_panels_panels_row_attributes($attr, $row) {
	
	if(!empty($row['style']['no_margin'])) {
		if(empty($attr['style'])) $attr['style'] = '';
		$attr['style'] .= 'margin-bottom: 0px;';
	}
	
	if(!empty($row['style']['parallax'])) {
		if(empty($attr['style']['parallax'])) $attr['parallax'] = '';
		$attr['class'] .= ' parallax';
	}
	
	if(!empty($row['style']['parallax_speed'])) {
		if(empty($attr['style']['data-parallax-speed'])) $attr['data-parallax-speed'] = '';
		$attr['data-parallax-speed'] .= $row['style']['parallax_speed'];
	}
	


	return $attr;
}
add_filter('siteorigin_panels_row_attributes', 'veuse_panels_panels_row_attributes', 10, 2);