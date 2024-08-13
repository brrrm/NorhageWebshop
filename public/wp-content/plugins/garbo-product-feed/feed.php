<?php

require_once("wp-load.php");

$args =  array(
	'posts_per_page'   => -1,
    'post_type'     => 'product',
    'post_status'   => 'publish',
    'lang'			=> 'nb'
);
$the_query = new WP_Query($args);
$posts = $the_query->get_posts();

$doc = new DomDocument('1.0'); 
$xmlRoot = $doc->createElement("rss");
$xmlRoot = $doc->appendChild($xmlRoot);
$xmlRoot->setAttribute('xmlns:g', 'http://base.google.com/ns/1.0');
$xmlRoot->setAttribute('version', '2.0');

$channelNode = $xmlRoot->appendChild($doc->createElement('channel'));
$channelNode->appendChild($doc->createElement('title', 'lalala'));
$channelNode->appendChild($doc->createElement('link', 'https://nu.nl'));
$channelNode->appendChild($doc->createElement('description', 'oohlalala'));

foreach ($posts as $prekes){
	$produktas = wc_get_product($prekes->ID);
	if (!empty($produktas->name) && !empty($produktas->description) && !empty($produktas->description) && !empty($produktas->price)){
	if(strlen($produktas->name) > 70){$productName = mb_substr($produktas->name, 0, 67,'UTF-8').('...');}else{$productName = $produktas->name;};	
		
	$itemNode = $channelNode->appendChild($doc->createElement('item'));
	$itemNode->appendChild($doc->createElement('g:id', $prekes->ID));
	$itemNode->appendChild($doc->createElement('g:title', $productName));
	$itemNode->appendChild($doc->createElement('g:description',   str_replace("&nbsp;", '',strip_tags($produktas->description))));
	$itemNode->appendChild($doc->createElement('g:link', get_permalink($prekes->ID)));
	$itemNode->appendChild($doc->createElement('g:condition', 'new'));
	$itemNode->appendChild($doc->createElement('g:image_link', get_the_post_thumbnail_url($prekes->ID)));
	$itemNode->appendChild($doc->createElement('g:availability', 'in stock'));
	$itemNode->appendChild($doc->createElement('g:price', number_format(str_replace(",", '',$produktas->price), 2).' NOK'));
	if ($produktas->is_on_sale() && !empty($produktas->get_sale_price())){
	$itemNode->appendChild($doc->createElement('g:sale_price',  number_format(str_replace(",", '',$produktas->get_sale_price()), 2).' NOK'));
	}
	$itemNode->appendChild($doc->createElement('g:brand', 'TEHI AS'));
	$itemNode->appendChild($doc->createElement('g:mpn', 'TEHI-AS-'.$prekes->ID));
	}
	
}

echo $doc->saveXML();
exit();