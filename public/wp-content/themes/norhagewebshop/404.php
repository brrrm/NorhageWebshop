
<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package norhagewebshop
 */

get_header();

$text = __("It seems like the page you're trying to reach has moved or no longer exists. Our webshop recently underwent some changes, so it’s possible that the link is outdated. We apologize for the inconvenience!

You can try searching for what you need, or feel free to explore other sections of our website. We're confident you'll find what you're looking for.

If you still need help, please don't hesitate to contact our team. We're always here to assist you!", 'norhagewebshop');

?>

	<main id="primary" class="site-main">
		<article id="post-51874" class="post-51874 page type-page status-publish hentry">
			<header class="entry-header">
				<?php
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
					}
				?>
				<h1 class="entry-title"><?php esc_html_e( "Oh no! We couldn't find the page you're looking for.", 'norhagewebshop' ); ?></h1>
			</header><!-- .entry-header -->
		
		
			<div class="entry-content">
				<?php echo wpautop($text); ?>
				<p>
					<a href="<?php echo home_url(); ?>" class="button blue-button" ><?php _e('Back to home', 'norhagewebshop'); ?></a><br/><br />
				</p>

				<?php
			    $drivhus_category_ID = pll_get_term( 15 );

			    if(is_numeric($drivhus_category_ID)):
				    $args = [
						'hierarchical' => 1,
						'show_option_none' => '',
						'hide_empty' => 0,
						'parent' => $drivhus_category_ID,
						'taxonomy' => 'product_cat'
					];
					if($subcats = get_categories($args)): ?>
						<div class="alignwide subcategories">
							<h2><?php _e('Or have a look at our greenhouses', 'norhagewebshop'); ?></h2>
							<ul class="sub-categories">
						
							<?php foreach($subcats as $cat): 
								get_template_part( 'template-parts/content', 'imagebutton', ['category' => $cat] );
							?>
							<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .entry-content -->
		</article>
	</main><!-- #main -->

<?php
get_footer();
