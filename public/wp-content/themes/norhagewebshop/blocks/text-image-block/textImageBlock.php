<?php
/**
 * textImageBlock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$title			= get_field( 'title' ) ?? get_sub_field( 'title' );
$text			= get_field( 'text_paragraph' ) ?? get_sub_field( 'text_paragraph' );
$image			= get_field( 'image' ) ?? get_sub_field( 'image' );
$text__image_order		= get_field( 'text__image_order' ) ?? get_sub_field('text__image_order');
$green_bg 		= get_field('green_background') ?? get_sub_field('green_background');

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'text-image-block norhage-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( empty( $block['align'] ) ) {
	$class_name .= ' alignfull';
}else{
    $class_name .= ' align' . $block['align'];
}
if($text__image_order){
	$class_name .= ' ' . $text__image_order;
}else{
	$class_name .= ' text_left';
}
if($green_bg){
	$class_name .= ' green_bg';
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
	<div class="text-col">
		<InnerBlocks 
			allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowedBlocks ) ); ?>" 
			template="<?php echo esc_attr( wp_json_encode( $innerBlocksTemplate ) ); ?>" />
	</div>
	<div class="text-image-block--image-col">
		<?php if ( $image ) : ?>
			<figure class="image">
				<?php echo wp_get_attachment_image( $image['ID'], 'full', '', array( 'class' => 'header-image__img', 'alt' => $image['alt'] ) ); ?>
			</figure>
		<?php else : ?>
			<figure class="dummy">
			</figure>
		<?php endif; ?>
	</div>
</div>