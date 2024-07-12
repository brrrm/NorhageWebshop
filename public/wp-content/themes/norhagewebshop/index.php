<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package norhagewebshop
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="entry-content">
		<?php if ( have_posts() ) : ?>
			<header>
				<?php
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
					}
				?>
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header>

			<div class="alignwide subcategories">
				<ul class="sub-categories">
				<?php
					$cats = get_categories();
			
					foreach($cats as $cat): 
						get_template_part( 'template-parts/content', 'imagebutton', ['category' => $cat] );
					endforeach; 
				?>
				</ul>
			</div>

		<?php

			/* Start the Loop */
			while ( have_posts() ) :

				echo '<hr class="alignfull">';

				the_post();

				get_template_part( 'template-parts/content-teaser', get_post_type() );

			endwhile;
		?>
				
			<div class="pagination alignwide">
				<?php echo paginate_links(['mid_size' => 10, 'show_all' => true, 'type' => 'list']); ?>
			</div>
		
		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
