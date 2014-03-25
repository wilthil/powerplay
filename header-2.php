<header id="header" data-id="header-2">
	<div class="row">
		<div class="small-12 large-2 columns">
			<a href="<?php echo home_url();?>" id="logo"> 
				<?php
				
				global $veuse;
				
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
		
		<div class="column">
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