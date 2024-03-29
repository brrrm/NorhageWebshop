<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package norhagewebshop
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-V26DXPHHTF"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-V26DXPHHTF');
	</script>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'norhagewebshop' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php 
			$norhagewebshop_description = get_bloginfo( 'description', 'display' );
			if ( $norhagewebshop_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $norhagewebshop_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
			<a href="/" title="Home">
				<svg version="1.1" id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 743.3 478.7" style="enable-background:new 0 0 743.3 478.7;" xml:space="preserve">
					<style type="text/css">.logoshape{fill:#FFFFFF;}</style>
					<g>
						<g>
							<path class="logoshape" d="M74.6,443.1c-3.3,0-5.6-1.5-6.8-4.4l-35.8-77.7h-0.4v76.2c0,3.7-2.1,5.8-5.8,5.8H5.8c-3.7,0-5.8-2.1-5.8-5.8
								V311.3c0-3.7,2.1-5.8,5.8-5.8h23.6c3.3,0,5.6,1.5,6.8,4.3l33.3,72.3H70v-70.8c0-3.7,2.1-5.8,5.8-5.8h19.9c3.7,0,5.8,2.1,5.8,5.8
								v125.9c0,3.7-2.1,5.8-5.8,5.8H74.6z"/>
							<path class="logoshape" d="M217,376.8v29c0,25.5-14.9,39.8-41.8,39.8s-41.8-14.3-41.8-39.8v-29c0-25.5,14.9-39.8,41.8-39.8
								S217,351.3,217,376.8z M187.6,378.4c0-10.8-4.1-16.2-12.4-16.2c-8.3,0-12.4,5.4-12.4,16.2v25.7c0,10.8,4.1,16.2,12.4,16.2
								c8.3,0,12.4-5.4,12.4-16.2V378.4z"/>
							<path class="logoshape" d="M245.2,377.8c0-26.7,13-40.8,37.9-40.8c8.9,0,16.6,1.9,23.4,5.4c3.3,1.7,3.9,4.6,2.3,7.9l-5.8,11.8
								c-1.7,3.5-4.4,3.9-7.9,2.3c-2.9-1.5-5.8-2.1-8.7-2.1c-7.7,0-11.8,5-11.8,13.9v61.1c0,3.7-2.1,5.8-5.8,5.8H251
								c-3.7,0-5.8-2.1-5.8-5.8V377.8z"/>
							<path class="logoshape" d="M414.8,376.2v61.1c0,3.7-2.1,5.8-5.8,5.8h-17.8c-3.7,0-5.8-2.1-5.8-5.8v-59.6c0-10.4-3.7-15.3-11.6-15.3
								c-7.7,0-11.6,5.2-11.6,15.3v59.6c0,3.7-2.1,5.8-5.8,5.8h-17.8c-3.7,0-5.8-2.1-5.8-5.8V303.9c0-3.7,2.1-5.8,5.8-5.8h17.8
								c3.7,0,5.8,2.1,5.8,5.8v38.9h0.4c4.3-3.7,10.6-5.8,18-5.8C402.6,337,414.8,350.9,414.8,376.2z"/>
							<path class="logoshape" d="M523.3,379.1v26.7c0,25.5-14.9,39.8-41.8,39.8c-26.5,0-40.4-11.6-40.4-33.8c0-20.5,13-31.7,37.9-31.7h14.9
								c0-12.8-5.6-17.8-16.6-17.8c-5.6,0-11.4,1.9-16.4,5c-3.3,2.1-6,1.7-7.9-1.7l-6.4-11.8c-1.9-3.1-1.2-5.8,1.7-7.9
								c9.5-6,19.7-8.9,31.9-8.9C507.8,337,523.3,351.3,523.3,379.1z M493.9,404.1v-4.3h-10.8c-7.9,0-12.6,3.9-12.6,10.4
								s4.1,10.1,11,10.1C489.8,420.3,493.9,414.9,493.9,404.1z"/>
							<path class="logoshape" d="M633.1,376.8v63c0,24.4-15.7,38.9-42.5,38.9c-13.5,0-25.5-3.5-34.2-9.9c-2.9-2.3-3.3-5-1.4-8.1l7-11.8
								c2.1-3.5,4.8-3.9,8.1-1.7c6.2,4.4,12.4,6.4,18.6,6.4c9.9,0,14.9-4.8,14.9-14.3v-3.9h-0.4c-4.4,3.7-10.4,5.8-17.6,5.8
								c-23.4,0-36.2-14.3-36.2-39.8v-24.6c0-25.5,14.9-39.8,41.8-39.8C618.2,337,633.1,351.3,633.1,376.8z M603.7,399.8v-21.3
								c0-10.8-4.1-16.2-12.4-16.2s-12.4,5.4-12.4,16.2v21.3c0,10.8,4.1,16.2,12.4,16.2C599.3,415.9,603.7,410.3,603.7,399.8z"/>
							<path class="logoshape" d="M743.3,376.8V394c0,3.7-2.1,5.8-5.8,5.8h-46.8v2.3c0,13,5.2,18.2,16.8,18.2c5.8,0,11-1.7,15.9-5.2
								c3.3-2.3,6-2.1,8.1,1.2l7.3,11c1.9,3.1,1.7,5.8-1.2,8.1c-8.3,6.4-19.5,10.1-30.9,10.1c-29.8,0-45.4-13.7-45.4-42v-26.7
								c0-25.5,14.7-39.8,41-39.8S743.3,351.3,743.3,376.8z M715.5,378.4c0-10.8-4.1-16.2-12.4-16.2c-8.3,0-12.4,5.4-12.4,16.2v1.7h24.9
								V378.4z"/>
						</g>
						<path class="logoshape" d="M350,0C248.7,0,166.6,82.1,166.6,183.4c0,29.6,7,57.5,19.4,82.2c44.4-12.3,98.4-25.5,169.5-39.3
							c0.5-2.7,4-5.7,7.5-6.8c0.2-0.1,0.5-0.1,0.7-0.2c-0.2-20-0.4-41.7-0.3-45c0.1-9.2-0.2-18.4-1.6-27.5c-1.4-8.8-3.7-17.5-7.2-25.7
							c-3.4-8-8.3-15.2-14-21.6c-5.9-6.5-12.7-12.3-19.9-17.4c-7.9-5.6-16.2-10.6-25-14.4c-17.2-7.4-34.9-9.2-54.2-8.4
							c26.5,17.4,48.5,62,74.1,72.3c11.2,4.5,22.8,2.2,33,4.5c1.6,0.4,3.4,0.8,4.3,1.4c-0.1-3.7-3.2-8.1-4.4-10.3
							c-7.6-12.8-15.2-18.9-27-27.8c-18.7-14.3-24-20.5-62-34.2c14.1,3.8,27.8,8.9,40.8,15.7c16.9,8.8,32.7,20.5,45.1,35.1
							c4.2,4.9,4.7,6.3,7.9,11.9c1.9,3.5,3.7,9.5,3.8,13.7c-12.6,2.1-23.1,7-35.8,4.8c-9.9-1.7-19.5-5.6-26.9-12.6
							c-3.4-3.3-6.1-7.3-8.8-11.2c-2.7-4-5.4-8.1-8.1-12.1c-12.5-18.7-25.6-37.6-43.4-51.7c6.3-1.9,31.6-1.8,48.8,1.9
							c10.3,2.2,20,5.3,29,10.7c15.8,9.4,30.9,21.4,40.9,37.1c9.5,14.9,13.5,32.8,14.6,50.3c0.3-1.7,0.6-3.5,1.1-5.2
							c2.3-8.5,6.2-16.4,12.2-22.9c5.9-6.3,13.3-11.2,21-14.9c7.9-3.8,15-6.1,23.4-8.4c14-3.8,23.2-4.7,26.4-3.8
							c-0.6,1.4-6.5,16.5-10.7,24.1c-5.2,9.2-11.7,17.4-20.7,23c-13.4,8.2-39.6,11.3-43.1,8.2c4-9.2,11.5-23.9,27.2-33.6
							c16.3-10,36.2-15.5,36.3-15.1c0.1,0.4-18.9,6.5-33.7,17.1c-11.5,8.2-20,19.4-24.2,28.9c5.5-4,11.6-4.6,21.5-7.1
							c26.8-6.8,41.3-29.5,45.4-44.2c-2.2,0.2-4.4,0.5-6.6,0.9c-8.5,1.5-17,4-25.1,6.8c-7.7,2.7-16.8,8-23.7,12.6
							c-6.6,4.4-12.5,10.1-16.4,17.2c-4.4,7.9-6.4,17-6.8,25.9c-0.2,5.8-2.1,17.4-3,31c-0.2,3.7-0.7,11.1-1.2,20c3.6-0.1,7.2,1.1,8,3.4
							c0,0.1,0.1,0.3,0.1,0.4c45.5-8.5,97.7-17.2,158.3-26c0.3-4.4,0.5-8.9,0.5-13.3C533.4,82.1,451.3,0,350,0z"/>
					</g>
				</svg>
			</a>
		</div><!-- .site-branding -->

		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'norhagewebshop' ); ?></button>
		
		<nav id="site-navigation" class="main-navigation">
			
			<h2><?php _e('Navigation', 'norhagewebshop'); ?></h2>

			<?php
			wp_nav_menu([
				'theme_location' 	=> 'menu-1',
				'menu_id'        	=> 'primary-menu',
				'container_class'	=> 'menu-main-navigation-container menu-container'
			]);
			?>
			<?php
			wp_nav_menu([
				'theme_location' 	=> 'menu-2',
				'menu_id'        	=> 'secondary-menu',
				'container_class'	=> 'menu-secondary-menu-container menu-container'
			]);
			?>

			<aside class="contact">
				<h3><?php _e('Contact us today', 'norhagewebshop'); ?></h3>
				<a href="mailto:info@norhage.no">info@norhage.no</a>
			</aside>

			<aside class="search">
				<?php get_product_search_form(); ?>
			</aside>

			<?php //the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			<div class="widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"><?php woocommerce_mini_cart();?></div></div>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
