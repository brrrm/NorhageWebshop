<?php
/**
 * Headerblock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$title			= get_sub_field( 'title' ) ?? false;
$products		= get_field( 'products' )?? get_sub_field( 'products' );
$text			= get_sub_field( 'text' ) ?? '';



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
			'content' => __('You might be interested in these items', 'norhagewebshop')
		]
	],
	[
		'core/paragraph',
		[ 
			'content' => __('Our experts are ready to assist you with selecting the best match for your growing operations.', 'norhagewebshop' )
		]
	],
	[
		'core/paragraph',
		[ 
			'content' => __('Call us today and we’ll jumpstart your project!', 'norhagewebshop' )
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
		<?php if($title): ?>
			<h2><?php echo esc_html( $title ); ?></h2>
			<?php echo $text; ?>
		<?php endif; ?>

	</div>
	<div class="products-col">
		<?php if($products): ?>
			<?php global $post; ?>
			<ul>
			<?php foreach($products as $post):
				setup_postdata($post);
				get_template_part( 'template-parts/content', 'imagebutton' );
				
			endforeach; ?>
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