<?php
/**
 * Headerblock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$images			= get_field( 'images' );
$max_shown		= 4;


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'productHeaderBlock norhage-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$innerBlocksTemplate = [
	[
		'core/post-title',
		[
			'level'	=> 1
		]
	],
	[
		'core/paragraph'
	]
];
$allowedBlocks = ['core/post-title', 'core/paragraph'];
?>



<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
	

	<div class="text-col">
		<?php
			if ( function_exists('yoast_breadcrumb') && !$is_preview ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
		?>

		<InnerBlocks 
			allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowedBlocks ) ); ?>" 
			template="<?php echo esc_attr( wp_json_encode( $innerBlocksTemplate ) ); ?>" 
			 />

	</div>

	<?php if ( $images ) : ?>
		<div class="image-col">
			<?php $counter = 0; ?>
			<?php foreach( $images as $image ): ?>
			<figure class="header-image">
				<?php 
				$counter++;
				if ( $image ) :
					echo wp_get_attachment_image( $image['ID'], 'full', '', array( 'class' => 'header-image__img', 'alt' => $image['alt'] ) ); 
				endif; 
				
				if($counter == $max_shown && count($images) > $max_shown): ?>
					<span class="click-for-more-images">+<?php echo count($images) - $max_shown; ?></span>
				<?php endif; ?>
			</figure>
			<?php endforeach; ?>
		</div>

	<?php else: ?>
		<div class="image-col empty">
		</div>
	<?php endif; ?>

</div>