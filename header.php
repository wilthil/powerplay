<!DOCTYPE html>

<?php global $veuse;
	
	!empty($veuse['header_position'] ) ? $header_position = $veuse['header_position'] : $header_position = '' ;
	
	
?>
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-3185136-35', 'veuse.com');
  ga('send', 'pageview');

</script>

</head>
<body <?php body_class();?>>
	<div id="wrapper" data-header-position="<?php echo $header_position;?>">
			
		<?php get_template_part('header-1');?>
			
		<div id="content" <?php post_class();?>>
		
		<?php do_action('veuse_top_sections');?>