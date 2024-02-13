<?php
/**
 * textImageBlock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$title			= get_field( 'title' );
$reviews		= get_field( 'reviews' );


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'reviews-block norhage-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>


<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
	<h2><?php echo esc_html( $title ); ?></h2>

	<?php if( have_rows('reviews') ): ?>
	    <div class="reviews">
	    <?php while( have_rows('reviews') ): the_row();
	    	$image = get_sub_field('review_image');
	        ?>
	        <article>
	        	<header>
	        		<h3><?php the_sub_field('review_title'); ?></h3>
	        	</header>
	        	<figure>
		        	<?php if($image):
		        		echo wp_get_attachment_image( $image['ID'], 'full', '', [ 'alt' => $image['alt']] );
		        	endif; ?>
	        	</figure>
	        	<div class="review-text"><?php the_sub_field('review_text'); ?></div>
	        	<footer>
	        		<span class="name"><?php the_sub_field('reviewer_name'); ?></span>
	        		<span class="date"><?php the_sub_field('review_date'); ?></span>
	        	</footer>
	        </article>
	    <?php endwhile; ?>
	    </div>
	<?php endif; ?>
</div>