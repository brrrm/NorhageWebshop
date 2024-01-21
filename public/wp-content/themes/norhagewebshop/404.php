
<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package norhagewebshop
 */

get_header();
?>

	<main id="primary" class="site-main">
		<section class="error-404 not-found">
			<div class="page-content">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( '404', 'norhagewebshop' ); ?></h1>
				</header><!-- .page-header -->
				<p><?php esc_html_e( 'oh dear, we had to short on material..' ); ?></p>	
				<a href="<?php echo home_url(); ?>" class="button blue-button" >Back to home</a>
			</div><!-- .page-content -->
			<div class="gif">
				<iframe src="https://giphy.com/embed/1wrRQfA0DcS7n3zaX0" width="480" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
				<p><a href="https://giphy.com/gifs/cute-house-beach-1wrRQfA0DcS7n3zaX0">via GIPHY</a></p>
			</div>
		</section><!-- .error-404 -->
	</main><!-- #main -->

<?php
get_footer();
