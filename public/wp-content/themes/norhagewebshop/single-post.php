<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package norhagewebshop
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		?>
		<div class="post-navigation" >
			<h2><?php _e('Continue reading:', 'norhagewebshop'); ?></h2>
			<?php previous_post_link('%link', '&laquo; %title'); ?>
			<?php next_post_link('%link', '%title &raquo;'); ?>
		</div>

		<?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
