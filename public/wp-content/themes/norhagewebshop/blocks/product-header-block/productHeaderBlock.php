<?php
/**
 * Headerblock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$text			= get_field( 'intro_text' );
$images			= get_field( 'images' );


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
	]
];
$allowedBlocks = ['core/post-title'];
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
			templateLock="all" />
		
		<div class="text">
			<?php echo $text; ?>
		</div>
	</div>

	<?php if ( $images ) : ?>
		<div class="image-col">
			<?php foreach( $images as $image ): ?>
			<figure class="header-image">
				<?php 
				if ( $image ) :
					echo wp_get_attachment_image( $image['ID'], 'full', '', array( 'class' => 'header-image__img', 'alt' => $image['alt'] ) ); 
				endif; 
				?>
			</figure>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<div class="image-col empty">
		</div>
	<?php endif; ?>

	





</div>