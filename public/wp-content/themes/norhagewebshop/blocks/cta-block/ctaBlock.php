<?php
/**
 * textImageBlock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$image			= get_field( 'image' ) ?? get_sub_field( 'image' );


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'cta-block norhage-block';
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
			'placeholder' => 'Need help with your choice?'
		]
	],
	[
		'core/paragraph',
		[ 
			'placeholder' => 'Our experts are ready to assist you with selecting the best match for your growing operations.' 
		]
	],
	[
		'core/paragraph',
		[ 
			'placeholder' => 'Call us today and we’ll jumpstart your project!' 
		]
	],
	[
		'core/button',
		[ 
			'text' => 'Call now',
			'url' => 'tel:+4796759359'
		]
	]
];
$allowedBlocks = ['core/heading', 'core/paragraph', 'core/list', 'core/list-item', 'core/button'];
?>


<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
	<div class="image-col">
		<?php if ( $image ) : ?>
			<figure class="image">
				<?php echo wp_get_attachment_image( $image['ID'], 'full', '', array( 'class' => 'img', 'alt' => $image['alt'] ) ); ?>
			</figure>
		<?php else : ?>
			<figure class="dummy">
			</figure>
		<?php endif; ?>
	</div>
	<div class="text-col">
		<InnerBlocks 
			allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowedBlocks ) ); ?>" 
			template="<?php echo esc_attr( wp_json_encode( $innerBlocksTemplate ) ); ?>" />
	</div>
</div>