<?php
/**
 * textImageBlock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
//$catName		= get_field( 'categories' );
//$terms			= get_terms( ['taxonomy' => $catName, 'hide_empty' => false] );
$terms			= get_field('categories');

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'categories-block norhage-block';
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
			'content' => 'Is your garden big or small? <br />We have a matching greenhouse for you!'
		]
	]
];
$allowedBlocks = ['core/heading', 'core/paragraph', 'core/list', 'core/list-item', 'core/button'];
?>


<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
<div class="wrap">
	<InnerBlocks 
		allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowedBlocks ) ); ?>" 
		template="<?php echo esc_attr( wp_json_encode( $innerBlocksTemplate ) ); ?>" />

	
	<ul class="taxonomy-teasers">
	<?php if(!empty($terms)): ?>
		<?php foreach($terms as $term): ?>
			<?php get_template_part( 'template-parts/content', 'imagebutton', ['category' => $term] ); ?>
		<?php endforeach; ?>
	<?php else: ?>
		<li class="taxonomy-term teaser image-button"></li>
		<li class="taxonomy-term teaser image-button"></li>
		<li class="taxonomy-term teaser image-button"></li>
		<li class="taxonomy-term teaser image-button"></li>
		<li class="taxonomy-term teaser image-button"></li>
		<li class="taxonomy-term teaser image-button"></li>
	<?php endif; ?>
	</ul>
</div>
</div>