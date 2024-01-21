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
			<h2><?php _e('Norhage Industri', 'norhagewebshop'); ?></h2>
			<p>Quisque sed vestibulum dui, ut ullamcorper felis. Phasellus convallis congue dolor, vitae auctor nulla sodales nec. Vestibulum mollis sapien eget congue luctus.</p>
			<dl>
				<dt><?php _e('Address', 'norhagewebshop'); ?></dt>
				<dd>
					TEHI AS <br />
					Postboks 195 <br />
					4350 Kleppe <br />
					Norge
				</dd>
				
				<dt><?php _e('Email', 'norhagewebshop'); ?></dt>
				<dd><a href="mailto:info@norhagewebshop.no">info@norhagewebshop.no</a></dd>
				
				<dt><?php _e('Phone', 'norhagewebshop'); ?></dt>
				<dd>
					<a href="tel:+4796759359">+47 967 59 359</a> <br />
					<a href="tel:+4798367181">+47 983 67 181</a>
				</dd>

				<dt><?php _e('B2C webshop', 'norhagewebshop'); ?></dt>
				<dd><a href="https://norhage.no" target="_blank">norhage.no</a></dd>
			</dl>
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
					<a href="https://www.facebook.com/norhage.no" target="_blank" rel="nofollow">Facebook</a>
				</li>
				<li class="instagram">
					<a href="https://www.instagram.com/norhage.no/" target="_blank" rel="nofollow">Instagram</a>
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
