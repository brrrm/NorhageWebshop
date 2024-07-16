<?php
/**
 * Headerblock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$slides 		= get_field('slides') ;


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'header-slider-block norhage-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
<?php 
if( have_rows('slides') ):

    // Loop through rows.
    while( have_rows('slides') ) : 
    	the_row();
        $text = get_sub_field('text');
        $image = get_sub_field('image'); ?>

        <div class="slide"><div class="slide-wrap">
        	<div class="text-col">
        		<?php echo $text; ?>
        	</div>
        	<div class="image-col">
				<figure class="header-image">
					<?php 
					if ( $image ) :
						echo wp_get_attachment_image( $image['ID'], 'full', '', array( 'class' => 'header-image__img', 'alt' => $image['alt'] ) ); 
					endif; 
					?>
				</figure>
        	</div>
        </div></div>

    <?php endwhile; // End loop.

endif;
?>
	
</div>