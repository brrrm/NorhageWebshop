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
	    	$title = get_sub_field('review_title');
	    	$image = get_sub_field('review_image');
	    	$link = get_sub_field('read_more_link');
	        ?>
	        <article>
	        	<?php if($title): ?>
		        	<header>
		        		<h3><?php the_sub_field('review_title'); ?></h3>
		        	</header>
	        	<?php endif; ?>
	        	<figure>
		        	<?php if($image):
		        		echo wp_get_attachment_image( $image['ID'], 'full', '', [ 'alt' => $image['alt']] );
		        	else: ?>
		        		<span class="dashicons dashicons-heart"></span>
		        	<?php endif; ?>
	        	</figure>
	        	<div class="review-text"><?php echo wp_kses_post(get_sub_field('review_text')); ?></div>
	        	<footer>
	        		<span class="name"><?php the_sub_field('reviewer_name'); ?></span>
	        		<span class="date"><?php the_sub_field('review_date'); ?></span>
	        		<?php if($link): ?>
	        			<p class="link"><?php printf('<a href="%s" target="%s">%s %s</a>', $link['url'], $link['target'] ?? '_self', __('Read more', 'norhagewebshop').':', $link['title']); ?></p>
	        		<?php endif; ?>
	        	</footer>
	        </article>
	    <?php endwhile; ?>
	    </div>
	<?php endif; ?>
</div>