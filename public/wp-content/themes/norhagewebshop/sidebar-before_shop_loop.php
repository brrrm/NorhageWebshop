<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package norhagewebshop
 */

?>

<p class="open-filters-button-wrap"><button class="open-filters button"><?php _e('Filter products', 'norhagewebshop'); ?></button></p>
<aside id="filters-sidebar" class="widget-area">
	<div class="wrap">
		<h2><?php _e('Filters', 'norhagewebshop'); ?></h2>
		<button class="close-btn"><?php _e('Close', 'norhagewebshop'); ?></button>

		<?php dynamic_sidebar( 'before_shop_loop' ); ?>

	</div>
</aside><!-- #secondary -->
