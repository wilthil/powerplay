<?php


/* Woocommerce theme compat */


//add_filter( 'woocommerce_sale_price_html', 'woocommerce_custom_sales_price', 10, 2 );
function woocommerce_custom_sales_price( $price, $product ) {
	global $post, $product;
	$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
	return $price . sprintf( __(' Save %s', 'woocommerce' ), $percentage . '%' );
}


add_filter( 'woocommerce_enqueue_styles', '__return_false' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

add_action('woocommerce_before_main_content', 'veuse_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'veuse_theme_wrapper_end', 10);

function veuse_theme_wrapper_start() {
  echo '<div id="post-content">';
}

function veuse_theme_wrapper_end() {
  echo '</div>';
}


/* Register widgetized areas */

function veuse_woocommerce_widgets_init() {
	register_sidebar(array(
		'name' => 'Shop Sidebar',
		'id' => 'woocommerce_sidebar',
		'before_title' => '<h4 class="widget-title"><span>',
		'after_title' => '</span></h4>',
		'before_widget' => '<aside  id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>'
	));
}

add_action( 'widgets_init', 'veuse_woocommerce_widgets_init' );


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url();?>" id="shopping-cart"><i class="fa fa-shopping-cart"></i> <?php //_e('Cart','veuse');?><span class="cart-total"><?php echo $woocommerce->cart->get_cart_total(); ?></span></a>
	
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	ob_start();?>
	<span class="added_to_cart wc-forward" title="<?php _e('View cart','veuse');?>"><i class="fa fa-check"></i> <?php _e('Added to cart','veuse');?></span>
	<script>
		jQuery(document).ready(function(){
			
			
			
			jQuery('.added_to_cart').fadeIn();
			
			setTimeout(function(){
				jQuery('.added_to_cart').fadeOut('500', function(){
					
					jQuery(this).remove();
					
				});
			}, 1000);	
			
		});
		
	</script>
	<?php
	$fragments['a.added_to_cart'] = ob_get_clean();

	
	return $fragments;
	
}