<?php
/**
 * textImageBlock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$phone			= get_field( 'phone_number' );
$email			= get_field( 'email' );
$image			= get_field( 'image' );


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'cta-within-text-block norhage-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$innerBlocksTemplate = [
	[
		'core/heading',
		[
			'level'	=> 2,
			'content' => __('Need emergency damage repair? <br>Call us today!', 'norhagewebshop')
		]
	],
	[
		'core/paragraph',
		[ 
			'content' => __('Our experts are ready to assist you with selecting the best match for your growing operations.', 'norhagewebshop') 
		]
	]
];
$allowedBlocks = ['core/heading', 'core/paragraph', 'core/list', 'core/list-item', 'core/button'];
?>


<figure <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
	<div class="wrapper">
		<div class="image-col">
			<div class="image">
				<?php 
				if(!empty($image)){
					echo wp_get_attachment_image( $image['ID'], 'full', '', array( 'class' => 'img', 'alt' => $image['alt'] ) );
				} else{
					echo wp_get_attachment_image( 51651, 'full', '', array( 'class' => 'img', 'alt' => __('Contact us', 'norhagewebshop') ) );
				} 
				?>
			</div>
			<?php if($phone):?>
				<p><a href="tel:<?php echo trim(esc_html($phone)); ?>" class="cta-phone button"><?php echo esc_html($phone); ?></a></p>
			<?php endif; ?>
			<?php if($email):?>
				<p><a href="mailto:<?php echo trim(esc_html($email)); ?>" class="cta-email button"><?php echo esc_html($email); ?></a></p>
			<?php endif; ?>
		</div>
		<div class="text-col">
			<InnerBlocks 
				allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowedBlocks ) ); ?>" 
				template="<?php echo esc_attr( wp_json_encode( $innerBlocksTemplate ) ); ?>" />
		</div>
	</div>
</figure>