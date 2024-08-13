<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php');

// setup variables
$language = function_exists( 'pll_current_language' ) ? pll_current_language() : 'nb';
$upload_dir = wp_upload_dir();
$xml_feed_dir = $upload_dir['basedir'].'/garbo-product-feeds';
$filename = $xml_feed_dir . '/products-' . $language . '.xml';
$treshold = time() - (60*60*24);


// check if folder exists
if ( !file_exists( $xml_feed_dir ) && !is_dir( $xml_feed_dir ) ) {
	mkdir( $xml_feed_dir );
} 

// check if we have a cached xml feed.
if (file_exists($filename) && filectime($filename) > $treshold) {
	// we can serve the cached file.
	readfile($filename);
	exit();
}

/** 
 * no cache, so we need to build up the file
 * */

$multiCurrencySettings = class_exists('WOOMULTI_CURRENCY_Data')? WOOMULTI_CURRENCY_Data::get_ins() : false; // get settings
$currentCurrency = ($multiCurrencySettings)? $multiCurrencySettings->get_current_currency() : 'NOK';
$args =  array(
	'posts_per_page'   => -1,
	'post_type'     => 'product',
	'post_type'     => 'product',
	'post_status'   => 'publish',
	'lang'			=> $language
);
$the_query = new WP_Query($args);
$posts = $the_query->get_posts();

$doc = new DomDocument('1.0'); 
$xmlRoot = $doc->createElement("rss");
$xmlRoot = $doc->appendChild($xmlRoot);
$xmlRoot->setAttribute('xmlns:g', 'http://base.google.com/ns/1.0');
$xmlRoot->setAttribute('version', '2.0');

$channelNode = $xmlRoot->appendChild($doc->createElement('channel'));
$channelNode->appendChild($doc->createElement('title', 'Norhage'));
$channelNode->appendChild($doc->createElement('link', 'https://' . $_SERVER['SERVER_NAME']));
$channelNode->appendChild($doc->createElement('description', get_post_meta(pll_get_post(get_option( 'page_on_front' )), '_yoast_wpseo_metadesc', true) ));

// loop over products
foreach ($posts as $post){
	$product = wc_get_product($post->ID);

	// skip products that can't be sold.
	if (empty($product->name) || empty($product->description) || empty($product->price)){
		continue;
	}
	
	/*
	// we will not yet use variants because our variable attributes are not common to Google
	if($product->is_type('variable')){
		$variation_ids = $product->get_children();
		foreach($variation_ids as $var_id){
			$variant = wc_get_product($var_id);
			error_log($variant->get_title() . ' ' . $variant->get_permalink());
		}
	}
	*/


	$productName = $product->get_name();
	if(strlen($productName) > 70){
		$productName = mb_substr($productName, 0, 67,'UTF-8') . '...';
	}
		
	$itemNode = $channelNode->appendChild($doc->createElement('item'));
	$itemNode->appendChild($doc->createElement('g:id', $post->ID));
	$itemNode->appendChild($doc->createElement('g:title', $productName));
	$itemNode->appendChild($doc->createElement('g:description', str_replace("&nbsp;", ' ', wp_strip_all_tags($product->get_description(), true ) ) ));
	$itemNode->appendChild($doc->createElement('g:link', $product->get_permalink() ));
	$itemNode->appendChild($doc->createElement('g:condition', 'new'));
	$itemNode->appendChild($doc->createElement('g:image_link', get_the_post_thumbnail_url($post->ID)));
	$stock_status = ($product->get_stock_status() == 'instock')? 'in_stock' : 'out_of_stock';
	$itemNode->appendChild($doc->createElement('g:availability', $stock_status ));
	$itemNode->appendChild($doc->createElement('g:price',  number_format($product->get_price(), 2) . ' ' . $currentCurrency ));
	if ($product->is_on_sale() && !empty($product->get_sale_price())){
		$itemNode->appendChild($doc->createElement('g:sale_price',  number_format($product->get_sale_price(), 2) . ' ' . $currentCurrency ));
	}
	$itemNode->appendChild($doc->createElement('g:brand', 'TEHI AS'));
	$itemNode->appendChild($doc->createElement('g:mpn', 'TEHI-AS-'.$post->ID));
}

// finalize the file
$cache_comment = $doc->createComment('Cached on ' . date('Y-m-d H:i', time()) );
$doc->appendChild($cache_comment);
$doc->formatOutput = true; // set the formatOutput attribute of domDocument to true
echo $doc->saveXML();
$doc->save($filename);
exit();

