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
			<?php 
				$image = get_field('image', $term);
				// if no image has been set, let's try to get an image from the first post in this cat
				if(!$image){
					$first_post = get_posts([
						'numberposts'		=> 1,
						'post_type'			=> 'product',
						'tax_query'			=> [
							[
								'taxonomy' 			=> 'product_cat',
								'terms'				=> $term->term_id,
							]
						]
					]);

					if($first_post){
						$image = get_the_post_thumbnail($first_post[0]->ID, 'medium');
					}
				}
			?>
			<li class="taxonomy-term teaser image-button">
				<a href="<?php echo get_term_link( $term ); ?>" title="<?php sprintf( __( 'View all post filed under %s', 'norhagewebshop' ), $term->name ); ?>">
					<?php 
					if($image && is_array($image)){
						echo wp_get_attachment_image( $image['ID'], 'medium', '', array( 'class' => 'header-image__img', 'alt' => $image['alt'] ) );
					}elseif($image){
						echo $image;
					}
					?>
				</a>
				<h3 class="title">
					<a href="<?php echo get_term_link( $term ); ?>" title="<?php sprintf( __( 'View all post filed under %s', 'norhagewebshop' ), $term->name ); ?>">
						<?php echo $term->name; ?>
					</a>
				</h3>
			</li>
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