<!DOCTYPE html>

<?php global $veuse;?>
<html id="doc" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">	
<!-- Favicon -->
<?php if($veuse && !empty($veuse['favicon'])) echo '<link rel="icon" type="image/png" href="'.$veuse['favicon']['url'].'"/>'; ?>
<!-- Title -->
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' | '; } ?><?php bloginfo('name'); if(is_home()) { echo ' | '; bloginfo('description'); } ?></title>
<?php wp_head();?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-3185136-34', 'veuse.com');
  ga('send', 'pageview');

</script>
</head>
<body <?php body_class();?>>
	
	<div id="wrapper">
		
		<header id="header">	

			<div class="row">
				<div class="small-12 large-2 columns">
					<a href="<?php echo home_url();?>" id="logo"> 
						<?php
						
						
						if($veuse && $veuse['logo']){
							echo '<img src="'.$veuse['logo']['url'].'" alt="'.get_bloginfo('name').'"/>';
						}
						else{ 
							bloginfo('name');
						}
						?>
					</a>
				</div>	
				
				<a href="#" id="open-menu-mobile">
					<i class="fa fa-list"></i>
				</a>
				
				<div class="small-12 large-10 columns text-right" style="position:static">

					<nav id="primary-nav-container"  data-name="<?php _e('Navigation','veuse');?>">
						
						<?php		
						wp_nav_menu( array(
							'sort_column' 		=> 'menu_order',
							'container_id'		=> 'primary-nav',
							'container_class' 	=> '',
							'menu_id' 			=> 'primary-menu',
							'menu_class' 		=> '',
							'container' 		=> '',
							'theme_location' 	=> 'primary',
							'fallback_cb'		=> 'veuse_primary_fallback'
							)
						);?>
					
					
					
					
					
				
				</nav>
				
				<?php // Woocommerce shopping cart button 
					 
					if ( class_exists( 'WooCommerce' ) ){
					global $woocommerce, $post;
					//if ( sizeof( $woocommerce->cart->cart_contents ) != 0 ) {?>
					<div id="shopping-cart">
						<a href="<?php echo $woocommerce->cart->get_cart_url();?>" class="cart-contents" ><i class="fa fa-shopping-cart"></i> <?php //_e('Cart','veuse');?><span class="cart-total"><?php echo $woocommerce->cart->get_cart_total(); ?></span></a>
						
						<?php if( !is_cart() || !is_checkout() ):?>
						<div id="header-cart-widget">
							<?php the_widget( 'WC_Widget_Cart' ); ?>	
						</div>
						<?php endif;?>
					</div>
					<?php } ?>
				
					<a href="#" id="menu-open-search"><i class="fa fa-search"></i></a>
				
				</div>
			

			</div>
			<div id="header-search">
				<div class="row">
					<?php $text = __('To search, type and hit enter','veuse'); ?>
					<form method="get" id="header-search-form" action="<?php echo home_url();?>/" class="column">
						<input class="text_input" type="text" onfocus="if(this.value == '<?php echo $text;?>') { this.value = ''; }" onblur="if(this.value == '') { this.value = '<?php echo $text;?>'; }" value="<?php echo $text;?>" name="s" id="s"/>
					</form>
				</div>
			</div><!-- / #header-search -->
		</header>	
		
		
		<div id="content" <?php post_class();?>>
		
		<?php do_action('veuse_top_sections');?>
		
		<?php
		
		/* Insert revolution slider if selected in post meta panel */
		
		/*
		if( ( is_page() || is_singular()) && function_exists('rwmb_meta') ){
		
			 $revolution_slider = rwmb_meta( 'veuse_revolution_slider' );
			 if(!empty($revolution_slider)){
			 	echo do_shortcode('[rev_slider '.$revolution_slider.']');
			 }
		}
		*/
		?>
		

