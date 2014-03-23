<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
 
global $product, $woocommerce_loop;

if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
}

?>



<ul class="small-block-grid-1 large-block-grid-<?php echo $woocommerce_loop['columns'];?>">