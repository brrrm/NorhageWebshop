<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package norhagewebshop
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="company-info">
			<h2><?php _e('Norhage Webshop', 'norhagewebshop'); ?></h2>
			<dl>
				<dt><?php _e('Address', 'norhagewebshop'); ?></dt>
				<dd>
					<?php echo nl2br(__('TEHI AS
						Vardheivegen 68
						4340 Bryne
						Norge', 'norhagewebshop')); ?>
				</dd>
				
				<dt><?php _e('Email', 'norhagewebshop'); ?></dt>
				<dd><?php printf('<a href="mailto:%s">%s</a>', __('info@norhage.com', 'norhagewebshop'), __('info@norhage.com', 'norhagewebshop')); ?></dd>
				
				<dt><?php _e('Phone', 'norhagewebshop'); ?></dt>
				<dd>
					<?php _e('<a href="tel:+4796759359">+47 967 59 359</a> <br />
							<a href="tel:+4798367181">+47 983 67 181</a>', 'norhagewebshop'); ?>
				</dd>

				<dt><?php _e('B2B website', 'norhagewebshop'); ?></dt>
				<dd><?php printf('<a href="%s" target="_blank">%s</a>', __('https://norhageindustri.com', 'norhagewebshop'), __('norhageindustri.com', 'norhagewebshop')); ?></dd>
			</dl>

			<h2><?php _e('Find the Norhage shop for your country', 'norhagewebshop'); ?></h2>
			<?php if(function_exists('pll_the_languages')){ ?>
				<ul class="languages">
				<?php pll_the_languages( ['show_flags' => true, 'hide_if_empty' => true, 'hide_if_no_translation' => true] ); ?>
				</ul>
			<?php } ?>
		</div>
		<nav id="footer-navigation" class="sitemap">
			<h2><?php _e('Sitemap', 'norhagewebshop'); ?></h2>
			<button class="menu-toggle" aria-controls="sitemap" aria-expanded="false"><?php esc_html_e( 'Sitemap', 'norhagewebshop' ); ?></button>
			<?php wp_nav_menu([
				'theme_location' => 'menu-3',
				'container_class'	=> 'menu-footer-menu-container'
			]); ?>

		</nav><!-- #site-navigation -->

		<nav id="socials-navigation">
			<h3><?php _e('Norhage can also be found on:', 'norhagewebshop'); ?></h3>
			<ul>
				<li class="facebook">
					<a href="<?php _e('https://www.facebook.com/norhage.no', 'norhagewebshop'); ?>" target="_blank" rel="nofollow">Facebook</a>
				</li>
				<li class="instagram">
					<a href="<?php _e('https://www.instagram.com/norhage.no/', 'norhagewebshop'); ?>" target="_blank" rel="nofollow">Instagram</a>
				</li>
				<li class="youtube">
					<a href="https://www.youtube.com/channel/UCLJoLfGJShJfbZefhUlAs4Q" target="_blank" rel="nofollow">Youtube</a>
				</li>
			</ul>
		</nav>
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
