<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	<?php
		$cutting_fee = get_field('cutting_fee');
		$has_cutting_fee = ($cutting_fee && $cutting_fee > 0)? true : false;
	?>
	
	<?php if(!$has_cutting_fee): ?><div class="woocommerce-simple-price">
		<?php wc_get_template( 'single-product/price.php' ); ?>
	</div><?php endif; ?>

	<form class="cart simple_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php
			$productParams = [
				'productType'	=> 'simple',
				'price'			=> $product->get_price()
			];
			wp_add_inline_script('norhagewebshop-misc', 'var norhage_product_info = ' . wp_json_encode( $productParams ), 'before');
		?>

		<?php if($has_cutting_fee): ?>
			<?php
				$max_width = (get_field('max_width')) ? get_field('max_width') * 1000 : 10000;
				$min_width = (get_field('min_width')) ? get_field('min_width') * 1000 : 1;
				$max_height = (get_field('max_height')) ? get_field('max_height') * 1000 : 10000;
				$min_height = (get_field('min_height')) ? get_field('min_height') * 1000 : 1;
			?>
			<div class="sizes_input">
				<h3>1: <?php _e('Configure the size', 'norhagewebshop'); ?></h3>
				<input type="hidden" name="cutting_variables[cutting_fee]" value="<?php echo $cutting_fee; ?>" />
				<div class="width">
					<label for="width"><?php _e('Width (mm)', 'norhagewebshop'); ?></label>
					<div class="quantity"><input class="qty" type="number" step="1" name="cutting_variables[width]" value="<?php echo $min_width; ?>" max="<?php echo $max_width; ?>" min="<?php echo $min_width; ?>" /></div>
				</div>
				<div class="height">
					<label for="height"><?php _e('Height (mm)', 'norhagewebshop'); ?></label>
					<div class="quantity"><input class="qty" type="number" step="1" name="cutting_variables[height]" value="<?php echo $min_height; ?>" max="<?php echo $max_height; ?>" min="<?php echo $min_height; ?>" /></div>
				</div>
			</div>
		<?php endif; ?>

		<div class="simple_product_wrap">
			<?php if($has_cutting_fee): ?>

				<h3>2: <?php _e('Select the quantity', 'norhagewebshop'); ?></h3>
				
				<?php wc_get_template( 'single-product/price.php' ); ?>
			<?php endif; ?>


			

			<div class="woocommerce-simple-product-add-to-cart">
				<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
				
				<?php
				do_action( 'woocommerce_before_add_to_cart_quantity' );

				woocommerce_quantity_input(
					array(
						'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
						'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
						'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
					)
				);

				do_action( 'woocommerce_after_add_to_cart_quantity' );
				?>

				<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
			</div>
			<?php
				$delivery_time = get_field('delivery_time');
				if(isset($delivery_time)){
					printf('<p class="delivery-time"><strong>%s:</strong> %s</p>', __('Delivery time', 'norhagewebshop'), $delivery_time);
				}

				$delivery_cost = get_field('delivery_cost');
				if(isset($delivery_cost)){
					printf('<p class="delivery-cost"><strong>%s:</strong> %s</p>', __('Delivery costs', 'norhagewebshop'), $delivery_cost);
				}
			?>
		</div>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
