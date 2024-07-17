<?php

if(isset($args['category'])){
	$cat = $args['category'];
	$thumbnail_id = norhage_get_taxo_thumbnail($cat);
	$thumb = wp_get_attachment_image( $thumbnail_id, 'full' );
	$permalink = get_category_link( $cat );
	$title = $cat->name;
}else{
	$product = wc_get_product( $post );
	$permalink = get_permalink( $post->ID );
	$title = get_the_title( $post->ID );
	$thumb = wp_get_attachment_image(get_post_thumbnail_id($post->ID), [420,420]);
}

?>


<li class="image-button">
	<a href="<?php echo esc_url( $permalink ); ?>"><?php echo $thumb; ?></a>
	<div class="title-price">
		<h3 class="title"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h3>
		<?php if(isset($product) && $product !== false): ?>
			<span class="norhage-price"><?php echo $product->get_price_html(); //will give raw price ?></span>
		<?php endif; ?>
	</div>
</li>