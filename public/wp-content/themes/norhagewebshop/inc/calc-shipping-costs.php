<?php

function norhage_add_shipping_costs_calc_endpoints() {
	add_action( 'wp_ajax_calc_shipping_costs', 'norhage_calc_shipping_costs' );
	add_action( 'wp_ajax_nopriv_calc_shipping_costs', 'norhage_calc_shipping_costs' );
}
add_action( 'admin_init', 'norhage_add_shipping_costs_calc_endpoints' );

function norhage_woocommerce_widget_shopping_cart_before_buttons(){
	echo '<div class="shipping-costs-container"><table class="norhage-shipping-costs">';
	norhage_cart_totals_shipping_html();
	echo '</table></div>';
}
add_action('woocommerce_widget_shopping_cart_before_buttons', 'norhage_woocommerce_widget_shopping_cart_before_buttons');

/**
 * Show country name on shipping costs calculator
 */
add_filter( 'woocommerce_formatted_address_force_country_display', '__return_true' );


/**
 * AJAX response for action <<calc_shipping_costs>>
 */
function norhage_calc_shipping_costs(){
	if ( !isset($_POST['norhage-calc-shipping-costs']) || !wp_verify_nonce($_POST['norhage-calc-shipping-costs'], 'calc_shipping_costs')){
		norhage_return_nonce_error();
	}

	WC_Shortcode_Cart::calculate_shipping();
	$cart = WC()->cart;
	$cart->calculate_totals();
	$costs = $cart->calculate_shipping();
	wc_clear_notices();
	
	ob_start(); ?>

	<table class="norhage-shipping-costs">

	<?php norhage_cart_totals_shipping_html(); ?>
	
	</table>

	<?php echo ob_get_clean();
    wp_die();
}

/**
 * HTML output for shipping estimate
 */
function norhage_cart_totals_shipping_html() {
	$packages = WC()->shipping()->get_packages();
	$first    = true;

	foreach ( $packages as $i => $package ) {
		$chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
		$product_names = array();

		if ( count( $packages ) > 1 ) {
			foreach ( $package['contents'] as $item_id => $values ) {
				$product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
			}
			$product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
		}

		load_template(get_template_directory() . '/shipping-costs.php', false, array(
				'package'                  => $package,
				'available_methods'        => $package['rates'],
				'show_package_details'     => count( $packages ) > 1,
				'show_shipping_calculator' => ($i+1 == count($packages)),
				'package_details'          => implode( ', ', $product_names ),
				/* translators: %d: shipping package number */
				'package_name'             => apply_filters( 'woocommerce_shipping_package_name', ( ( $i + 1 ) > 1 ) ? sprintf( _x( 'Shipping %d', 'shipping packages', 'woocommerce' ), ( $i + 1 ) ) : _x( 'Shipping', 'shipping packages', 'woocommerce' ), $i, $package ),
				'index'                    => $i,
				'chosen_method'            => $chosen_method,
				'formatted_destination'    => WC()->countries->get_formatted_address( $package['destination'], ', ' ),
				'has_calculated_shipping'  => WC()->customer->has_calculated_shipping(),
			));
		

		$first = false;
	}

	// when there are no packages, simply show the calculator
	if(!count($packages)){
		printf( '<tr><th>%s:</th><td>', _x( 'Shipping', 'shipping packages', 'woocommerce' ));
		load_template(get_template_directory() . '/shipping-calculator.php');
		echo '</td></tr>';
	}
}

function norhage_return_nonce_error(){
	ob_start(); ?>
	<p>Something went wrong.</p>
	<?php echo ob_get_clean();
    wp_die();
}

