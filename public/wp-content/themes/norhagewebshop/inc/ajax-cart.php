<?php

function norhage_ajax_cart(){
	$cart 				= WC()->cart;
	$count 				= $cart->get_cart_contents_count();

	if($cart->is_empty()){
		$output = '<button href="/cart" class="cart-btn">' . __('Cart', 'norhagewebshop') . '</button>';
		$output .= '<div class="cart-popout">'
				. '<p class="empty-msg">' . __('Your cart is empty.', 'norhagewebshop') . '</p>'
				. '</div>';
		return $output;
	}

	$output 	= '<button href="/cart" class="cart-btn">' 
				. __('Cart', 'norhagewebshop') 
				. ' <span class="item-count">'. $count . '</span>'
				. '</button>';

	
	$output 	.= '<div class="cart-popout">'
				. '<ul class="cart-items">';
	
	// Loop over $cart items
	foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
		$product 	= $cart_item['data'];
		$link 		= $product->get_permalink( $cart_item );
		$quantity 	= $cart_item['quantity'];
		$subtotal 	= WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
		$meta 		= wc_get_formatted_cart_item_data( $cart_item );
		$thumb 		= $product->get_image();
		error_log('thumb:' . $thumb);

		$output 	.= '<li class="cart-item">';
		// quantity
		$output 	.= '<span class="qty">' . $quantity . '</span> ';
		// thumbnail
		$output		.= '<a href="' . $link . '" class="item-thumb">' . $thumb . '</a>';
		// item
		$output 	.= '<span class="item"><span class="item-name"><a href="' . $link . '">' . $product->get_name() . '</a></span>'
					. '<span class="item-description">' . $meta . '</span></span>';
		// total price
		$output 	.= '<span class="item-subtotal">' . $subtotal . '</span>';
		// remove
		$output 	.= '<button class="remove-item">' . __('Remove', 'norhagewebshop') . '</button>';
		// close
		$output 	.= '</li>';
	}
	
	$output 	.= '</ul></div>';
	return $output;
}

/**
 * Enqueue scripts and styles.
 */
function ajaxcart_scripts() {
	wp_enqueue_script('norhagewebshop-ajaxcart', get_stylesheet_directory_uri() . '/js/ajax-cart.js', ['jquery', 'wc-settings'], _G_VERSION);
}
add_action( 'wp_enqueue_scripts', 'ajaxcart_scripts' );