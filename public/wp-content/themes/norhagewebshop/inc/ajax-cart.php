<?php

function norhage_cart(){
	$cart = WC()->cart;
	if($cart->is_empty()){
		$output = '<button href="/cart" class="cart-btn">' . __('Cart', 'norhagewebshop') . '<span class="item-count">0</span></button>';
	}else{
		$count = $cart->get_cart_contents_count();
		$output 	= '<button href="/cart" class="cart-btn">' 
					. __('Cart', 'norhagewebshop') 
					. ' <span class="item-count">'. $count . '</span>'
					. '</button>';
	}
	return $output;
}

/**
 * ADD THE CART TO THE MENU
 * */
function norhage_menu_add_cart( $output, $item, $depth, $args ) {
	if( $args->menu_id == 'secondary-menu' && $item->type == 'custom' && $item->url == '/cart'){
		$output = norhage_cart();
	}
    return $output;
}
add_action( 'walker_nav_menu_start_el', 'norhage_menu_add_cart', 10, 4 );

/**
 * Enqueue scripts and styles.
 */
function ajaxcart_scripts() {
	wp_enqueue_script('norhagewebshop-ajaxcart', get_stylesheet_directory_uri() . '/js/ajax-cart.js', ['jquery', 'wc-settings'], _G_VERSION);
}
add_action( 'wp_enqueue_scripts', 'ajaxcart_scripts' );


function norhage_add_ajax_cart_endpoints() {
	add_action( 'wp_ajax_cart_count', 'norhage_cart_count' );
	add_action( 'wp_ajax_nopriv_cart_count', 'norhage_cart_count' );
}
add_action( 'admin_init', 'norhage_add_ajax_cart_endpoints' );

function norhage_cart_close_button(){
	echo '<h2>' . __('Shopping cart', 'norhagewebshop') . '</h2>';
	echo '<button class="close-btn">' . __('Close', 'norhagewebshop') .'</button>';
}
add_action( 'woocommerce_before_mini_cart', 'norhage_cart_close_button' );

function norhage_cart_count(){
	$cart = WC()->cart;
	$count = $cart->get_cart_contents_count();

	header('Content-type: application/json');
    send_nosniff_header();
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
    wp_send_json( ['cart_count' => $count] );
    wp_die();
}

