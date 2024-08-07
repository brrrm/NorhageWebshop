<?php
/**
 * textImageBlock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$title			= get_sub_field( 'title' );
$text			= get_sub_field( 'text' );
$phone			= get_sub_field( 'phone_number' );
$email			= get_sub_field( 'email' );
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
			'content' => __('Need help with your choice?', 'norhagewebshop')
		]
	],
	[
		'core/paragraph',
		[
			'content' => __('Our experts are ready to assist you with selecting the best match for your growing operations.', 'norhagewebshop')
		]
	],
	[
		'core/paragraph',
		[
			'content' => __('Contact us today and we’ll jumpstart your project!', 'norhagewebshop' )
		]
	],
	[
		'contact-form-7/contact-form-selector',
		[
			'title'	=> 'Contact form 1'
		]
	]
];
$allowedBlocks = ['core/heading', 'core/paragraph', 'core/list', 'core/list-item', 'core/button', 'contact-form-7/contact-form-selector'];
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

		<?php if($title): ?>
			<h2 class="blockTitle"><?php echo $title; ?></h2>
			<?php echo $text ?? ''; ?>
			<?php if($phone):?>
				<p><a href="tel:<?php echo trim(esc_html($phone)); ?>" class="cta-phone button"><?php echo esc_html($phone); ?></a></p>
			<?php endif; ?>
			<?php if($email):?>
				<p><a href="mailto:<?php echo trim(esc_html($email)); ?>" class="cta-email button"><?php echo esc_html($email); ?></a></p>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</div>