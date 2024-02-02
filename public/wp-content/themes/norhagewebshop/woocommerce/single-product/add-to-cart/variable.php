<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<h2 class="variations_form-title"><?php printf(__('Customize and order your %s', 'norhage'), $product->get_title()); ?></h2>
		<div class="dimensions">
			<h3>1: <?php _e('Configure product options', 'norhage'); ?></h3>
			<table class="variations" cellspacing="0" role="presentation">
				<tbody>
					<?php foreach ( $attributes as $attribute_name => $options ) : ?>
						<tr>
							<th class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></th>
							<td class="value">
								<?php
									wc_dropdown_variation_attribute_options(
										array(
											'options'   => $options,
											'attribute' => $attribute_name,
											'product'   => $product,
										)
									);
									echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php 

			$cutting_fee = get_field('cutting_fee');
			if($cutting_fee && $cutting_fee > 0): ?>
				<?php
					$max_width = get_field('max_width') ?? 0;
					$min_width = get_field('min_width') ?? 0;
					$max_height = get_field('max_height') ?? 0;
					$min_height = get_field('min_height') ?? 0;
				?>
				<div class="sizes_input">
					<input type="hidden" name="cutting_variables[cutting_fee]" value="<?php echo $cutting_fee; ?>" />
					<div class="width">
						<label for="width"><?php _e('Width (m)', 'norhage'); ?></label>
						<div class="quantity"><input class="qty" type="number" step="0.1" name="cutting_variables[width]" value="1" max="<?php echo $max_width; ?>" min="<?php echo $min_width; ?>" /></div>
					</div>
					<div class="height">
						<label for="height"><?php _e('Height (m)', 'norhage'); ?></label>
						<div class="quantity"><input class="qty" type="number" step="0.1" name="cutting_variables[height]" value="1" max="<?php echo $max_height; ?>" min="<?php echo $min_height; ?>" /></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php do_action( 'woocommerce_after_variations_table' ); ?>

		<?php
			$extras = get_field('product_extras');
			if($extras):
		?>
		<div class="addons">
			<h3>2: <?php _e('Select extra options', 'norhage'); ?></h3>
			<div class="add-products">
				<?php if($extras):
					foreach($extras as $addon):
						//$product = $addon['product'];
						$product_identifier = 'product-' . $addon['product']->ID;
						$max_quantity = $addon['maximum_quantity'];
						$addon_product = wc_get_product($addon['product']->ID);
						$addon_price = $addon_product->get_price();
				?>
				<div class="addon">
					<div class="addon-image">
						<?php echo wp_get_attachment_image(get_post_thumbnail_id($addon_product->get_id()), [420,420]); ?>
					</div>
					<h3><?php echo $addon_product->get_name(); ?></h3>
					<div class="addon-price">
						<?php echo wc_price($addon_price); ?>
					</div>
					<div class="quantity">
						<input class="qty" type="number" name="addons[<?php echo $addon_product->get_id(); ?>]" min="0" max="<?php echo $max_quantity; ?>" value="0" class="addon-quantity" data-price="<?php echo $addon_price; ?>" />
					</div>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
			</div>	
		</div>
		<?php endif; ?>

		<div class="single_variation_wrap">
			<h3><?php echo ($extras)? '3' : '2'; ?>: <?php _e('Select the quantity', 'norhage'); ?></h3>
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );
			?>

			<?php

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
