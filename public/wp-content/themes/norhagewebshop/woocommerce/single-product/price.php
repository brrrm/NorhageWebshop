<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
	<?php echo $product->get_price_html(); ?>
	<?php 
		$cutting_fee = get_field('cutting_fee', $product->ID);
		$has_cutting_fee = ($cutting_fee && $cutting_fee > 0)? true : false;
	?>
	<?php if($has_cutting_fee): ?>
		<small class="cutting-fee-notice">(<?php _e('Cutting fee is included in the price.', 'norhagewebshop'); ?>)</small>
	<?php endif; ?>
</p>
