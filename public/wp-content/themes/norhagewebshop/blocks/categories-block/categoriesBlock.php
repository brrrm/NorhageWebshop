<?php
/**
 * textImageBlock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$catName		= get_field( 'categories' );
$terms			= get_terms( ['taxonomy' => $catName, 'hide_empty' => false] );

// set the correct post-type for the fallback query to get the image
switch($catName){
	case 'product-type':
		$post_type = 'product';
		break;
	case 'plastic-type':
		$post_type = 'plastic';
		break;
	case 'service-type':
		$post_type = 'service';
		break;
	case 'constr-mat-type':
		$post_type = 'construction';
		break;
}

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
?>


<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
	<ul class="taxonomy-teasers">
	<?php foreach($terms as $term): ?>
		<?php 
			$image = get_field('image', $term);
			// if no image has been set, let's try to get an image from the first post in this cat
			if(!$image){
				$first_post = get_posts([
					'numberposts'		=> 1,
					'post_type'			=> $post_type,
					'tax_query'			=> [
						[
							'taxonomy' 			=> $catName,
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
	</ul>	
</div>