<!DOCTYPE html>

<?php global $veuse;?>
<html id="doc" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta name="viewport" id="myViewport" content="width=device-width,initial-scale=1.0">	
<!-- Favicon -->
<?php if($veuse && !empty($veuse['favicon'])) echo '<link rel="icon" type="image/png" href="'.$veuse['favicon']['url'].'"/>'; ?>
<!-- Title -->
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' | '; } ?><?php bloginfo('name'); if(is_home()) { echo ' | '; bloginfo('description'); } ?></title>
<?php wp_head();?>
<?php if($veuse && !empty($veuse['custom_css'])) echo '<style>'.$veuse['custom_css'].'</style>';?>
</head>
<body <?php body_class();?>>
	<div id="wrapper">
			
		<?php get_template_part('header-1');?>
			
		<div id="content" <?php post_class();?>>
		
		<?php do_action('veuse_top_sections');?>