<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package norhagewebshop
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="entry-header">
				<?php
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
					}
				?>
				<h1 class="page-title">
					<?php echo single_cat_title( '', false ); ?>
				</h1>
				<?php
				//the_archive_title( '<h1 class="page-title">' . single_cat_title( '', false ), '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

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
				<ul class="product-teasers alignwide">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : ?>
					<li class="product mini-teaser image-button">
					<?php the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content-teaser', get_post_type() ); ?>
					</li>
				<?php endwhile; ?>
				 </ul>
			</div>

			<?php the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
