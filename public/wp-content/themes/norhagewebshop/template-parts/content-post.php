<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package norhagewebshop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(!has_block('norhagewebshop/headerblock') && !has_block('norhagewebshop/product-header-block')){ ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
				<?php norhagewebshop_posted_on();  ?>
				<?php 
				$categories = get_the_category();
				if(!empty($categories)){ ?>
					<ul class="categories">
					<?php foreach($categories as $cat){
						printf('<li><a href="%s">%s</a></li>', esc_url( get_category_link( $cat->term_id ) ), $cat->name);
					} ?>
					</ul> 
				<?php } ?>
			</div>
	</header><!-- .entry-header -->
	<?php } ?>

	<?php
		/*
		wp_nav_menu([
			'theme_location' 	=> 'menu-1',
			'menu_id'        	=> 'primary-menu',
			'show_submenu'		=> true,
			'container_class'	=> 'menu-main-navigation-container menu-container'
		]);
		*/
	?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'norhagewebshop' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
