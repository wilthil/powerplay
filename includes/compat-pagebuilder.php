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

function veuse_panels_row_style_fields($fields) {

	$fields['top_border'] = array(
		'name' => __('Top Border Color', 'veuse'),
		'type' => 'color',
	);

	$fields['bottom_border'] = array(
		'name' => __('Bottom Border Color', 'veuse'),
		'type' => 'color',
	);

	$fields['background'] = array(
		'name' => __('Background Color', 'veuse'),
		'type' => 'color',
	);

	$fields['background_image'] = array(
		'name' => __('Background Image', 'veuse'),
		'type' => 'url',
	);
	
	$fields['top_margin'] = array(
		'name' => __('Top margin', 'veuse'),
		'type' => 'number'
	);
	
	$fields['bottom_margin'] = array(
		'name' => __('Bottom margin', 'veuse'),
		'type' => 'number'
	);
	
	$fields['top_padding'] = array(
		'name' => __('Top padding', 'veuse'),
		'type' => 'number'
	);
	
	$fields['bottom_padding'] = array(
		'name' => __('Bottom padding', 'veuse'),
		'type' => 'number'
	);

	$fields['background_image_repeat'] = array(
		'name' => __('Repeat Background Image', 'veuse'),
		'type' => 'checkbox',
	);
	

	
	$fields['background_effect'] = array(
		'name' => __('Background effect', 'veuse'),
		'type' => 'select',
		'options' => array(
			'parallax' 	=> 'Parallax',
			'fixed_background' 	=> 'Fixed'
			),
		'std' 	=> ''
	);
	
	
	$fields['parallax_speed'] = array(
		'name' => __('Parallax speed', 'veuse'),
		'type' => 'select',
		'options' => array(
			'.15' 	=> 'Slow',
			'.3' 	=> 'Normal',
			'.45' 	=> 'Fast',
		),
		'std' 	=> ''
	);
	
	$fields['row_visibility'] = array(
		'name' => __('Visibility', 'veuse'),
		'type' => 'select',
		'options' => array(
			'hide-for-small-only' 	=> 'Hide only on a small screen. ( < 640px )',
			'hide-for-medium-up' 	=> 'Hide on medium screens and up ( < 1023px )',
			'hide-for-medium-only' 	=> 'Hide only on a medium screen ( 640 - 1023px)',
			'hide-for-large-up' 	=> 'Hide on large screens and up ( > 1024px ) ',
			'hide-for-large-only'	=> 'Hide only on a large screen ( 1024 - 1440px)',
			'hide-for-xlarge-up'	=> 'Hide on xlarge screens and up ( > 1440px) ',
			'hide-for-xlarge-only'	=> 'Hide only on an xlarge screen ( 1441 - 1920px)',
			'hide-for-xxlarge-up'	=> 'Hide on xxlarge screens and up ( > 1920px)',
			'show-for-small-only' 	=> 'Show only on a small screen. ( < 640px )',
			'show-for-medium-up' 	=> 'Show on medium screens and up ( < 1023px )',
			'show-for-medium-only' 	=> 'Show only on a medium screen ( 640 - 1023px)',
			'show-for-large-up' 	=> 'Shown on large screens and up ( > 1024px ) ',
			'show-for-large-only'	=> 'Shown only on a large screen ( 1024 - 1440px)',
			'show-for-xlarge-up'	=> 'Show on xlarge screens and up ( > 1440px) ',
			'show-for-xlarge-only'	=> 'Show only on an xlarge screen ( 1441 - 1920px)',
			'show-for-xxlarge-up'	=> 'Show on xxlarge screens and up ( > 1920px)'
		),
		'std' 	=> ''
	);

	$fields['no_margin'] = array(
		'name' => __('No Bottom Margin', 'veuse'),
		'type' => 'checkbox',
	);

	return $fields;
}

add_filter('siteorigin_panels_row_style_fields', 'veuse_panels_row_style_fields');



function veuse_panels_panels_row_style_attributes($attr, $style) {
	
	$attr['style'] = '';

	if(!empty($style['top_margin'])) $attr['style'] .= 'margin-top: '.$style['top_margin'].'px; ';
	if(!empty($style['bottom_margin'])) $attr['style'] .= 'margin-bottom: '.$style['bottom_margin'].'px; ';
	if(!empty($style['top_padding'])) $attr['style'] .= 'padding-top: '.$style['top_padding'].'px; ';
	if(!empty($style['bottom_padding'])) $attr['style'] .= 'padding-bottom: '.$style['bottom_padding'].'px; ';
	if(!empty($style['top_border'])) $attr['style'] .= 'border-top: 1px solid '.$style['top_border'].'; ';
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
		$attr['style'] .= 'margin-bottom: 0px !important;';
	}
	
	if(!empty($row['style']['background_effect'])) {
		//if(empty($attr['style'])) $attr['style'] = '';
		$attr['class'] .= ' ' . $row['style']['background_effect'];
	}
	
	
	if(!empty($row['style']['parallax_speed'])) {
		if(empty($attr['style']['data-parallax-speed'])) $attr['data-parallax-speed'] = '';
		$attr['data-parallax-speed'] .= ' ' .$row['style']['parallax_speed'];
	}
	
	if(!empty($row['style']['row_visibility'])) {
		if(empty($attr['style'])) $attr['style'] = '';
		$attr['class'] .= ' ' . $row['style']['row_visibility'];
	}

	return $attr;
}
add_filter('siteorigin_panels_row_attributes', 'veuse_panels_panels_row_attributes', 10, 2);