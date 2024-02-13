<?php
/**
 * Headerblock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$products		= get_field( 'products' )?? get_sub_field( 'products' );

// If no posts have been selected, load all the posts from this project's post-type.
if(!$products || empty($products)){
	global $post;

	$projects = get_posts([
		'post_type' => 'project',
		'meta_query' => [
			[
				'key' => 'product_project_relation', // name of custom field
				'value' => '"' . $post->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			],
		]
	]);
}

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'products-block norhage-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( empty( $block['align'] ) ) {
	$class_name .= ' alignfull';
}else{
    $class_name .= ' align' . $block['align'];
}

$innerBlocksTemplate = [
	[
		'core/heading',
		[
			'level'	=> 2,
			'content' => 'You might be interested in these items'
		]
	],
	[
		'core/paragraph',
		[ 
			'content' => 'Our experts are ready to assist you with selecting the best match for your growing operations.' 
		]
	],
	[
		'core/paragraph',
		[ 
			'content' => 'Call us today and we’ll jumpstart your project!' 
		]
	]
];
$allowedBlocks = ['core/heading', 'core/paragraph', 'core/list', 'core/list-item', 'core/button'];
?>


<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
	<div class="text-col">
		<InnerBlocks 
			allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowedBlocks ) ); ?>" 
			template="<?php echo esc_attr( wp_json_encode( $innerBlocksTemplate ) ); ?>" />
	</div>
	<div class="products-col">
		<?php if($products): ?>
			<ul>

			<?php foreach($products as $product):
				$permalink = get_permalink( $product->ID );
        		$title = get_the_title( $product->ID );
        		$thumb = wp_get_attachment_image(get_post_thumbnail_id($product->ID), [420,420]);
        	?>
				<li class="image-button">
					<a href="<?php echo esc_url( $permalink ); ?>"><?php echo $thumb; ?></a>
					<h3 class="title"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h3>
				</li>
			<?php endforeach; ?>
			</ul>
			<?php 
		    // Reset the global post object so that the rest of the page works correctly.
		    wp_reset_postdata(); ?>
		<?php else: ?>
			<ul>
				<li class="image-button"></li>
				<li class="image-button"></li>
				<li class="image-button"></li>
				<li class="image-button"></li>
				<li class="image-button"></li>
				<li class="image-button"></li>
			</ul>
		<?php endif; ?>
	</div>
</div>