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
		<ul class="usps">
			<li>
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
					<style type="text/css">.st0{fill:#66B73C;}</style>
					<g>
						<path class="st0" d="M20.6,59l5.2,5.2c1.1,1.1,1.1,2.8,0,3.9c-0.5,0.5-1.2,0.7-1.9,0.7c-0.7,0-1.5-0.2-1.9-0.7l-5.2-5.2l-6.4,6.4l5.2,5.2c1.1,1.1,1.1,2.8,0,3.9c-0.5,0.5-1.2,0.7-1.9,0.7c-0.7,0-1.4-0.3-1.9-0.7l-5.3-5.3l-5.2,5.2C-0.5,80-0.5,83,1.4,84.8l13.8,13.8c0.9,0.8,2.1,1.4,3.3,1.4c1.2,0,2.3-0.4,3.3-1.4l26.6-26.6L28,51.6L20.6,59z"/>
						<path class="st0" d="M98.6,15.1L84.8,1.3c-1.7-1.7-4.7-1.7-6.5,0l-5.1,5.2l5.2,5.2c1.1,1.1,1.1,2.8,0,3.9c-0.5,0.5-1.2,0.8-1.9,0.8S75,16,74.6,15.5l-5.2-5.2L63,16.7l5.2,5.2c1.1,1.1,1.1,2.8,0,3.9c-0.5,0.5-1.2,0.7-1.9,0.7s-1.5-0.2-1.9-0.7L59,20.4l-7.5,7.5l20.3,20.3l26.7-26.7c0.8-0.8,1.4-2,1.4-3.3C100,17,99.5,15.9,98.6,15.1z"/>
						<rect x="39.6" y="12.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -21.0059 50.8761)" class="st0" width="22.5" height="76.3"/>
						<path class="st0" d="M91.9,75.9l-2.1-2.1l-16,15.9l2.1,2.1c0.6,0.6,1.4,0.9,2.2,1.2l12.2,2c2.7,0.4,5.1-1.9,4.6-4.6l-2-12.2C92.8,77.3,92.5,76.5,91.9,75.9z"/>
						<path class="st0" d="M12.1,27.9L28,12l-6.4-6.4C20,4,17.4,4,15.9,5.6L5.6,15.8c-1.6,1.6-1.6,4.1,0,5.7L12.1,27.9z"/>
					</g>
				</svg>
				<strong><a href="<?php echo $url_greenhouses; ?>"><?php _e('Industrial greenhouse projects', 'norhagewebshop'); ?></a></strong>
			</li>
			<li>
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60.4" style="enable-background:new 0 0 100 60.4;" xml:space="preserve">
					<style type="text/css">.st0{fill:#66B73C;}</style>
					<path class="st0" d="M72.5,36.2c-1.1,0-2-0.9-2-2v-4.5c0-1.1,0.9-2,2-2c0.5,0,1,0.3,1.4,0.6c0.4,0.4,0.6,0.9,0.6,1.4v4.5C74.5,35.3,73.6,36.2,72.5,36.2L72.5,36.2z"/>
					<path class="st0" d="M72.5,35.3c0.6,0,1.3-0.5,1.3-1.3v-4.5c0-0.6-0.5-1.3-1.3-1.3c-0.6,0-1.3,0.5-1.3,1.3l0,0V34C71.3,34.8,71.8,35.3,72.5,35.3z"/>
					<g>
						<path class="st0" d="M60.3,35.5l-6.5-10.8c-0.4-0.6-1.1-1-1.9-1H36.7v-2.1c0-2.4-1.9-4.3-4.3-4.3h-28c-2.4,0-4.3,1.9-4.3,4.3v13c0,1.1,1,2.1,2.1,2.1s2.1-1,2.1-2.1v-13h28v30.3H28c-1.1,0-2.1,1-2.1,2.1s1,2.1,2.1,2.1h11.6c1.8,3.8,6.3,5.4,10.1,3.6c1.5-0.9,2.8-2.1,3.5-3.8h2.9c2.4,0,4.3-1.9,4.3-4.3v-15C60.5,36.2,60.4,35.8,60.3,35.5z M50.6,27.9l3.9,6.5h-9.2v-6.5H50.6zM46.4,56c-1.8,0-3.3-1.5-3.3-3.3s1.5-3.3,3.3-3.3s3.3,1.5,3.3,3.3S48.2,56,46.4,56z M56.2,51.7H54c-0.5-4.2-4.3-7-8.4-6.4c-3.4,0.5-6,3.1-6.4,6.4h-2.4V27.9H41v6.5c0,2.4,1.9,4.3,4.3,4.3h10.8V43C55,43,54,44,54,45.2c0,1.1,1,2.1,2.1,2.1v4.4C56.1,51.7,56.2,51.7,56.2,51.7z"/>
						<path class="st0" d="M19.4,47.4h-2.1v-6.5c0-1.1-1-2.1-2.1-2.1H6.4c-1.1,0-2.1,1-2.1,2.1v6.5H2.1c-1.1,0-2.1,1-2.1,2.1v8.7c0,1.1,1,2.1,2.1,2.1h17.2c1.1,0,2.1-1,2.1-2.1v-8.7C21.6,48.3,20.6,47.4,19.4,47.4z M8.6,43h4.3v4.3H8.6V43z M4.3,51.7h4.3V56H4.3V51.7z M17.2,56H13v-4.3h4.3L17.2,56L17.2,56z"/>
					</g>
					<path class="st0" d="M75.8,0.3C75.5,0,75.2,0,74.8,0S74,0.1,73.7,0.4c-7.4,5.3-13.3,12.2-17.5,20l3.9,1.3C63.8,15,68.7,9.1,74.8,4.4C87.7,14.3,95.6,29.7,96,46H84.7V16c0-1.1-0.9-2-2-2H66.8c-1.1,0-2,0.9-2,2v30h-0.9v4H98c1.1,0,2-0.9,2-2C100.1,29.2,91.2,11.3,75.8,0.3z M80.6,46H68.7V17.9h11.9V46z"/>
				</svg>

				<strong><a href="<?php echo $url_services; ?>"><?php _e('Installation services', 'norhagewebshop'); ?></a></strong>
			</li>
			<li>
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
					<style type="text/css">.st0{fill:#66B73C;}</style>
					<path class="st0" d="M94.5,20L83.7,30.8c-0.2,0.2-0.6,0.3-0.8,0.3l-11.2-2c-0.4-0.1-0.7-0.4-0.8-0.8l-2-11.2c0-0.3,0-0.6,0.3-0.8L80,5.5c0.8-0.8,0.7-2.2-0.2-2.9C77.3,0.8,74.4,0,72.1,0c-0.2,0-0.3,0-0.5,0c-3,0.2-9.4,1.9-14.4,7.1c-4.8,5.1-9.9,14.6-5.4,25.1c0.5,1.3,1.1,3-0.6,4.7c-1.8,1.8-48,45.3-48,45.3c-4.3,3.7-4,10.6,0,14.6c2,2,4.8,3.1,7.5,3.1c2.7,0,5.3-1,7.1-3.1c0,0,43.1-45.9,45.2-48c1-0.9,1.9-1.2,2.7-1.2c0.8,0,1.5,0.3,2.1,0.6c2.4,1.2,5,1.8,7.8,1.8c6.4,0,13.2-3,17.4-7.1c5.9-5.9,6.9-11.5,7.1-14.4c0.1-2.4-0.5-5.4-2.6-8.2C96.7,19.3,95.3,19.2,94.5,20L94.5,20z M13.1,91.7c-1.3,1.3-3.5,1.3-4.8,0c-1.3-1.3-1.3-3.5,0-4.8c1.3-1.3,3.5-1.3,4.8,0C14.4,88.2,14.4,90.4,13.1,91.7z"/>
				</svg>
				<strong><a href="<?php echo $url_materials; ?>"><?php _e('Maintenance & restoration', 'norhagewebshop'); ?></a></strong>
			</li>
			<li>
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
					<style type="text/css">.st0{fill-rule:evenodd;clip-rule:evenodd;fill:#66B73C;}</style>
					<path class="st0" d="M49.2,81.9l-0.5,0.2c-0.8,0.2-1.5,0.3-2.3,0.3h-0.1H46l-0.4,0c-0.4,0-0.9-0.1-1.5-0.3l-0.3,0l-0.7-0.3c-0.5-0.2-17.4-9-30.4-15.6c-6.1,3.7-10.9,6.7-11.6,7.1c-0.3,0.2-0.6,0.4-0.8,0.8C0,74.5,0,75,0,75.4c0,0,0,0,0,0.1c0,0.2,0.1,0.4,0.2,0.6c0,0,0,0.1,0.1,0.1c0,0,0,0,0,0c0.1,0.1,0.2,0.2,0.3,0.3c0.1,0.1,0.2,0.2,0.4,0.3c0,0,0,0,0,0c0.6,0.3,43.8,22.6,44.4,22.9c0,0,0.1,0,0.1,0c0.2,0.1,0.4,0.1,0.6,0.2c0.1,0,0.1,0,0.2,0c0.2,0,0.4,0,0.7-0.1c0,0,0.1,0,0.1,0c0.1-0.1,0.3-0.1,0.4-0.2l42.4-26c0.1,0,0.1-0.1,0.2-0.1c0.1-0.1,0.2-0.2,0.3-0.3c0.1-0.1,0.2-0.2,0.3-0.3c0-0.1,0.1-0.1,0.1-0.2c0-0.1,0-0.1,0-0.2c0-0.1,0.1-0.3,0.1-0.4c0-0.1,0-0.3,0-0.4c0-0.1,0-0.3-0.1-0.4c0-0.1-0.1-0.3-0.1-0.4c0-0.1,0-0.1-0.1-0.2c0-0.1-0.1-0.1-0.1-0.2c-0.1-0.1-0.2-0.2-0.3-0.3c-0.1-0.1-0.2-0.2-0.3-0.2c-0.1,0-0.1-0.1-0.2-0.1l-11.3-5.8L50.7,81.3C50.2,81.6,49.6,81.8,49.2,81.9z"/>
					<path class="st0" d="M49.2,58.4l-0.4,0.1c-0.8,0.2-1.6,0.4-2.4,0.4H46l-0.5,0c-0.5,0-1-0.1-1.6-0.3l-0.3-0.1l-0.7-0.3c-0.5-0.3-17.5-9-30.4-15.6c-6.1,3.7-10.9,6.7-11.6,7.1c-0.3,0.2-0.6,0.4-0.8,0.8C0,51,0,51.5,0,51.9c0,0,0,0,0,0.1c0,0.2,0.1,0.4,0.2,0.6c0,0,0,0.1,0.1,0.1c0,0,0,0,0,0c0.1,0.1,0.2,0.2,0.3,0.3c0.1,0.1,0.2,0.2,0.4,0.3c0,0,0,0,0,0C1.7,53.7,44.9,76,45.5,76.3c0,0,0.1,0,0.1,0c0.2,0.1,0.4,0.1,0.6,0.2c0.1,0,0.1,0,0.2,0c0.2,0,0.4,0,0.7-0.1c0,0,0.1,0,0.1,0c0.1-0.1,0.3-0.1,0.4-0.2L90,50.2c0.1,0,0.1-0.1,0.2-0.1c0.1-0.1,0.2-0.2,0.3-0.3c0.1-0.1,0.2-0.2,0.3-0.3c0-0.1,0.1-0.1,0.1-0.2c0-0.1,0-0.1,0-0.2c0-0.1,0.1-0.3,0.1-0.4c0-0.1,0-0.3,0-0.4c0-0.1,0-0.3-0.1-0.4c0-0.1-0.1-0.3-0.1-0.4c0-0.1,0-0.1-0.1-0.2c0-0.1-0.1-0.1-0.1-0.2c-0.1-0.1-0.2-0.2-0.3-0.3c-0.1-0.1-0.2-0.2-0.3-0.2c-0.1,0-0.1-0.1-0.2-0.1l-11.3-5.8L50.7,57.8C50.1,58.1,49.6,58.3,49.2,58.4z"/>
					<path class="st0" d="M45.6,0.2c-0.1,0-0.2,0-0.2-0.1C45.3,0.1,45.1,0.1,45,0c-0.2,0-0.3,0-0.5,0c-0.1,0-0.2,0-0.3,0c-0.2,0-0.4,0.1-0.5,0.2c0,0-0.1,0-0.2,0C43,0.6,3.3,24.9,1.1,26.3c-0.3,0.2-0.6,0.4-0.8,0.8C0,27.5,0,28,0,28.4c0,0,0,0,0,0.1c0,0.2,0.1,0.4,0.2,0.6c0,0,0,0.1,0.1,0.1c0,0,0,0,0,0c0.1,0.1,0.2,0.2,0.3,0.3c0.1,0.1,0.2,0.2,0.4,0.3c0,0,0,0,0,0c0.6,0.3,43.8,22.6,44.4,22.9c0,0,0.1,0,0.1,0c0.2,0.1,0.4,0.1,0.6,0.2c0.1,0,0.1,0,0.2,0c0.2,0,0.4,0,0.7-0.1c0,0,0.1,0,0.1,0c0.1-0.1,0.3-0.1,0.4-0.2L90,26.7c0.1,0,0.1-0.1,0.2-0.1c0.1-0.1,0.2-0.2,0.3-0.3c0.1-0.1,0.2-0.2,0.3-0.3c0-0.1,0.1-0.1,0.1-0.2c0-0.1,0-0.1,0-0.2c0-0.1,0.1-0.3,0.1-0.4c0-0.1,0-0.3,0-0.4c0-0.1,0-0.3-0.1-0.4c0-0.1-0.1-0.3-0.1-0.4c0-0.1,0-0.1-0.1-0.2c0-0.1-0.1-0.1-0.1-0.2c-0.1-0.1-0.2-0.2-0.3-0.3c-0.1-0.1-0.2-0.2-0.3-0.2c-0.1,0-0.1-0.1-0.2-0.1L45.6,0.2z"/>
				</svg>
				<strong><a href="<?php echo $url_plastics; ?>"><?php _e('Roofing & facade, PVC curtains', 'norhagewebshop'); ?></a></strong>
			</li>
		</ul>
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