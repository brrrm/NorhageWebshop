<?php
/**
 * textImageBlock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$title			= get_field( 'title' );
$text			= get_field( 'text_paragraph' );
$image			= get_field( 'image' );


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
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>


<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
	<div class="text-image-block--title-col">
		<h2><?php echo esc_html( $title ); ?></h2>
	</div>
	<div class="text-image-block--text-col">
		<?php echo $text; ?>
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