<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>
<div id="page-title-wrapper">
	<div class="row">
		<div class="small-12 large-6 columns">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			
				<h1 id="page-title"><?php woocommerce_page_title();?></h1>
			
			<?php endif; ?>
		</div>
		<div class="small-12 large-6 columns breadcrumb-wrapper">
				<?php echo veuse_breadcrumbs(); ?>
		</div>
	</div>
</div>
<div class="row">

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	</div>
<?php get_footer( 'shop' ); ?>