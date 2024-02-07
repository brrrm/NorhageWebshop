<?php
/**
 * Headerblock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$title			= get_field( 'title' );
$text			= get_field( 'intro_text' );
$image			= get_field( 'image' );
$usps			= get_field('usps');


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'headerblock norhage-block';
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

$post_id_greenhouses = 190;
$post_id_services = 196;
$post_id_plastics = 192;
$post_id_materials = 194;
$url_greenhouses = esc_url(get_permalink(pll_get_post($post_id_greenhouses)));
$url_services = esc_url(get_permalink(pll_get_post($post_id_services)));
$url_plastics = esc_url(get_permalink(pll_get_post($post_id_plastics)));
$url_materials = esc_url(get_permalink(pll_get_post($post_id_materials)));

?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
	<div class="hero-wrap">
	<div class="headerblock-text-col">
		<InnerBlocks 
			allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowedBlocks ) ); ?>" 
			template="<?php echo esc_attr( wp_json_encode( $innerBlocksTemplate ) ); ?>" 
			templateLock="all" />

		<div class="text">
			<?php echo $text; ?>
		</div>
	</div>

	
	<div class="headerblock-image-col">
		<figure class="header-image">
			<?php 
			if ( $image ) :
				echo wp_get_attachment_image( $image['ID'], 'full', '', array( 'class' => 'header-image__img', 'alt' => $image['alt'] ) ); 
			endif; 
			?>
		</figure>
	</div>
</div>

	<?php if( have_rows('usps') ): ?>
		<ul class="headerblock-usps">
		<?php 
		while (have_rows('usps')):
			the_row();
			$largeText = get_sub_field('large_text');
			$smallText = get_sub_field('small_text');
			printf('<li><strong>%s</strong> %s</li>', $largeText, $smallText);
		endwhile;
		?>
		</ul>
	<?php endif; ?>
	
</div>